<?php

class myFlvHandler
{
	const FLV_HEADER_SIZE = 13;
	const TAG_WRAPPER_SIZE = 15;
	
	const TAG_TYPE_VIDEO = 9;
	const TAG_TYPE_AUDIO = 8;
	const TAG_TYPE_METADATA = 18;
	
	const TAG_FIELD_TYPE = 0;
	const TAG_FIELD_SIZE = 1;
	const TAG_FIELD_TIMESTAMP = 2;
	const TAG_FIELD_KEYFRAME = 3;
	const TAG_FIELD_POS = 4;
	const TAG_FIELD_DATA = 5;
	
	const GET_NEXT_TAG_META = 0;
	const GET_NEXT_TAG_DATA = 1;
	const GET_NEXT_TAG_ALL = 2;
	
	private $flv_file_name; // flv file name
	private $pos;
	private $fh = null;
	private $status;

	public function myFlvHandler($flv_file_name)
	{
		$this->flv_file_name = $flv_file_name;
		
		$this->status = file_exists($this->flv_file_name);
		
		if ($this->status)
			$this->fh = fopen($this->flv_file_name, "rb");
	}
	
	public function __destruct()
	{
		if ($this->fh)
		{
			fclose($this->fh);
			$this->fh = null;
		}
	}
	
	public function getFileName()
	{
		return $this->flv_file_name;
	}
	
	public static function createFlvHeader($has_video = true, $has_audio = true)
	{
		return "FLV" . pack('CCNN', 1, ($has_video ? 1 : 0) | ($has_audio ? 4 : 0), 9, 0 );
	}
	
	public function validateHelper($only_audio)
	{
		$info = $only_audio ?
			new FlvInfoAudio($this->flv_file_name) : new FlvInfoVideo($this->flv_file_name);
		
		if (!$info->validate())
		{
			$info->close();
			
			$this->createHelpers();
			
			$info = $only_audio ?
				new FlvInfoAudio($this->flv_file_name) : new FlvInfoVideo($this->flv_file_name);
				
		}
		
		$info->open();
		
		return $info;
	}
	
	public function validateMetadata($only_audio = false)
	{
		$metadata = $only_audio ? new FlvMetadataAudio($this->flv_file_name) :
			new FlvMetadataVideo($this->flv_file_name);
			
		if (!$metadata->validate())
		{
			$metadata->close();
			
			$this->createHelpers();
			
			$metadata = $only_audio ? new FlvMetadataAudio($this->flv_file_name) :
				new FlvMetadataVideo($this->flv_file_name);
		}
		
		return $metadata;
	}
	
	public function getMetadataSize($only_audio)
	{
		$metadata = $this->validateMetadata($only_audio);
		
		return $metadata->getSize();
	}
	
	public function getMetadata($only_audio)
	{
		$metadata = $this->validateMetadata($only_audio);
			
		return $metadata->dump();
	}
	
	public function getHeader()
	{
		fseek($this->fh, 0, SEEK_SET);
		$header = fread($this->fh, self::FLV_HEADER_SIZE);
		$this->pos = self::FLV_HEADER_SIZE;
		
		return $header;
	}
	
	public static function getHeaderSize()
	{
		return self::FLV_HEADER_SIZE;
	}

	public static function createMetadataTag($data)
	{
		$data_len = strlen($data);
		
		$meta_tag = pack("C", myFlvHandler::TAG_TYPE_METADATA).
			substr(pack("N", $data_len), 1, 3)."\0\0\0\0\0\0\0".
			$data.pack("N", $data_len + 11);
			
		return $meta_tag;
	}
	
	public function seek($pos)
	{
		$this->pos = $pos;
		fseek($this->fh, $pos, SEEK_SET);
	}

	public static function dumpTag($data, $timestamp_offset = 0)
	{
		$timestamp = unpack("N", $data[7].substr($data,4, 3));
		$pack_ts = pack("N", $timestamp[1] + $timestamp_offset);
		
		return substr($data, 0, 4).substr($pack_ts, 1, 3).$pack_ts[0].substr($data, 8);
	}
	
	//
	// read the tag data from the current seek position
	// if $dump_data is true the raw data of the whole tag (header + data) is returned
	//
	public function getNextTag($dump_type = 0 /*myFlvHandler::GET_NEXT_TAG_META*/)
	{
		$start_pos = $this->pos;
		$data = @fread($this->fh, 12);
		if (!strlen($data))
			return null;
			
		$temp_data = $data[0]."\0".substr($data,1, 3).$data[7].substr($data,4, 3).$data[11];
		
		$res = unpack("Ca/Nb/Nc/Cd", $temp_data);
		$size = $res['b'] + self::TAG_WRAPPER_SIZE;
		
		$this->pos += $size;
		
		if ($dump_type == myFlvHandler::GET_NEXT_TAG_META)
			$data = null;
		else
		{
			$data = $data.fread($this->fh, $size - 12);
		
			if ($dump_type == myFlvHandler::GET_NEXT_TAG_DATA) // return actual tag
				return $data;
		}
		
		fseek($this->fh, $this->pos, SEEK_SET);
		
		// type, size, timestamp, keyframe, start_pos, [data]
		return array($res['a'], $size, $res['c'], ($res['d'] & 0xF0) == 0x10, $start_pos, $data);
	}
	
