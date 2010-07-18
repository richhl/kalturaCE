<?php

include_once("KDLCommon.php");
include_once("KDLMediaDataSet.php");
include_once("KDLFlavor.php");

	/* ===========================
	 * KDLTranscoderCommand
	 */
class KDLTranscoderCommand {
	
			public $_vidId;
			public $_vidBr;
			public $_vidWid;
			public $_vidHgt;
			public $_vidFr;
			public $_vidGop;
			public $_vid2pass;
			public $_vidRotation;
			
			public $_audId;
			public $_audBr; 
			public $_audCh;
			public $_audSr;
			
			public $_conId;
			
			public $_inFileName=KDLCmdlinePlaceholders::InFileName;
			public $_outFileName=KDLCmdlinePlaceholders::OutFileName;
			public $_clipTime=null;
	
	public function KDLTranscoderCommand($inFileName=KDLCmdlinePlaceholders::InFileName, $outFileName=KDLCmdlinePlaceholders::OutFileName, $clipTime=null)
	{
		$this->_inFileName=$inFileName;
		$this->_outFileName=$outFileName;
		$this->_clipTime=$clipTime;
	}
	
	/* ---------------------------
	 * Generate
	 */
	public function Generate($transcoder, $maxVidRate, $extra=null)
	{
		$transCmd=null;
		switch($transcoder){
			case KDLTranscoders::KALTURA:
				$transCmd=$transcoder;
				break;
			case KDLTranscoders::ON2:
				$transCmd=$this->CLI_Encode($extra);;
				break;
			case KDLTranscoders::FFMPEG:
				$this->fixVP6BitRate($maxVidRate);
				$transCmd=$this->FFMpeg($extra);
				break;
			case KDLTranscoders::MENCODER:
				$this->fixVP6BitRate($maxVidRate);
				$transCmd=$this->Mencoder($extra);
				break;
			case KDLTranscoders::ENCODING_COM:
				$transCmd=$transcoder;
				break;
			case KDLTranscoders::FFMPEG_AUX:
				$this->fixVP6BitRate($maxVidRate);
				$transCmd=$this->FFMpeg_aux($extra);
				break;
			case KDLTranscoders::EE3:
				$transCmd=$this->EE3($extra);
				break;
			case KDLTranscoders::FFMPEG_VP8:
				$transCmd=$this->FFMpeg_aux($extra);
				break;
		}
		return $transCmd;
	}
	
