<?php
class saysmeConvert 
{
	private static $project_dir;
	private static $log_file;
	private static $fh; // log file handler
	
	public function saysmeConvert ( $project_dir )
	{
		self::$project_dir = $project_dir;
	}
	
	public function alreadyExists ( $orig_file_path , saysmeJobData $slate_data , $working_dir = null )
	{
		if ( !$working_dir)
		{
			$working_dir = dirname ( $orig_file_path ) . "/" . pathinfo( $orig_file_path , PATHINFO_FILENAME ) . "/" ;
		}
		$final_result = "$working_dir/" . $slate_data->isci . ".mpg";//<ISCI_ID>.mpg
		$exists = file_exists( $final_result ) && filesize ( $final_result ) > 10000;  
		return array ( $final_result , $exists ) ;
	}
	
	public function convert ( $orig_file_path , saysmeJobData $slate_data , $working_dir = null , $copy_orig_to_workdir , batchJobProgress $progress )
	{
		if ( !$working_dir)
		{
			$working_dir = dirname ( $orig_file_path ) . "/" . pathinfo( $orig_file_path , PATHINFO_FILENAME ) . "/" ;
		}
		
		self::fullMkdir( $working_dir . "/dummy.txt" );

		self::startLog ( $working_dir . "/log" );
		
		sleep(1);
		if( $copy_orig_to_workdir )
		{
			$target = $working_dir . "/" . pathinfo($orig_file_path , PATHINFO_BASENAME );
			self::log ( "Now copying [$orig_file_path] -> [$target]");
			copy ( $orig_file_path , $target );
		}
			
	$progress->incStep( "converting" );
		
		$audio_silence_file = self::$project_dir . "/silence/sec_48khz_384k.mp2";
		$size = "720x480";
		$rate = "29.97";
		$rate_2 = "59.94";
		
		$slate_template = self::$project_dir . "/slate_template/slate.png";
		
		$video_out = "$working_dir/video.m2v";
		$audio_out = "$working_dir/audio.wav";
		$audio_out_mp2 = "$working_dir/audio.mp2";
		$video_after_cat = "$working_dir/video_after_cat.m2v";
		$audio_after_cat = "$working_dir/audio_after_cat.mp2";
		
		$final_muxed_video_audio = "$working_dir/final_muxed.mpg";
		$final_result = "$working_dir/" . $slate_data->isci . ".mpg";//<ISCI_ID>.mpg 
		
		$slate_video = $this->createSlateVideo ( $slate_template , $slate_data , $working_dir );
	$progress->incStep();
		
		$black_video = $this->createBlackVideo ( self::$project_dir );
	$progress->incStep();
		
		// ffmpeg: orig.mov -> video.m2v
		self::log ( "[ENCODE VIDEO TO SPEC]" );
		// ffmpeg -i 381.mov -an -r 59.94 -s 720x480 -vcodec mpeg2video -b 18432k -pix_fmt yuv422p video.m2v
		self::ffmpeg ( $orig_file_path , $video_out , $size , $rate_2 ,  "-an -vcodec mpeg2video -b 18432k -pix_fmt yuv422p " );
	$progress->incStep();
	
		// ffmpeg: orig.mov -> audio.wav
		self::log ( "[ENCODE AUDIO TO PCM]" );
		//ffmpeg -i 381.mov -vn -ar 48000 -ac 2 audio.wav
		self::ffmpeg ( $orig_file_path , $audio_out , "" , "" , "-vn -ar 48000 -ac 2 " );
	$progress->incStep();
	
		// normalize: audio.wav
		self::log ( "[NORMALIZE]" );
		self::normalize ( "--amplitude=-20dBFS {$audio_out}" );
	$progress->incStep();		

		// ffmpeg: audio.wav -> audio.mp2
		self::log ( "[ENCODE AUDIO TO SPEC]" );
		//ffmpeg -i audio.wav -vn -acodec mp2 -ab 384k -ar 48000 -ac 2 audio.mp2 
		self::ffmpeg ( $audio_out , $audio_out_mp2 , "" , "" , "-vn -acodec mp2 -ab 384k -ar 48000 -ac 2" );
	$progress->incStep();

		
		// concat video black , 5 X slate , black , video.m2v , black,black -> video_after_cat.m2v
		self::log ( "[CONCATENATE VIDEO FILES]" );
		self::concat ( $video_after_cat , 
			$black_video , 
			$slate_video , 
			$slate_video , 
			$slate_video , 
			$slate_video , 
			$slate_video , 
			$black_video , 
			$video_out ,
			$black_video ,
			$black_video );
	$progress->incStep();
	
		// concat audio 7 X silence , audio.wav , silence, silence-> audio_after_cat.mp2
		self::log ( "[CONCATENATE AUDIO FILES]" );
		self::concat ( $audio_after_cat , 
			$audio_silence_file , 
			$audio_silence_file , 
			$audio_silence_file  , 
			$audio_silence_file , 
			$audio_silence_file , 
			$audio_silence_file , 
			$audio_silence_file , 
			$audio_out_mp2 ,
			$audio_silence_file ,
			$audio_silence_file );
			
	$progress->incStep( "muxing video & audio" );
	
		// ffmpeg: mux video & audio -> final.mpg
		self::log ( "[FINAL MUX + ENCODE]" );
		//ffmpeg -i video_after_cat.m2v -i audio_after_cat.mp2 -acodec mp2 -ab 384k -ar 48000 -ac 2 -r 59.94 -s 720x480 -vcodec mpeg2video -b 18432k -pix_fmt yuv422p -f mpegts final.mpg
		self::ffmpeg ( array ( $video_after_cat , $audio_after_cat ) , $final_muxed_video_audio ,$size , $rate_2 ,
			 "-acodec mp2 -ab 384k -ar 48000 -ac 2 -vcodec mpeg2video -b 18432k -pix_fmt yuv422p -f mpegts" );	
	$progress->incStep( "creating interlaced version" );

	
		self::log ( "[Interlace]" );
		// mencoder: interlace final.mpg -> <ISCI_ID>.mpg
		//mencoder final.mpg -ofps 60 -of mpeg -noskip -mc 0 -vf softskip,expand=0:-32:0:16 -ovc lavc -oac copy -lavcopts vcodec=mpeg2video:vbitrate=9800:vrc_minrate=9800:vrc_maxrate=9800:vstrict=0:vrc_buf_size=1835:keyint=18:ildct:ilme:top=1:format=422P:vmax_b_frames=0:idct=2:trell:mbd=2:vhq -mpegopts format=mpeg2:muxrate=10500 -o final_i.mpg
		self::mencoder ( " $final_muxed_video_audio -ofps 60 -of mpeg -noskip -mc 0 -vf softskip,expand=0:-32:0:16 -ovc lavc -oac copy -lavcopts vcodec=mpeg2video:vbitrate=9800:vrc_minrate=9800:vrc_maxrate=9800:vstrict=0:vrc_buf_size=1835:keyint=18:ildct:ilme:top=1:format=422P:vmax_b_frames=0:idct=2:trell:mbd=2:vhq -mpegopts format=mpeg2:muxrate=10500 -o $final_result" );
		
		// TODO - hack !!
		// if the resutl of the interlace is very small (100 b), copy the non-interlaced version so it will be sent via FTP to the target
		// TODO - should remove once the mencoder command line indeed interlaces the result 
		if ( filesize ( $final_result ) < 100 )		
		{
					// create a non-interlaced file 
			copy ( $final_muxed_video_audio , $final_result );
		}
		
	$progress->incStep( "conversion done");
	
		self::closeLog();
		
		return array ( $final_result , self::$log_file );
	}