	//
	// there are two helpers:
	// video: includes all frames (both intra and keyframe). for each frame we store
	// 	timestamp (int)
	// 	size (int) - tag size including header and terminating last tag size dword
	// 	offset (int) - offset from start of file
	// 	prev_kf (31 bit) - index (# of tag) of previous keyframe in the helper file
	// 	keyframe (1 bit) 0/1 
	// audio: includes only audio tags
	// 	timestamp (int)
	// 	size (int) - tag size including header and terminating last tag size dword
	// 	offset (int) - offset from start of file
	// 	tot_asize (int) - accumulated size for all audio tags till the tag (non inclusive) used when extracting audio from video file
	//
	public function createHelpers()
	{
		if (!$this->isFlv())
			return;
			
		//$st1 = microtime(true);
		
		$this->getHeader();
		
		$vinfo = new FlvInfoVideo($this->flv_file_name);
		$ainfo = new FlvInfoAudio($this->flv_file_name);
		$vmetadata = new FlvMetadataVideo($this->flv_file_name);
		$ametadata = new FlvMetadataAudio($this->flv_file_name);
		
		$vinfo->create();
		$ainfo->create();
		$vmetadata->create();
		$ametadata->create();
		
		$vtags = "";
		$atags = "";
		
		$prev_kf = 0;
		$vtag_count = 0;
		$tot_asize = 0;
		
		$last_pos = $this->pos;
		
		$vtags_chunk = array();
		
		$ametadata_timestamp = 0;
		
		while($tag = $this->getNextTag())
		{
			list($type, $size, $timestamp, $keyframe, $start_pos) = $tag;
			
			if ($type == self::TAG_TYPE_VIDEO)
			{
				if ($keyframe) // patch the next_kf fields
				{
					$vmetadata->addTag($timestamp, $last_pos + $size);
					$vinfo->appendTagNextKf($vtags, $vtags_chunk);
					if (strlen($vtags) > 100000)
					{
						$vinfo->write($vtags);
						$vtags = "";
					}
				}
					
				$vtags_chunk[] = $vinfo->addVTag($timestamp, $size, $last_pos, $vtag_count - $prev_kf, $keyframe);
				
				if ($keyframe)
				{
					$prev_kf = $vtag_count;
				}
					
				$vtag_count++;
			}
			else if ($type == self::TAG_TYPE_AUDIO)
			{
				if ($timestamp >= $ametadata_timestamp)
				{
					// for audio store the metadata times once per second at the most
					$ametadata_timestamp = max($timestamp - $timestamp % 1000, $ametadata_timestamp + 1000);
					$ametadata->addTag($timestamp, $last_pos + $size);
				}
				
				$atags .= $ainfo->addATag($timestamp, $size, $last_pos, $tot_asize);
				if (strlen($atags) > 100000)
				{
					$ainfo->write($atags);
					$atags = "";
				}
				$tot_asize += $size;
			}
			
			//echo "pos: $pos type: $type, size: $size, timestamp: $timestamp, kf: $keyframe, prev_kf: $prev_kf, tot_asize: $tot_asize\n";
			$last_pos = $this->pos;
		}

		$vinfo->appendTagNextKf($vtags, $vtags_chunk, true);
		$vinfo->write($vtags);
		$ainfo->write($atags);
		$vmetadata->write();
		$ametadata->write();
		
		$vinfo->close();
		$ainfo->close();
		$vmetadata->close();
		$ametadata->close();
		
		//$et1 = microtime(true);
		//echo "time: ".($et1 - $st1)."\n";
	}
	
	// use optimization to find first video time stamp
	public function getFirstVideoTimestamp()
	{
		if (!$this->isFlv())
			return -1;
			
		$info = $this->validateHelper(false);
		
		$res = $info->readTag(0);
		
		if ($res == null)
			return -1;
		else
			return $res[FLVInfoVideo::VTAG_FIELD_TIMESTAMP];
	}
	