	/* ---------------------------
	 * FFMpeg
	 */
	public function FFMpeg($extra=null)
	{
	$cmdStr = null;
// rem ffmpeg -i <infilename> -vcodec flv   -r 25 -b 500k  -ar 22050 -ac 2 -acodec libmp3lame -f flv -t 60 -y <outfilename>
$vcodec = "fl";
$format = "fl";
$acodec = "libmp3lam";

		if($this->_inFileName){
			$cmdStr = "-i ".$this->_inFileName;
		}
		if($this->_vidId!="none"){
			switch($this->_vidId){
				case "flv":
				case "h263":
				case "vp6":
					$vcodec = "flv";
					break; 
				case "h264":
					$vcodec = "libx264";
					break;
				case "mpeg4":
					$vcodec = "mpeg4";
					break;
				case "theora":
					$vcodec = "libtheora";
					break;
				case "wmv2":
				case "wmv3":
				case "wvc1a":
					$vcodec = "wmv2";
					break;
				case KDLVideoTarget::VP8:
					$vcodec = "libon2vp8sdk";
					break; 
				case KDLVideoTarget::COPY:
					$vcodec = "copy";
					break; 
			}
			
			$cmdStr = $cmdStr." -vcodec ".$vcodec;
//			if($vid->_id=="h264")
//				$cmdStr = $cmdStr." -qmin 10";
			if($this->_vidBr){
				$cmdStr = $cmdStr." -b ".$this->_vidBr."k";
			}
			if($this->_vidWid!=null && $this->_vidHgt!=null){
				$cmdStr = $cmdStr." -s ".$this->_vidWid."x".$this->_vidHgt;
			}
			if($this->_vidFr!==null && $this->_vidFr>0){
				$cmdStr = $cmdStr." -r ".$this->_vidFr;
			}
			if($this->_vidGop!==null && $this->_vidGop>0){
				$cmdStr = $cmdStr." -g ".$this->_vidGop;
			}
		}
		else {
			$cmdStr = $cmdStr." -vn";
		}
		
		if($this->_audId!="none") {
			switch($this->_audId){
				case "mp3":
					$acodec = "libmp3lame";
					break;
				case "aac":
					$acodec = "libfaac";
					break;
				case "vorbis":
					$acodec = "libvorbis";
					break;
				case "wma":
					$acodec = "wmav2";
					break;
				case KDLAudioTarget::COPY:
					$acodec = "copy";
					break;
			}
			$cmdStr = $cmdStr." -acodec ".$acodec;
			if($this->_audBr!==null && $this->_audBr>0){
				$cmdStr = $cmdStr." -ab ".$this->_audBr."k";
			}
			if($this->_audSr!==null && $this->_audSr>0){
				$cmdStr = $cmdStr." -ar ".$this->_audSr;
			}
			if($this->_audCh!==null && $this->_audCh>0){
				$cmdStr = $cmdStr." -ac ".$this->_audCh;
			}
		}
		else {
			$cmdStr = $cmdStr." -an";
		}
		
		if($this->_clipTime!==null){
			$cmdStr = $cmdStr." -t ".$this->_clipTime;
		}
		
		if($this->_conId!="none") {
			switch($this->_conId){
				case "flv":
					$format = "flv";
					break;
				case "avi":
				case "mp4":
				case "3gp":
				case "mov":
				case "mp3":
				case "ogg":
					$format = $this->_conId;
					break;
				case KDLContainerTarget::WMV:
					$format = "asf";
					break;
				case KDLContainerTarget::MKV:
					$format = "matroska";
					break;
			}
			$cmdStr = $cmdStr." -f ".$format;
		}
		
		if($extra)
			$cmdStr = $cmdStr." ".$extra;
		
		if($this->_outFileName)
			$cmdStr = $cmdStr." -y ".$this->_outFileName;

		return $cmdStr;
	}