	// create a 1 second video
	//ffmpeg -r 29.97 -i slate%d.jpg -an -r 59.94 -s 720x480 -vcodec mpeg2video -b 18432k -pix_fmt yuv422p sec422@59.94.m2v
	public function createSlateVideo ( $slate_template,  saysmeJobData $slate_data , $working_dir  )
	{
		self::fullMkdir ( $working_dir . "/slate/dummy.txt" );
		
		$source = $this->createSlateImage ( $slate_template , $slate_data , $working_dir );
		// make 30 copies
		for ( $i=1 ; $i<=30 ; $i++ )
		{
			copy ( $source , $working_dir . "/slate/slate$i.jpg" );
		}
		// create 30 images of text in the slate dir with the name slate1.jpg ->slate30.jpg
		
		$slate_video = $working_dir . "/slate/slate.m2v";
		 
		self::log ( "[SLATE SEC VIDEO]" ) ;// prepare 30 jpeg frames
		//ffmpeg -r 29.97 -i slate%d.jpg -an -r 59.94 -s 720x480 -vcodec mpeg2video -b 18432k -pix_fmt yuv422p sec422@59.94.m2v
		self::ffmpeg( $working_dir . "/slate/slate%d.jpg" , $slate_video , "720x480" , "59.94" ,
			"-an -vcodec mpeg2video -b 18432k -pix_fmt yuv422p" , true , "-r 29.97" );
		
		return $slate_video;
	}
	