	// DONT OPTIMIZED - get last timestamp by reading backwards from the end of the file
	public function getLastTimestamp()
	{
		if (!$this->isFlv())
			return 0;
			
		fseek($this->fh, -4 , SEEK_END); // go back 4 bytes
		
		$prev_tag_size_raw = fread ($this->fh, 4);
		$tag_size = unpack("N",  $prev_tag_size_raw);
		
		// go back 4 bytes AND the size of the tag + 4 bytes to get to the timestamp
		fseek ($this->fh, -$tag_size[1], SEEK_END);
		
		$data = fread ($this->fh, 4);
		$data = $data[3].substr($data, 0, 3);
		$res = unpack("N", $data);
		return $res[1];
	}
	
	public function isFlv()
	{
		if (!$this->status)
			return false;
			
		$header = $this->getHeader();
		
		return substr($header, 0, 3) == "FLV";
	}
	
	public function fileHasAudio()
	{
		if (!$this->isFlv())
			return null;
			
		$found_audio = false;
		
		$tag_count = 0;
		while ($tag =  $this->getNextTag())
		{
			list($type, $size, $timestamp, $keyframe, $start_pos) = $tag;
			
			if ($type == self::TAG_TYPE_AUDIO)
			{
				$found_audio = true;
				break;
			}
			
			if ( ++$tag_count > 3000 )
				break;
		}
		
		return $found_audio;
	}

	public function clipToNewFile($new_file, $from_msecs = 0, $to_msecs = 2147483647)
	{
		if (!$this->isFlv())
			return 0;
			
		if (!$to_msecs)
			$to_msecs = 2147483647;
			
		list($total_bytes, $duration, $from_byte, $to_byte) = $this->clip($from_msecs, $to_msecs);
		
		$new_fh = fopen($new_file , "wb");

		fwrite($new_fh , self::createFlvHeader());
		
		$has_audio = $has_video = false;

		$timestamp_offset = -1;
		
		$this->seek($from_byte);
		
		while (($data = $this->getNextTag(myFlvHandler::GET_NEXT_TAG_DATA)) && $to_byte >= $this->pos)
		{
			if ($timestamp_offset == -1)
			{
				$timestamp = unpack("N", $data[7].substr($data,4, 3));
				$timestamp_offset = -$timestamp[1];
			}
			
			$type = unpack("C", $data);
			if ($type[1] == myFlvHandler::TAG_TYPE_AUDIO)
				$has_audio = true;
			elseif ($type[1] == myFlvHandler::TAG_TYPE_VIDEO)
				$has_video = true;
				
			fwrite($new_fh, self::dumpTag($data, $timestamp_offset));
		}
		
		// fix header, otherwise ffmpeg will crash when working with a video only file having type 5 (audio + video)
		fseek($new_fh, 0, SEEK_SET);
		fwrite($new_fh , self::createFlvHeader($has_video, $has_audio));
		
		fclose($new_fh);
		
		return -$timestamp_offset;
	}
	