	/* ---------------------------
	 * Mencoder
	 */
	public function Mencoder($extra=null)
	{
	$cmdStr = null;
// mencoder <_INPUT_FILE_> -of lavf -ofps <_TRG_FR_> -oac mp3lame -srate <_TRG_ASAMPLE_RATE_> -ovc lavc -lavcopts vcodec=flv:vbitrate=<_TRG_BR_>:mbd=2:mv0:trell:v4mv:cbp:last_pred=3:keyint=100 –vf harddup -o <_TARGET_FILE_>
// mencoder 5.flv          -of lavf -lavfopts format=avi -ovc lavc -ofps 30 -lavcopts vcodec=x264:vbitrate=806:mbd=2:mv0:trell:v4mv:cbp:last_pred=3:keyint=60 -vf harddup,scale=640:352 -oac faac -faacopts mpeg=4:object=2:br=96 -srate 44100 -endpos 2 -o aaa1.flv
// mencoder $1             -of lavf -lavfopts format=avi -ovc x264 -ofps 25 -x264encopts bitrate=500:subq=5:8x8dct:frameref=2:bframes=3:b_pyramid:weight_b:threads=auto -vf scale=1280:720,harddup -nosound -endpos 4 -o $outputFile
	
$vcodec = "fl";
$format = "fl";

		if($this->_inFileName)
			$cmdStr = $cmdStr." ".$this->_inFileName;
		
		if($this->_conId!="none") {
			switch($this->_conId){
				case KDLContainerTarget::WMV:
					$format = "asf";
					break;
				default:
					$format = $this->_conId;
					break;
			}
			
			// This will not work for mp4 - TO FIX
			$cmdStr = $cmdStr." -of lavf -lavfopts format=".$format;
		}
		
		if($this->_vidId!="none"){
			if($this->_vidFr)
				$cmdStr = $cmdStr." -ofps ".$this->_vidFr;
			
			$vcodec = "flv";
			switch($this->_vidId){
				case "flv":
				case "h263":
				case "vp6":
					$vcodec = "flv";
					$cmdStr = $cmdStr." -ovc lavc";
					$cmdStr = $cmdStr." -lavcopts vcodec=".$vcodec;
					if($this->_vidBr) {
						$cmdStr = $cmdStr.":vbitrate=".$this->_vidBr;
					}
					$cmdStr = $cmdStr.":mbd=2:mv0:trell:v4mv:cbp:last_pred=3";
//					$cmdStr = $cmdStr.":mbd=2:mv0:trell:v4mv:cbp";
					break;
				case "h264":
					$vcodec = "x264";
					$cmdStr = $cmdStr." -ovc x264 -x264encopts";
					if($this->_vidBr) {
						$cmdStr .= " bitrate=".$this->_vidBr;
						$cmdStr .= ":";
					}
					else {
						$cmdStr .= " ";
					}
					$cmdStr = $cmdStr."subq=5:8x8dct:frameref=2:bframes=3:b_pyramid:weight_b:threads=auto";
					break;
				case "mpeg4":
					$cmdStr = $cmdStr." -ovc lavc";
					$cmdStr = $cmdStr." -lavcopts vcodec=mpeg4";
					if($this->_vidBr) {
						$cmdStr = $cmdStr.":vbitrate=".$this->_vidBr;
					}
					break;
				case "wmv2":
				case "wmv3":
				case "wvc1a":
					$cmdStr = $cmdStr." -ovc lavc";
					$cmdStr = $cmdStr." -lavcopts vcodec=wmv2";
					if($this->_vidBr) {
						$cmdStr = $cmdStr.":vbitrate=".$this->_vidBr;
					}
					break;
			}

			if($this->_vidGop!==null && $this->_vidGop>0)
				$cmdStr = $cmdStr.":keyint=".$this->_vidGop;
			$cmdStr = $cmdStr." -vf harddup";
			if($this->_vidWid && $this->_vidHgt)
				$cmdStr = $cmdStr.",scale=".$this->_vidWid.":".$this->_vidHgt;
			if($this->_vidRotation)
				$cmdStr = $cmdStr.",rotate=1";
		}
		else {
			$cmdStr = $cmdStr." -novideo";
		}

// mencoder <_INPUT_FILE_> -of lavf -ofps <_TRG_FR_> -ovc lavc -lavcopts vcodec=flv:vbitrate=<_TRG_BR_>:mbd=2:mv0:trell:v4mv:cbp:last_pred=3:keyint=100 –vf harddup 
//-oac mp3lame -srate <_TRG_ASAMPLE_RATE_> -o <_TARGET_FILE_>

		if($this->_audId!="none") {
			if($this->_audId=="mp3"){
				$cmdStr = $cmdStr." -oac mp3lame -lameopts abr";
				if($this->_audBr)
					$cmdStr = $cmdStr.":br=".$this->_audBr;
//				if($aud->_channels)
//					$cmdStr = $cmdStr." -ac ".$aud->_channels;
			}
///web/kaltura/bin/x64/mencoder -endpos 2 $1 -of lavf -lavfopts format=avi -ovc x264 -ofps 25 -x264encopts bitrate=500 -vf scale=1280:720,harddup -oac faac -srate 48000 -channels 5 -faacopts mpeg=4:object=2:br=32 -o $outputFile
			else if($this->_audId=="aac"){
				$cmdStr = $cmdStr." -oac faac -faacopts mpeg=4:object=2";
				if($this->_audBr)
					$cmdStr = $cmdStr.":br=".$this->_audBr;
			}
			else if($this->_audId=="wma"){
				$cmdStr = $cmdStr." -oac lavc -lavcopts acodec=wmav2";
				if($this->_audBr)
					$cmdStr = $cmdStr.":abitrate=".$this->_audBr;
			}
			
			if($this->_audSr!==null)
				$cmdStr = $cmdStr." -srate ".$this->_audSr;
		}
		else {
			$cmdStr = $cmdStr." -nosound";
		}
		
		if($this->_clipTime!==null){
			$cmdStr = $cmdStr." -endpos ".$this->_clipTime;
		}
		
		if($extra)
			$cmdStr = $cmdStr." ".$extra;
		
		if($this->_outFileName)
			$cmdStr = $cmdStr." -o ".$this->_outFileName;

		return $cmdStr;
	}