	public function createSlateImage ( $slate_template , saysmeJobData $slate_data , $working_dir )
	{
		$output_slate_img = $working_dir . "/slate/slate.jpg"; 		
		$srcIm = imagecreatefrompng( $slate_template );

		$color = imagecolorallocate($srcIm, 0, 0, 0);
//		$color = imagecolorallocate($srcIm, 255, 255, 0);
		$font = dirname($slate_template)."/arial.ttf";
		
		$font_size = 14;
		$x = 80;
		$y=150;
		$y_delta=22;
		imagettftext($srcIm, $font_size, 0, $x, $y , $color, $font, "Says Me TV" );
		imagettftext($srcIm, $font_size, 0, $x, $y+=$y_delta , $color, $font, "ISCI: " . $slate_data->isci);		
		imagettftext($srcIm, $font_size, 0, $x, $y+=$y_delta , $color, $font, "Spot Title: " . $slate_data->spot_title);
		imagettftext($srcIm, $font_size, 0, $x, $y+=$y_delta , $color, $font, "Date " . $slate_data->date );
		imagettftext($srcIm, $font_size, 0, $x, $y+=$y_delta , $color, $font, $slate_data->duration . " seconds" );
//		 imagettftext($im, 8, 0, 5, 20, $color, $font, $text);

/*		$text = $kuser->getFullName();//'Kshow '.$id;
		imagettftext($im, 8, 0, 6, 51, $grey, $font, $text);
		imagettftext($im, 8, 0, 5, 50, $color, $font, $text);
*/
		
		imagejpeg($srcIm, $output_slate_img);
		imagedestroy($srcIm);
		return $output_slate_img;
		
	}
	public function createBlackVideo (  $working_dir  )
	{
		// this should already exits
		self::fullMkdir ( $working_dir . "/black/" );
		
		$black_video = $working_dir ."/black/black.m2v";
		
		self::log ( "[BLACK SEC VIDEO]" ); // prepare 30 jpeg frames
		if ( !file_exists ($black_video  ) )
		{
			self::ffmpeg( "$working_dir/black/black%d.jpg" , $black_video , "720x480" , "59.94" , 
				"-an -vcodec mpeg2video -b 18432k -pix_fmt yuv422p -vcodec mpeg2video " , true , "-r 29.97" );
			
/*
 * 			ffmpeg -r 29.97 -i C:\web\kaltura\projects\saysme/black/black%d.jpg -s 720x480 -r 59.94  -an -vcodec mpeg2video -b 18432k -pix_fmt yuv422p -vcodec mpeg2video  -y C:\web\kaltura\projects\saysme/black/black.m2v
 * 			
 */
		//	ffmpeg -r 29.97 -i black%d.jpg -an -r 59.94 -s 720x480 -vcodec mpeg2video -b 18432k -pix_fmt yuv422p -vcodec mpeg2video sec422@59.94.m2v
		}
		
		return $black_video;
	}

	
	public static function fullMkdir($path, $rights = 0777)
	{
		TRACE ( "Creating directory [$path]");
		
		if ( file_exists( dirname( $path ))) return;
		$folder_path = array(strstr($path, '.') ? dirname($path) : $path);
		$folder_path = str_replace( "\\" , "/" , $folder_path);
		while(!@is_dir(dirname(end($folder_path)))
		&& dirname(end($folder_path)) != '/'
		&& dirname(end($folder_path)) != '.'
		&& dirname(end($folder_path)) != '')
		array_push($folder_path, dirname(end($folder_path)));

		while($parent_folder_path = array_pop($folder_path))
		{
			if ( ! file_exists( $parent_folder_path ))
			{
				if(!@mkdir($parent_folder_path, $rights))
				{
					//user_error("Can't create folder \"$parent_folder_path\".");
				}
				else
				{
					@chmod($parent_folder_path, $rights);
				}
			}
			else
			{
				@chmod($parent_folder_path, $rights);
			}
		}
	}
	