	//
	// clip will return a list of the following:
	// total_bytes - the total bytes in the clipped video. for an only_audio clip this will include only the audio tags
	// duration - the duration of the clipped video.
	// from_byte - byte offset to start from
	// to_byte - byte offset to stop at
	//
	public function clip($from_msecs = 0, $to_msecs = 2147483647, $only_audio = false)
	{
		if (!$this->status)
			return array (-1, 0, 0, 0);
			
		if ($to_msecs == -1)
			$to_msecs = 2147483647;
		
		//$st1 = microtime(true);
		
		if ($from_msecs >= $to_msecs)
		{
			// error = clip will contain no data
			return array (-1, 0, 0, 0);
			//return array ($total_bytes, $duration, $from_byte, $to_byte); // added the duration as 4rt parameter
		}
		
		$info = $this->validateHelper($only_audio);
		$ainfo = $this->validateHelper(true);
		
		// in case the flv has only audio force working in only_audio mode
		if (!$only_audio && !$info->hasTags())
		{
			$only_audio = true;
			$info = $this->validateHelper($only_audio);
		}
		
		$from_tag = $info->findTag($from_msecs);
		
		$timestamp = $from_tag[FLVInfoVideo::VTAG_FIELD_TIMESTAMP];
		
		if ($only_audio)
		{
			// our findTag returns a tag which is GREATER or EQUAL (timestamp wise),
			// finding a tag which is not exactly on the requested clip_from time
			// requires us to go back to the previous tag;
			if ($timestamp > $from_msecs)
			{
				$from_tag = $info->readTag($from_tag[FLVInfoVideo::VTAG_FIELD_INDEX] - 1);
			}
		}
		else // for video we must start from a keyframe
		{
			// our findTag returns a tag which is GREATER or EQUAL (timestamp wise),
			// finding a tag which is not a keyframe exactly on the requested clip_from time
			// requires us to go back to the previous keyframe;
			if ($timestamp > $from_msecs || !$from_tag[FLVInfoVideo::VTAG_FIELD_KEYFRAME])
			{
				$from_tag = $info->readTag($from_tag[FLVInfoVideo::VTAG_FIELD_PREV_KF]);
			}
		}
		
		$to_tag = $info->findTag($to_msecs);
		if (!$only_audio && $to_tag[FLVInfoVideo::VTAG_FIELD_TIMESTAMP] < $to_msecs) // maybe we have better audio tag
		{
			$to_audio_tag = $ainfo->findTag($to_msecs);
			if ($to_audio_tag)
			{
				// we found an audio tag greater or equal than to_msecs. we need to read the previous one
				// and make sure it comes after the video tag (we want to get closer to to_msecs)
				if ($to_audio_tag[FLVInfoVideo::VTAG_FIELD_POS] > $to_tag[FLVInfoVideo::VTAG_FIELD_POS])
				{
					$to_tag = $to_audio_tag;
				}
			}
		}
		
		$duration = $to_tag[FLVInfoVideo::VTAG_FIELD_TIMESTAMP] - $from_tag[FLVInfoVideo::VTAG_FIELD_TIMESTAMP];
		
		if ($only_audio) // for audio use the helper's total size field to pick up only audio tags
		{
			$total_bytes = $to_tag[FlvInfoAudio::ATAG_FIELD_TOT_SIZE] - $from_tag[FlvInfoAudio::ATAG_FIELD_TOT_SIZE] + $to_tag[FLVInfoVideo::VTAG_FIELD_SIZE];
		}
		else // for video just substract offset
		{
			$total_bytes = $to_tag[FLVInfoVideo::VTAG_FIELD_POS] - $from_tag[FLVInfoVideo::VTAG_FIELD_POS] + $to_tag[FLVInfoVideo::VTAG_FIELD_SIZE];
		}
		
		//$et1 = microtime(true);
		//echo "time: ".($et1 - $st1)."\n";
		
		return array($total_bytes, $duration, $from_tag[FLVInfoVideo::VTAG_FIELD_POS], $to_tag[FLVInfoVideo::VTAG_FIELD_POS] + $to_tag[FLVInfoVideo::VTAG_FIELD_SIZE]);
	}