	/* ---------------------------
	 * CLI_Encode
	 */
	public function CLI_Encode($extra=null)
	{
	$cmdStr = null;
//cli_encode -i $1 -r 25 -b 1200 -k 100 --FE2_VP6_CXMODE=1 --FE2_VP6_RC_MODE=3 --FE2_CUT_STOP_SEC=5 -o $outputFile 

		if($this->_inFileName)
			$cmdStr = $cmdStr."-i ".$this->_inFileName;
		
		if($this->_conId!="none") {
			//$format = $con->_id;
			// This will not work for mp4 - TO FIX
			//$cmdStr = $cmdStr." -of lavf -lavfopts format=".$format;
		}

		if($this->_vidId!="none"){
			switch($this->_vidId){
				case "h264":
					$cmdStr = $cmdStr." -c H264";;
					break;
				case "vp6":
				case "h263":
					default:
					$cmdStr = $cmdStr." -c VP6";
					break;
			}

			if($this->_vidFr)
				$cmdStr = $cmdStr." -r ".round($this->_vidFr);
			
			if($this->_vidBr)
				$cmdStr = $cmdStr." -b ".$this->_vidBr;
			if($this->_vidGop!==null && $this->_vidGop>0) 
				$cmdStr = $cmdStr." -k ".$this->_vidGop;
			if($this->_vidWid && $this->_vidHgt){
				if($this->_vidRotation)
					$cmdStr = $cmdStr." -h ".$this->_vidWid." -w ".$this->_vidHgt;
				else
					$cmdStr = $cmdStr." -w ".$this->_vidWid." -h ".$this->_vidHgt;
			}
		}
		
		if($this->_audId!="none") {
			if($this->_audBr!==null)
				$cmdStr = $cmdStr." -a ".$this->_audBr;
		}
		
		if($this->_vid2pass==true)
			$cmdStr = $cmdStr." --FE2_VP6_CXMODE=1 --FE2_VP6_RC_MODE=3";
		
		if($this->_clipTime!==null){
			$cmdStr = $cmdStr." --FE2_CUT_STOP_SEC=".$this->_clipTime;
		}
		
		if($extra)
			$cmdStr = $cmdStr." ".$extra;
		
		if($this->_outFileName)
			$cmdStr = $cmdStr." -o ".$this->_outFileName;

		return $cmdStr;
	}
	
	/* ---------------------------
	 * Encoding_com
	 */
	public function Encoding_com($extra=null)
	{
		return $this->CLI_Encode($extra);
	}

	/* ---------------------------
	 * FFMpeg_aux
	 */
	public function FFMpeg_aux($extra=null)
	{
		return $this->FFMpeg($extra);
	}

	/* ---------------------------
	 * fixVP6BitRate
	 */
	private function fixVP6BitRate($maxVidRate)
	{
		if($this->_vidBr){
			if($this->_vidId=="vp6")
				$this->_vidBr = round($this->_vidBr*KDLConstants::BitrateVP6Factor);
			if($this->_vidBr>$maxVidRate)
				$this->_vidBr=$maxVidRate;
		}
	}