	public static function ffmpeg ( $in_file_path , $video_out , $size , $rate , $params , $skip_validation = false , $data_before_input = "" )
	{
		if ( !is_array ( $in_file_path ) )
			$in_arr = array ($in_file_path);
		else
			$in_arr = $in_file_path;
		
		if ( ! $skip_validation )
		{ 
			foreach ( $in_arr as $in_file_path )
			{ 			  
				if ( ! file_exists ( $in_file_path ))
				{
					self::log ( "Error ! file [$in_file_path] does not exist" );
					return;
				}
			}		
		}
		
//		$output = array ();
		$return_value = "";
		
		$exec_cmd = "ffmpeg $data_before_input ";
		foreach ( $in_arr as $in_file_path )
		{
			$exec_cmd .= " -i $in_file_path " ; 
		}
		
		$exec_cmd .=	 
			($size ? "-s $size" : "" ) . " " .
			($rate ? "-r $rate" : "" ) . " " .
			" $params -y $video_out 2>&1 >>" . self::$log_file . ".encoders";  
		
		self::log ( "> $exec_cmd");
		self::log ( "-------------------------------------");
		
		ob_start();
		passthru($exec_cmd);
		$output = ob_get_contents();
		ob_end_clean();
		self::log ( $output , false ); 
		self::log ( "-------------------------------------");
		self::log ( "< $exec_cmd");
	}
	
	public static function mencoder ( $cmd )
	{
		$exec_cmd = "mencoder  $cmd 2>&1 >>" . self::$log_file . ".encoders";     
		
		self::log ( "> $exec_cmd");
		self::log ( "-------------------------------------");
		ob_start();
		passthru($exec_cmd);
		$output = ob_get_contents();
		ob_end_clean();		 
		self::log ( "-------------------------------------");
		self::log ( "< $exec_cmd");		
	}
	
	public static function normalize ( $cmd )
	{
		$exec_cmd = "normalize  $cmd 2>&1 >>" . self::$log_file . ".encoders";  
		
		self::log ( "> $exec_cmd");
		self::log ( "-------------------------------------");
		ob_start();
		passthru($exec_cmd);
		$output = ob_get_contents();
		ob_end_clean();		 
		self::log ( "-------------------------------------");
		self::log ( "< $exec_cmd");
	}
	
	// the rest of the parameters will be used as input files
	public static function concat ( $output_file )
	{
/*		$exec_cmd = "cat ";
		$files=0;
		$args = func_get_args();
		array_shift ( $args );
		
		foreach ( $args as $file_name )
		{
			$exec_cmd .= " $file_name ";
			$files++;
		}
	
		$exec_cmd .= " > $output_file" ;
		exec($exec_cmd);
		$output = ob_get_contents();
		self::log ( "Concatenated [$output_file] from $files files");
		return;
*/		
		
		$out_fh = fopen($output_file,'w');
              
		$args = func_get_args();
		array_shift ( $args );
		$res = "";
		$files=0;
		foreach ( $args as $file_name )
		{
			$in_fh = fopen ( $file_name , 'r');
			fwrite ( $out_fh , fread ( $in_fh , filesize ($file_name )) );
			fclose ( $in_fh );
			$files++;
		}
		fclose ( $out_fh ); 

		self::log ( "Concatenated [$output_file] from $files files");
	}

	public static function startLog ( $file_name )
	{
		self::$log_file = $file_name;
		if ( file_exists ( $file_name) ) rename ($file_name , $file_name.".".time()); // moev log aside
		self::$fh = fopen(self::$log_file, 'w') ;
		fwrite( self::$fh , "---------------- starting log ----------------" . "\n" );
	}		
	
	public static function log ( $str , $add_date=true)
	{
		$date_str = date ( "Y-m-d H:i:s.U" );
		echo $date_str . " " . $str . "\n";
		
		fwrite( self::$fh , $date_str . " " . $str . "\n" );
	}

	private static function closeLog()
	{
		if ( self::$fh ) fclose(self::$fh);
	}
}

?>