	//
	// findBytesFromTimestamps works in one of 4 flows:
	// 1. video - only play flavor exists
	//	params: using_flavors is 0 and only_audio is false
	//	flow:
	//  start frame - keyframe LOWER or equal to the from_msecs timestamp
	//	last frame - video frame GREATER or equal to the to_msecs
	//  last timestamp - tag (either video or audio) following the to_bytes
	//
	// 2. video - play+edit flavors exist and we're working on the play flavor
	//	params: using_flavors is 1 and only_audio is false
	//	flow:
	//  start frame - keyframe GREATER or equal to the from_msecs timestamp 
	//	last frame - video frame GREATER or equal to the to_msecs
	//  last timestamp - tag (either video or audio) following the to_bytes
	//
	// 3. video - play+edit flavors exist and we're working on the edit flavor
	//	params: using_flavors is 2 and only_audio is false
	//	flow:
	//	start frame - keyframe LOWER or equal to the from_msecs timestamp
	//	last frame - frame (either video or audio) LOWER than the to_msecs
	//  last timestamp - to_msecs
	//    since the to_msecs tag is the first keyframe of the play flavor found before
	//	
	// 4. audio - 
	//	params: using_flavors is 0 and only_audio is true
	//	flow: grab frames according to from_msecs and to_msecs params
	//
	public function findBytesFromTimestamps(&$from_msecs, $to_msecs, &$from_byte, &$to_byte,
		&$total_bytes, &$last_timestamp, $only_audio = false, $using_flavors = 0 )
	{
		if (!$this->status)
			return false;
		
		$ainfo = $this->validateHelper(true);
		$info = $only_audio ? $ainfo : $this->validateHelper(false);
		
		$from_tag = $info->findTag($from_msecs);
		
		if ($from_tag)
		{
			if ($using_flavors == 1) // we're looking at the play flavor and searching for a starting keyframe
			{
				if (!$from_tag[FLVInfoVideo::VTAG_FIELD_KEYFRAME]) // we didnt land on a keyframe, grab the next one
				{
					$next_kf = $from_tag[FLVInfoVideo::VTAG_FIELD_NEXT_KF];
					if ($next_kf != $from_tag[FLVInfoVideo::VTAG_FIELD_INDEX]) // do we have anymore keyframes?
					{
						$from_tag = $info->readTag($next_kf);
					}
					else
					{
						$from_tag = null;
					}
				}
				
				if ($from_tag)
					$from_msecs = $from_tag[FLVInfoVideo::VTAG_FIELD_TIMESTAMP];
			}
			else if (!$only_audio) // we're looking at the edit flavor or at a play without edit
			{
				// if we didnt land on a keyframe or this isn't exactly the from_msecs time find the previous keyframe
				if (!$from_tag[FLVInfoVideo::VTAG_FIELD_KEYFRAME] || $from_tag[FLVInfoVideo::VTAG_FIELD_TIMESTAMP] != $from_msecs)
				{
					$from_tag = $info->readTag($from_tag[FLVInfoVideo::VTAG_FIELD_PREV_KF]);
				}
			}
			else // we're looking at audio tags
			{
				// if this isn't exactly the from_msecs time find the previous tag
				if ($from_tag[FLVInfoVideo::VTAG_FIELD_TIMESTAMP] != $from_msecs)
				{
					$from_tag = $info->readTag($from_tag[FLVInfoVideo::VTAG_FIELD_INDEX] - 1);
				}
			}
		}
		
		if (!$from_tag || $from_tag[FLVInfoVideo::VTAG_FIELD_TIMESTAMP] > $to_msecs) // if from is invalid or from > to abort
		{
			$from_msecs = $to_msecs;
			$from_byte = $to_byte = 0;
			$total_bytes = 0;
			return true;
		}
		
		$to_tag = $info->findTag($to_msecs);
		$to_tag_ts = $to_tag[FLVInfoVideo::VTAG_FIELD_TIMESTAMP];

		if ($using_flavors == 2) // play+edit flavors exist and we're working on the edit flavor 
		{
			// the edit flavor always ends on a keyframe which is the first keyframe of the play flavor
			// if we found a frame greater then play flavor start frame go one frame back
			if ($to_tag_ts > $to_msecs)
			{
				$to_tag = $info->readTag($to_tag[FLVInfoVideo::VTAG_FIELD_INDEX] - 1);
				
				// maybe there is an audio frame closer to the to_msecs
				$to_audio_tag = $ainfo->findTag($to_msecs);
				if ($to_audio_tag)
				{
					// we found an audio tag greater or equal than to_msecs. we need to read the previous one
					// and make sure it comes after the video tag (we want to get closer to to_msecs)
					$to_audio_tag = $ainfo->readTag($to_audio_tag[FLVInfoVideo::VTAG_FIELD_INDEX] - 1);
					if ($to_audio_tag[FLVInfoVideo::VTAG_FIELD_POS] > $to_tag[FLVInfoVideo::VTAG_FIELD_POS])
					{
						$to_tag = $to_audio_tag;
					}
				}
			}
		}
		else if (!$info->isLastTag($to_tag)) // if we got to the last tag it is useless to advance
		{
			// if we land on the exact timestamp, advance one video tag in order to find the next timestamp
			// which defines the length of the last tag we got

			if ($to_tag_ts == $to_msecs)
				$to_tag = $info->readTag($to_tag[FLVInfoVideo::VTAG_FIELD_INDEX] + 1);
				
			if (!$only_audio) // maybe there is a closer audio frame 
			{
				$to_audio_tag = $ainfo->findTag($to_tag_ts);
				// we want to use the tag which follows to_msecs, but only if it doenst preceeds our found video tag
				// (e.g. the video ends with multiple video tags without audio tags in between)
				if ($to_audio_tag[FLVInfoVideo::VTAG_FIELD_POS] < $to_tag[FLVInfoVideo::VTAG_FIELD_POS] &&
					$to_audio_tag[FLVInfoVideo::VTAG_FIELD_TIMESTAMP] > $to_tag_ts)
				{
					$to_tag = $to_audio_tag;
				}
			}
		}
		else if (!$only_audio && $to_tag_ts < $to_msecs)
		{
			// we are at the last video tag but there may be a further (and better) audio tag
			$to_audio_tag = $ainfo->findTag($to_msecs);
			if ($to_audio_tag[FLVInfoVideo::VTAG_FIELD_POS] > $to_tag[FLVInfoVideo::VTAG_FIELD_POS])
			{
				$to_tag = $to_audio_tag;
			}
		}

		$from_byte = $from_tag[FLVInfoVideo::VTAG_FIELD_POS];
		$to_byte = $to_tag[FLVInfoVideo::VTAG_FIELD_POS] - 1;
		
		if ($only_audio) // for audio use the helper's total size field to pick up only audio tags
		{
			$total_bytes = $to_tag[FlvInfoAudio::ATAG_FIELD_TOT_SIZE] - $from_tag[FlvInfoAudio::ATAG_FIELD_TOT_SIZE];
		}
		else // for video just substract offsets
		{
			$total_bytes = $to_tag[FLVInfoVideo::VTAG_FIELD_POS] - $from_tag[FLVInfoVideo::VTAG_FIELD_POS];
		}
		
		$last_timestamp += $to_tag[FLVInfoVideo::VTAG_FIELD_TIMESTAMP] - $from_tag[FLVInfoVideo::VTAG_FIELD_TIMESTAMP];
		
		return true;
	}
	