	/* ---------------------------
	 * EE3
	 */
	public function EE3($extra=null)
	{
/*		
$tryXML = "<StreamInfo
                Size=\"512, 384\">
                <Bitrate>
                  <ConstantBitrate
                    Bitrate=\"1045\"
                    IsTwoPass=\"False\"
                    BufferWindow=\"00:00:05\" />
                </Bitrate>
              </StreamInfo>
";
		$xml = new SimpleXMLElement($tryXML);
*/
		if($this->_conId!="none") {
			$pinfo = pathinfo(__FILE__);
			$dir = $pinfo['dirname'];
			switch($this->_conId){
				case KDLContainerTarget::ISMV:
					$xmlTemplate = $dir.'/ismPresetTemplate.xml';
					break;
				case "mp4":
				case KDLContainerTarget::WMV:
				default:
					$xmlTemplate = $dir.'/wmvPresetTemplate.xml';
					break;
			}
			$xml = simplexml_load_file($xmlTemplate);
		}
		
		$xml->Job['OutputDirectory']=KDLCmdlinePlaceholders::OutDir;
		if($this->_inFileName){
			$xml->Job['DefaultMediaOutputFileName']=$this->_outFileName.".{DefaultExtension}";
		}
		if($this->_vidId!="none"){
$vidProfile=null;
			switch($this->_vidId){
				case "wmv2":
				case "wmv3":
				case "wvc1a":
				default:
					$vidProfile = $xml->MediaFile->OutputFormat->WindowsMediaOutputFormat->VideoProfile->AdvancedVC1VideoProfile;
					unset($xml->MediaFile->OutputFormat->WindowsMediaOutputFormat->VideoProfile->MainH264VideoProfile);					
					break;
				case "h264":
					$vidProfile = $xml->MediaFile->OutputFormat->WindowsMediaOutputFormat->VideoProfile->MainH264VideoProfile;
					unset($xml->MediaFile->OutputFormat->WindowsMediaOutputFormat->VideoProfile->AdvancedVC1VideoProfile);					
					break;
			}
			$vFr = 30;
			if($this->_vidFr!==null && $this->_vidFr>0){
				$vFr = $this->_vidFr;
				$vidProfile['FrameRate']=$this->_vidFr;
			}
			if($this->_vidGop!==null && $this->_vidGop>0){
				$kFr = round($this->_vidGop/$vFr);
				$mi = round($kFr/60);
				$se = $kFr%60;
				$vidProfile['KeyFrameDistance']=sprintf("00:%02d:%02d",$mi,$se);
			}
			if($this->_vidBr){
				$vidProfile->Streams->StreamInfo->Bitrate->VariableConstrainedBitrate['PeakBitrate'] = round($this->_vidBr*1.3);
				$vidProfile->Streams->StreamInfo->Bitrate->VariableConstrainedBitrate['AverageBitrate'] = $this->_vidBr;
			}
			if($this->_vidWid!=null && $this->_vidHgt!=null){
				$vidProfile->Streams->StreamInfo['Size'] = $this->_vidWid.", ".$this->_vidHgt;
			}
			
//			$strmInfo = clone ($vidProfile->Streams->StreamInfo[0]);
//			KDLUtils::AddXMLElement($vidProfile->Streams, $vidProfile->Streams->StreamInfo[0]);
			
		}
		else {
			unset($xml->MediaFile->OutputFormat->WindowsMediaOutputFormat->VideoProfile);				
		}

		if($this->_audId!="none"){
$audProfile=null;
			switch($this->_audId){
				case "wma":
				default:
					$audProfile = $xml->MediaFile->OutputFormat->WindowsMediaOutputFormat->AudioProfile->WmaAudioProfile;
					unset($xml->MediaFile->OutputFormat->WindowsMediaOutputFormat->AudioProfile->AacAudioProfile);					
					break;
				case "aac":
					$audProfile = $xml->MediaFile->OutputFormat->WindowsMediaOutputFormat->AudioProfile->AacAudioProfile;
					unset($xml->MediaFile->OutputFormat->WindowsMediaOutputFormat->AudioProfile->WmaAudioProfile);					
					break;
			}
/*
	Since there are certain constraints on those values for the EE3 presets, 
	those values are set in the templates only
	
			if($this->_audBr!==null && $this->_audBr>0){
				$audProfile->Bitrate->ConstantBitrate['Bitrate'] = $this->_audBr;
			}
			if($this->_audSr!==null && $this->_audSr>0){
				$audProfile['SamplesPerSecond'] = $this->_audSr;
			}
			if($this->_audCh!==null && $this->_audCh>0){
				$audProfile['Channels'] = $this->_audCh;
			}
*/
		}
//$stream = clone $streams->StreamInfo;
//		$streams[1] = $stream;
		//		print_r($xml);
		return $xml->asXML();
	}
}


?>