	public function dump($chunk_size, $from_byte, $to_byte, $only_audio = false)
	{
		$this->validateMetadata($only_audio);
		
		// find out if there are any audio tags when creating the header for a video dump
		// otherwise flash may act in a wierd way when playing the video.
		// for an audio dump assume there are audio tags (otherwise the dump is empty)
		if ($only_audio)
		{
			$has_vtags = false;
			$has_atags = true;
		}
		else
		{
			$vinfo = $this->validateHelper(false);
			$ainfo = $this->validateHelper(true);
			$has_vtags = $vinfo->hasTags();
			$has_atags = $ainfo->hasTags();
		}
		
		echo self::createFlvHeader($has_vtags, $has_atags);
		echo $this->getMetadata($only_audio);
	
		if ($only_audio) // dump only audio tags
		{
			$this->seek($from_byte);
			
			while($this->pos < $to_byte && $data = $this->getNextTag(myFlvHandler::GET_NEXT_TAG_DATA))
			{
				$type = unpack("C", $data);
				if ($type[1] == myFlvHandler::TAG_TYPE_AUDIO)
					echo $data;
			}
		}
		else // just read and dump
		{
			$length = $to_byte - $from_byte;
			
			if ( $length < $chunk_size )
			{
				// ASSUME the clipped content is small enough to serve in one chunk !
				$content = file_get_contents( $this->flv_file_name , null , null, $from_byte , $length );
				echo $content;
			}
			else
			{
				$this->seek($from_byte);
				
				while ( $from_byte < $to_byte ) // stop if the next chunk starts over the original end point
				{
					if ( $to_byte - $from_byte < $chunk_size )
					{
						// this is for the very last chunk  - make it as big of the what's left
						$chunk_size = $to_byte - $from_byte;
					}
					
					$content = fread( $this->fh , $chunk_size );
					echo $content;		
					$from_byte += $chunk_size;
				}
			}
		}
	}
	
	public static function fixRed5WebcamFlv($flv_file_name, $new_file)
	{
		$flv_wrapper = new myFlvHandler ( $flv_file_name );
		
		$header = $flv_wrapper->getHeader();
		
		// sort timestamps because of a bug in red5 webcam recording
		$sorted_tags = array();
		$index = "";
		$tag_count = 0;
		$last_pos = $flv_wrapper->pos;
		while ($tag = $flv_wrapper->getNextTag())
		{
			// list($type, $size, $timestamp, $keyframe, $start_pos) = $tag;
			
			$index = sprintf("%010d%06d", $tag[self::TAG_FIELD_TIMESTAMP], ++$tag_count);
			$sorted_tags[$index] = $last_pos;
			$last_pos = $flv_wrapper->pos;
		}

		ksort($sorted_tags, SORT_NUMERIC);
		
		$fh = fopen ( $new_file , "wb" );
		
		fwrite ( $fh , $header ) ;

		foreach($sorted_tags as $timestamp => $pos)
		{
			$flv_wrapper->seek($pos);
			
			list($type, $size, $timestamp, $keyframe, $start_pos, $data) = 
				$flv_wrapper->getNextTag(myFlvHandler::GET_NEXT_TAG_ALL);
				
			if ($size != self::TAG_WRAPPER_SIZE) // dont write tag with no actual data
				fwrite ( $fh , $data );
		}

		fclose ( $fh );
	}
}

class myFlvStaticHandler
{
	public static function isMultiFlavor ( $file_name )
	{
		$edit_file_name = myContentStorage::getFileNameEdit( $file_name );
		return ( file_exists ( $edit_file_name ) && filesize ( $edit_file_name ) > 0 ) ;
	}


	/**
		will return the edit file name if exists, else the original one
	*/
	public static function getBestFileFlavor ( $file_name  )
	{
		$edit_file_name = myContentStorage::getFileNameEdit( $file_name );
		if ( file_exists ( $edit_file_name ) && filesize ( $edit_file_name ) > 0 )
		{
			return $edit_file_name;
		}
		return $file_name;
	}
	
	public static function createHelpers($flv_file_name)
	{
		$flv = new myFlvHandler($flv_file_name);
		return $flv->createHelpers();
	}
	
	public static function getFirstVideoTimestamp($flv_file_name)
	{
		$flv = new myFlvHandler($flv_file_name);
		return $flv->getFirstVideoTimestamp();
	}
	
	public static function getLastTimestamp($flv_file_name)
	{
		$flv = new myFlvHandler($flv_file_name);
		return $flv->getLastTimestamp();
	}
	
	public static function isFlv($flv_file_name)
	{
		$flv = new myFlvHandler($flv_file_name);
		return $flv->isFlv();
	}
	
	public static function fileHasAudio($flv_file_name)
	{
		$flv = new myFlvHandler($flv_file_name);
		return $flv->fileHasAudio();
	}
	
	public static function fixRed5WebcamFlv($flv_file_name, $new_file)
	{
		$flv = new myFlvHandler($flv_file_name);
		return $flv->fixRed5WebcamFlv($flv_file_name, $new_file);
	}
	
	public static function clipToNewFile($flv_file_name, $new_file, $from_msecs = 0, $to_msecs = 2147483647)
	{
		$flv = new myFlvHandler($flv_file_name);
		return $flv->clipToNewFile($new_file, $from_msecs, $to_msecs);
	}
	
	public static function clip($flv_file_name, $from_msecs = 0, $to_msecs = 2147483647, $only_audio = false)
	{
		$flv = new myFlvHandler($flv_file_name);
		return $flv->clip($from_msecs, $to_msecs, $only_audio);
	}
	
	public static function findBytesFromTimestamps($flv_file_name, &$from_msecs, $to_msecs, &$from_byte, &$to_byte,
		&$total_bytes, &$last_timestamp, $only_audio = false, $using_flavors = false )
	{
		$flv = new myFlvHandler($flv_file_name);
		return $flv->findBytesFromTimestamps($from_msecs, $to_msecs, $from_byte, $to_byte,
			$total_bytes, $last_timestamp, $only_audio, $using_flavors);
	}
		
}

abstract class FlvInfo
{
	protected $flv_file_name;
	protected $info_file_name;
	protected $fh; // file handle
	
	public function FlvInfo($flv_file_name)
	{
		$this->flv_file_name = $flv_file_name;
		$this->info_file_name = $flv_file_name.$this->FILE_SUFFIX;
	}
	
	public function create()
	{
		$this->close();
		if ($this->exists()) // enfore the creation of a new file by deleting the current one
			@unlink($this->info_file_name);
		$this->fh = fopen($this->info_file_name, "wb");
	}
	
	public function open()
	{
		if ($this->exists())
		{
			$this->fh = fopen($this->info_file_name, "rb");
			return true;
		}
		
		return false;
	}
	
	public function validate()
	{
		if ($this->exists())
		{
			$flv_mtime = filemtime($this->flv_file_name);
			$info_mtime = filemtime($this->info_file_name);

			if ($info_mtime >= $flv_mtime)
				return true;
		}
		
		return false;
	}
	
	public function exists()
	{
		return file_exists($this->info_file_name);
	}

	public function close()
	{
		if ($this->fh)
		{
			fclose($this->fh);
			$this->fh = null;
		}
	}
	
	public function __destruct()
	{
		$this->close();
	}
	
}

class FlvInfoVideo extends FlvInfo
{
	protected $FILE_SUFFIX = ".vinfo";
	protected $TAG_INFO_SIZE = 16;
	
	protected $last_index;
	
	const VTAG_FIELD_INDEX = 0;
	const VTAG_FIELD_TIMESTAMP = 1;
	const VTAG_FIELD_SIZE = 2;
	const VTAG_FIELD_POS = 3;
	const VTAG_FIELD_PREV_KF = 4;
	const VTAG_FIELD_NEXT_KF = 5;
	const VTAG_FIELD_KEYFRAME = 6;
	
	public function open()
	{
		parent::open();
		$this->last_index = filesize($this->info_file_name) / $this->TAG_INFO_SIZE - 1;
	}

	public function hasTags()
	{
		return $this->last_index > -1;
	}
	
	public function isLastTag($tag)
	{
		return $tag[self::VTAG_FIELD_INDEX] == $this->last_index;
	}

	//
	// for video tag this will pack 5 out of 6 fields. the next_kf field will be appended later in addTagNextKf
	// as we dont know in advance where the next key frame will reside
	public function addVTag($timestamp, $size, $pos, $prev_kf, $keyframe)
	{
		return pack("NNNn", $timestamp, $size, $pos, ($prev_kf << 1) | $keyframe);
	}
	
	public function write($tags)
	{
		fwrite($this->fh, $tags);
	}
	
	//
	// given a bunch of tags since the last keyframe we can now append their next_kf field
	// after the last keyframe we just write 0 as the next_kf to mark the field as empty
	//
	public function appendTagNextKf(&$vtags, &$vtags_chunk, $end = false)
	{
		if ($end) // tags after the last kf (inclusive) should have 0 as the next_kf field
		{
			foreach($vtags_chunk as $vtag)
				$vtags .= $vtag."\0\0";
		}
		else
		{
			$next_kf = count($vtags_chunk);
			foreach($vtags_chunk as $vtag)
			{
				$vtags .= $vtag.pack("n", $next_kf);
				--$next_kf;
			}
		}
		
		$vtags_chunk = array();
	}
	
	protected function readPackedTag($index)
	{
		if ($index < 0)
			$index = 0;
			
		if ($index > $this->last_index)
			return null;
			
		fseek($this->fh, $index * $this->TAG_INFO_SIZE, SEEK_SET);
		$data = fread($this->fh, $this->TAG_INFO_SIZE);
		return $data;
	}
	
	public function readTag($index)
	{
		$tag = $this->readPackedTag($index);
		
		if (!$tag)
			return null;
		
		$res = unpack("N4", $tag);
		
		//$index, $timestamp, $size, $pos, $prev_kf, $next_kf, $keyframe;
		return array($index, $res[1], $res[2], $res[3], $index - ($res[4] >> 17), $index + ($res[4] & 0xffff), $res[4] & 0x10000);
	}
	
    public function findTag($timestamp)
    {
		//$st1 = microtime(true);
		
		$first = 0;
		$last = $this->last_index;
		$mid = ($first + $last) >> 1;
		
	    while (($first <= $last))
	    {
			$tag = $this->readTag($mid);
			$mid_timestamp = $tag[FLVInfoVideo::VTAG_FIELD_TIMESTAMP];
			
			if ($mid_timestamp == $timestamp)
				break;
			
			if ($timestamp < $mid_timestamp) {
				$last = $mid - 1;
			}
	    	else if($timestamp > $mid_timestamp)
	    	{
				$first = $mid + 1;
			}
	    	
			$mid = ($first + $last) >> 1;
	    }	
	    
		$res = $this->readTag($mid);
		
		if ($res[FLVInfoVideo::VTAG_FIELD_TIMESTAMP] < $timestamp && $mid < $this->last_index)
			$res = $this->readTag($mid + 1);

		//$et1 = microtime(true);
		//echo "time: ".($et1 - $st1)."\n";
		//print_r($res);
		
		return $res;
    }
}

class FlvInfoAudio extends FlvInfoVideo
{
	protected $FILE_SUFFIX = ".ainfo";
	protected $TAG_INFO_SIZE = 16;
	
	const ATAG_FIELD_TOT_SIZE = 4;

	public function addATag($timestamp, $size, $pos, $tot_asize)
	{
		return pack("N4", $timestamp, $size, $pos, $tot_asize);
	}
	
	public function readTag($index)
	{
		$tag = $this->readPackedTag($index);
		
		if (!$tag)
			return null;
		
		$res = unpack("N4", $tag);
		
		//$timestamp, $size, $pos, $tot_asize;
		return array($index, $res[1], $res[2], $res[3], $res[4]);
	}
}

class FlvMetadataVideo extends FlvInfo
{
	protected $FILE_SUFFIX = ".vmetadata";
	
	private $duration = 0;
	private $keyframeTimes = array();
	private $keyframeBytes = array();
	
	public function addTag($timestamp, $pos)
	{
		$this->keyframeTimes[] = $timestamp;
		$this->keyframeBytes[] = $pos;
		
		$this->duration = $timestamp;
	}
	
	public function getSize()
	{
		return filesize($this->info_file_name);
	}
	
	public function dump()
	{
		return file_get_contents($this->info_file_name);
	}
	
	public function write()
	{
		$amfSerializer = new FLV_Util_AMFSerialize();

		$metadata_data = array();

		// theses will be used as placeholders for dynamic data
		$metadata_data["duration"] = (int)($this->duration / 1000) ;
		$metadata_data["timeOffset"] = 0 ;
		$metadata_data["bytesOffset"] = 0 ;

		$metadata_data["times"] = $this->keyframeTimes ;
		$metadata_data["filepositions"] = $this->keyframeBytes;

		$data = $amfSerializer->serialize( 'onMetaData').$amfSerializer->serialize($metadata_data);
		$data_len = strlen($data);

		$metatagSize = myFlvHandler::TAG_WRAPPER_SIZE + $data_len;
		
		for ($i = 0 ; $i < count ( $this->keyframeBytes ) ; ++$i )
		{
			$metadata_data["filepositions"][$i] += $metatagSize;
		}

		$res = $amfSerializer->serialize('onMetaData').$amfSerializer->serialize($metadata_data);
		
		$meta_tag = myFlvHandler::createMetadataTag($data);

		file_put_contents($this->info_file_name, $meta_tag);
		
		$meta_tag = null;
		$amfSerializer = null;
	}
}

class FlvMetadataAudio extends FlvMetadataVideo
{
	protected $FILE_SUFFIX = ".ametadata";
}

?>