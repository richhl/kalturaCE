<?php
include_once("KDLCommon.php");
include_once("KDLMediaDataSet.php");

/* ===========================
 * KDLFlavor
 */
class KDLFlavor extends KDLMediaDataSet {

	const RedundantFlagBit = 1;
	const BitrateNonComplyFlagBit = 2;
	const MissingContentNonComplyFlagBit = 4;
	const ForceCommandLineFlagBit = 8;

	/* ---------------------
	 * Data
	 */
	public 	$_id = null;
	public  $_ready_behavior=null;
	public  $_tags=null;
	public	$_flags=0;
	public  $_name=null;
	public	$_isTwoPass=false;
	public	$_transcoders = array();
	public  $_extras = array();

	/* ----------------------
	 * Cont/Dtor
	 */
	public function __construct() {
		parent::__construct();
	}
	public function __destruct() {
		unset($this);
	}

	/* ----------------------
	 * ProcessRedundancy
	 */
	public function ProcessRedundancy(KDLFlavor $prevFlavor){
		$rv = true;
		/*
		 * If no video => keep the flavor
		 */
		if($this->_video!=null && $prevFlavor->_video!=null) {
			/*
			 * The previous flavor should be atleast FlavorBitrateRedundencyFactor
			 * away, else - remove the current flavor.
			 */
			if($this->_video->_bitRate/$prevFlavor->_video->_bitRate>KDLConstants::FlavorBitrateRedundencyFactor) {
				$this->_flags = $this->_flags | KDLFlavor::RedundantFlagBit;

				$this->_warnings[KDLConstants::VideoIndex][]= //"Redundant bitrate";
				KDLWarnings::ToString(KDLWarnings::RedundantBitrate);
			}
			else
			$rv = false;
		}

		if($this->_audio!=null && $prevFlavor->_audio!=null) {
			if($this->_audio->_bitRate==$prevFlavor->_audio->_bitRate) {
				$this->_flags = $this->_flags | KDLFlavor::RedundantFlagBit;

				$this->_warnings[KDLConstants::AudioIndex][]= //"Redundant bitrate";
				KDLWarnings::ToString(KDLWarnings::RedundantBitrate);
			}
			else
			$rv = false;
		}

		return $rv;
	}

	/* ---------------------------
	 * ValidateFlavor
	 */
	public function ValidateFlavor()
	{
		return parent::Initialize();
	}

	/* ---------------------------
	 * ToString
	 */
	public function ToString(){
		$rvStr = "flag(".$this->_flags."), ".parent::ToString();
		if(count($this->_errors)){
			$rvStr = $rvStr.",ERRS(".KDLUtils::arrayToString($this->_errors).")";
		}
		if(count($this->_warnings)){
			$rvStr = $rvStr.",WRNS(".KDLUtils::arrayToString($this->_warnings).")";
		}
		if(count($this->_transcoders)){
			$rvStr = $rvStr.",TRNS(".KDLUtils::arrayToString($this->_transcoders).")";
		}
		return $rvStr;
	}

	/* ---------------------------
	 * GenerateTarget
	 */
	public function GenerateTarget(KDLMediaDataSet $source) {
		if($source==null || !$source->IsDataSet() || $this->_flags&self::ForceCommandLineFlagBit) {
			kLog::log("FORCE ". $this->_flags);
			$target = clone $this;
			if($target->_video->_gop===null || $target->_video->_gop==0)
			$target->_video->_gop = KDLConstants::DefaultGOP;
				
			$target->_warnings[KDLConstants::ContainerIndex][] =
			KDLWarnings::ToString(KDLWarnings::ForceCommandline);
		}
		else {
			$target = $this->generateTargetFlavor($source);
			if($target->_video=="" && $target->_audio=="" && $target->_image==""){
				// "Invalid File - No media content";
				$target->_errors[KDLConstants::ContainerIndex][] = KDLErrors::ToString(KDLErrors::NoValidMediaStream);
			}

			if($target->validateTranscoders($source)==false){
				// "No valid transcoder";
				$target->_errors[KDLConstants::ContainerIndex][] = KDLErrors::ToString(KDLErrors::NoValidTranscoders);
			}
		}

		$cmdLineGenerator = $target->SetTranscoderCmdLineGenerator();
		foreach($target->_transcoders as $key => $extra) {
			$extra = $target->_extras[$key];
			$str = null;
			if($target->_video)
			$cmdLineGenerator->_vidBr = $target->_video->_bitRate;
			$target->_transcoders[$key]= $cmdLineGenerator->Generate($key, $this->_video->_bitRate, $extra);
		}

		return $target;
	}

	/* ---------------------------
	 * ValidateProduct
	 */
	public function ValidateProduct(KDLMediaDataSet $source, KDLFlavor $product)
	{
		$rv = $product->ValidateFlavor();

		if($this->_video!==null) {
			if($product->_video===null){
				$product->_errors[KDLConstants::VideoIndex][] = KDLErrors::ToString(KDLErrors::MissingMediaStream);
				$rv=false;
			}
			else {
				$prdVid = $product->_video;
				$trgVid = $this->_video;
				if($source) $srcVid = $source->_video;
				else $srcVid = null;
				if($srcVid && $prdVid->_duration<$srcVid->_duration*KDLConstants::ProductDurationFactor) {
					$product->_warnings[KDLConstants::VideoIndex][] =
					KDLWarnings::ToString(KDLWarnings::ProductShortDuration, $prdVid->_duration, $srcVid->_duration);
				}
				if($prdVid->_bitRate<$trgVid->_bitRate*KDLConstants::ProductBitrateFactor) {
					$product->_warnings[KDLConstants::VideoIndex][] = // "Product bitrate too low - ".$prdVid->_bitRate."kbps, required - ".$trgVid->_bitRate."kbps.";
					KDLWarnings::ToString(KDLWarnings::ProductLowBitrate, $prdVid->_bitRate, $srcVid->_bitRate);
				}
			}
		}

		if($this->_audio!==null) {
			if($product->_audio===null){
				$product->_errors[KDLConstants::AudioIndex][] = KDLErrors::ToString(KDLErrors::MissingMediaStream);
				$rv=false;
			}
			else {
				$prdAud = $product->_audio;
				$trgAud = $this->_audio;
				if($source) $srcAud = $source->_audio;
				else $srcAud = null;
				if($srcAud && $prdAud->_duration<$srcAud->_duration*KDLConstants::ProductDurationFactor) {
					$product->_warnings[KDLConstants::AudioIndex][] = // "Product duration too short - ".($prdAud->_duration/1000)."sec, required - ".($srcAud->_duration/1000)."sec.";
					KDLWarnings::ToString(KDLWarnings::ProductShortDuration, $prdAud->_duration, $srcAud->_duration);
				}
				if($prdAud->_bitRate<$trgAud->_bitRate*KDLConstants::ProductBitrateFactor) {
					$product->_warnings[KDLConstants::AudioIndex][] = // "Product bitrate too low - ".$prdAud->_bitRate."kbps, required - ".$trgAud->_bitRate."kbps.";
					KDLWarnings::ToString(KDLWarnings::ProductLowBitrate, $prdAud->_bitRate, $srcAud->_bitRate);
				}
			}
		}

		if($product->_video===null && $product->_audio===null) {
			// "Invalid File - No media content.";
			$product->_errors[KDLConstants::ContainerIndex][] = KDLErrors::ToString(KDLErrors::NoValidMediaStream);
		}
		kLog::log( ".PRD-->".$product->ToString());

		return $rv;
	}

	/* ------------------------------
	 * IsValid
	 */
	public function IsValid()
	{
		return (count($this->_errors)==0);
	}

	/* ------------------------------
	 * IsRedundant
	 */
	public function IsRedundant()
	{
		return ($this->_flags & KDLFlavor::RedundantFlagBit);
	}

	/* ------------------------------
	 * IsComply
	 */
	public function IsNonComply()
	{
		return ( ($this->_flags & KDLFlavor::BitrateNonComplyFlagBit)
		||($this->_flags & KDLFlavor::MissingContentNonComplyFlagBit));
	}

	/* ------------------------------
	 * IsInArray
	 */
	public function IsInArray(array $arr)
	{
		foreach($arr as $member) {
			if($this->_id==$member->_id) {
				return $member;
			}
		}
		return null;
	}

	/* ---------------------------
	 * EvaluateFileExt
	 */
	public function EvaluateFileExt()
	{
		return $this->_container->_id;
		switch($this->_container->_id){
			case "flv":
			case "avi":
			case "mp4":
			case "mov":
			case "3gp":
			case "ogg":
				return $this->_container->_id;
			default:
				return "flv";
		}
	}

	/* ---------------------------
	 * generateTarget
	 */
	private function generateTargetFlavor(KDLMediaDataSet $source) {
		$target = clone $this;
		if($this->_name!=null)
		$target->_name = $this->_name;
		if($this->_container!=""){
			$target->_container = clone $this->_container;
		}

		$target->_video = null;
		if($this->_video!="") {
			if($source->_video!=""){
				/*
				 * Evaluate flavor frame-size
				 */
				$target->_video = $this->evaluateTargetVideo($source->_video);
				if($target->_video->_bitRate<$this->_video->_bitRate*KDLConstants::FlavorBitrateCompliantFactor) {
					$target->_flags = $this->_flags | self::BitrateNonComplyFlagBit;
					$target->_warnings[KDLConstants::VideoIndex][] = // "The target flavor bitrate {".$target->_video->_bitRate."} does not comply with the requested bitrate (".$this->_video->_bitRate.").";
					KDLWarnings::ToString(KDLWarnings::TargetBitrateNotComply, $target->_video->_bitRate, $this->_video->_bitRate);
				}
			}
			/*
			 else {
				$target->_flags = $this->_flags | self::MissingContentNonComplyFlagBit;
				$target->_warnings[KDLConstants::VideoIndex][] = // "The target flavor bitrate {".$target->_video->_bitRate."} does not comply with the requested bitrate (".$this->_video->_bitRate.").";
				KDLWarnings::ToString(KDLWarnings::MissingMediaStream);
				}
				*/
		}

		$target->_audio = null;
		if($this->_audio!=""){
			if($source->_audio!=""){
				$target->_audio = $this->evaluateTargetAudio($source->_audio, $target);
			}
			/*
			 else {
				$target->_flags = $this->_flags | self::MissingContentNonComplyFlagBit;
				$target->_warnings[KDLConstants::AudioIndex][] = // "The target flavor bitrate {".$target->_video->_bitRate."} does not comply with the requested bitrate (".$this->_video->_bitRate.").";
				KDLWarnings::ToString(KDLWarnings::MissingMediaStream);
				}
				*/
		}
		return $target;
	}

	/* ---------------------------
	 * evaluateTargetVideo
	 */
	public function evaluateTargetVideo(KDLVideoData $source)
	{
		$targetVid = clone $this->_video;
		$flavorVid = $this->_video;
		$sourceVid = $source;

		if($this->_video->_id=="") {
			switch($this->_container->_id){
				case "flv":
					$targetVid->_id = "flv";
					break;
				case "avi":
					$targetVid->_id = "h264";
					break;
				case "mp4":
					$targetVid->_id = "h264";
					break;
				case "mov":
					$targetVid->_id = "h264";
					break;
				case "3gp":
					$targetVid->_id = "h264";
					break;
				case "ogg":
					$targetVid->_id = "theora";
					break;
				case KDLContainerTarget::WMV:
					$targetVid->_id = "wmv2";
					break;
				case KDLContainerTarget::ISMV:
					$targetVid->_id = "wvc1a";
					break;
			}
		}
		/*
		 * Evaluate flavor frame-size
		 */
		$this->evaluateTargetVideoFramesize($sourceVid, $targetVid);

		/*
		 * If flavor BR is higher than the source - keep the source BR
		 */
		$this->evaluateTargetVideoBitrate($sourceVid, $targetVid);

		/*
		 * If the flavor fps is zero, evaluate it from the source and
		 * the constants theshold.
		 */
		if($flavorVid->_frameRate==0) {
			$targetVid->_frameRate = $sourceVid->_frameRate;
			if($targetVid->_frameRate>KDLConstants::MaxFramerate) {
				$targetVid->_warnings[KDLConstants::VideoIndex][] =
				KDLWarnings::ToString(KDLWarnings::TruncatingFramerate, KDLConstants::MaxFramerate, $targetVid->_frameRate);
				$targetVid->_frameRate=KDLConstants::MaxFramerate;
			}
			// For webcam/h263 - if FR==0, set FR=24
			else if($targetVid->_frameRate==0 && $sourceVid->IsFormatOf(array("h.263")) ){
				$targetVid->_frameRate=24;
			}
		}

		if($flavorVid->_gop===null || $flavorVid->_gop==0) {
			$targetVid->_gop = KDLConstants::DefaultGOP;
		}

		$targetVid->_rotation = $sourceVid->_rotation;
		return $targetVid;
	}

	/* ---------------------------
	 * evaluateTargetVideoFramesize
	 */
	private static function evaluateTargetVideoFramesize(KDLVideoData $source, KDLVideoData $target) {

		$widSrc = $source->_width;
		$hgtSrc = $source->_height;
		$darSrcFrame = $widSrc/$hgtSrc;
		/*
		 * DAR adjustment
		 */
		if($source->_dar!="" && $source->_dar>0){
			$darSrc = $source->_dar;
			$diff = abs(1-$darSrc/$darSrcFrame);
			if($diff>0.1) {
				$widSrc = $darSrc*$hgtSrc;
				$darSrcFrame = $darSrc;
			}
		}

		/*
		 * Evaluate target frame size, either absolute
		 * or relative to source height
		 */
		/*
		 $widFlvr = 0;
		 if($target->_width==0 || $target->_width=="")
			$widFlvr = $target->_height*$darSrcFrame;
			else
			$widFlvr = $target->_width;

			//
			if($target->_height==0 || $target->_height=="" || $target->_height>$hgtSrc){
			$target->_height = $hgtSrc;
			$target->_width  = $widSrc;
			}
			else {
			$target->_height = $target->_height;
			$target->_width  = $widFlvr;
			}
			*/
		if(($target->_width==0 || $target->_width=="") && ($target->_height==0 || $target->_height=="")){
			$target->_height = $hgtSrc;
			$target->_width  = $widSrc;
		}
		else if($target->_width==0 || $target->_width==""){
			$target->_width = $target->_height*$darSrcFrame;
			if($target->_width>$widSrc) {
				$target->_height = $hgtSrc;
				$target->_width  = $widSrc;
			}
		}
		else if($target->_height==0 || $target->_height==""){
			$target->_height = $target->_width/$darSrcFrame;
			if($target->_height>$hgtSrc) {
				$target->_height = $hgtSrc;
				$target->_width  = $widSrc;
			}
		}
		else {
			if($target->_width>$source->_width) {
				$target->_width=$source->_width;
			}
			if($target->_height>$source->_height) {
				$target->_height=$source->_height;
			}
		}

		/*
		 * x16 - make sure both hgt/wid comply to
		 */
		$target->_height = round($target->_height);
		$target->_width  = round($target->_width);
		$target->_height = $target->_height -($target->_height%16);
		$target->_width  = $target->_width  -($target->_width%16);
	}
	private static function evaluateTargetVideoFramesize1(KDLVideoData $source, KDLVideoData $target) {

		$widSrc = $source->_width;
		$hgtSrc = $source->_height;
		$darSrcFrame = $widSrc/$hgtSrc;
		/*
		 * DAR adjustment
		 */
		if($source->_dar!="" && $source->_dar>0){
			$darSrc = $source->_dar;
			$diff = abs(1-$darSrc/$darSrcFrame);
			if($diff>0.1) {
				$widSrc = $darSrc*$hgtSrc;
				$darSrcFrame = $darSrc;
			}
		}

		/*
		 * Evaluate target frame size, either absolute
		 * or relative to source height
		 */
		if(($target->_width==0 || $target->_width=="") && ($target->_height==0 || $target->_height=="")){
			$target->_height = $hgtSrc;
			$target->_width  = $widSrc;
		}
		else if($target->_width==0 || $target->_width==""){
			$target->_width = $target->_height*$darSrcFrame;
		}
		else if($target->_height==0 || $target->_height==""){
			$target->_height = $target->_width/$darSrcFrame;
		}
		else {
			$darSrcFrame = $target->_width/$target->_height;
		}

		if($target->_height>$source->_height){
			$target->_height=$source->_height;
		}

		if($target->_width>$source->_width){
			$target->_width=$source->_width;
			$target->_height = $target->_width/$darSrcFrame;
		}
		/*
		 * x16 - make sure both hgt/wid comply to
		 */
		$target->_height = round($target->_height);
		$target->_width  = round($target->_width);
		$dimenGranularity = 16;
		/*
		 $dimenRemind = $target->_height%$dimenGranularity;
		 $target->_height = $target->_height-$dimenRemind;
		 if($dimenRemind>0.7*$dimenGranularity)
			$target->_height += $dimenGranularity;
			*/
		$target->_height = self::dimensionByGranularity($dimenGranularity, $target->_height);
		$target->_width = round($target->_height*$darSrcFrame);
		$target->_width  = self::dimensionByGranularity($dimenGranularity, $target->_width);
	}

	/* ---------------------------
	 *  dimensionByGranularity
	 */
	private static function dimensionByGranularity($gran, $dimen)
	{
		$reminder = $dimen % $gran;
		$dimen = $dimen-$reminder;
		if($reminder>0.7*$gran)
		$dimen += $gran;
		return (int)$dimen;
	}

	/* ---------------------------
	 * evaluateTargetVideoBitrate
	 */
	//bitrate calc should take in account source frame size(heightXwidth), relativly to the flavor/target frame size.
	//therefore the Evaluate frame sze should be called before this func
	private static function evaluateTargetVideoBitrate(KDLVideoData $source, KDLVideoData $target) {
		$ratioFlvr = KDLConstants::BitrateVP6Factor;
		switch($target->_id){
			case "h263":
			case "flv":
				$ratioFlvr = KDLConstants::BitrateH263Factor;
				break;
			case "vp6":
				$ratioFlvr = KDLConstants::BitrateVP6Factor;
				break;
			case "h264":
			case "wmv3":
			case "wvc1a":
				$ratioFlvr = KDLConstants::BitrateH264Factor;
				break;
		}
		//			$ratioFlvr = $ratioFlvr*$flavor->_height*$flavor->_height;
			
		$ratioSrc = KDLConstants::BitrateOthersRatio;
		switch($source->_id){
			case "h263":
			case "h.263":
			case "s263":
			case "flv1":
				$ratioSrc = KDLConstants::BitrateH263Factor;
				break;
			case "vp6":
			case "vp6e":
			case "vp6s":
			case "flv4":
				$ratioSrc = KDLConstants::BitrateVP6Factor;
				break;
			case "h264":
			case "h.264":
			case "x264":
			case "avc1":
			case "wvc1":
			case "avc":
			case "wmv3":
			case "wmva":
				$ratioSrc = KDLConstants::BitrateH264Factor;
				break;
		}
		//			$ratioSrc = $ratioSrc*$source->_height*$source->_height;

		$brSrcNorm = $source->_bitRate*($ratioSrc/$ratioFlvr);
		if($target->_bitRate>$brSrcNorm){
			$target->_bitRate = $brSrcNorm;
		}
		return $target->_bitRate = round($target->_bitRate, 0);
	}

	/* ---------------------------
	 * evaluateTargetAudio
	 */
	public function evaluateTargetAudio(KDLAudioData $source, KDLMediaDataSet $target)
	{
		$targetAud = clone $this->_audio;
		if($targetAud->_id=="" || $targetAud->_id==null) {
			if($target->_container!=null) {
				if($target->_container->_id=="3gp" || $target->_container->_id=="mp4"){
					$targetAud->_id="aac";
				}
				elseif ($target->_container->_id=="mp3"){
					$targetAud->_id="mp3";
				}
				elseif ($target->_container->_id=="ogg"){
					$targetAud->_id="vorbis";
				}
				else if($target->_container->_id=="flv"){
					$targetAud->_id="mp3";
				}
				else if($target->_container->_id==KDLContainerTarget::WMV || $target->_container->_id==KDLContainerTarget::ISMV){
					$targetAud->_id="wma";
				}
			}
			else if($target->_video!=null) {
				if($target->_video->_id=="h264") {
					$targetAud->_id="aac";
				}
				else if($target->_video->_id=="theora") {
					$targetAud->_id="vorbis";
				}
				else
				$targetAud->_id="mp3";
			}
			else {
				$targetAud->_id="mp3";
			}
		}
		elseif ($target->_container->_id=="mp3") {
			$targetAud->_id="mp3";
		}

		if($targetAud->_channels==0 && $targetAud->_id!="aac")
		$targetAud->_channels=2;
		if($targetAud->_sampleRate==0 && $targetAud->_id!="aac")
		$targetAud->_sampleRate=44100;

		return $targetAud;
	}

	/* ---------------------------
	 * validateTranscoders
	 * - Remove the engines that in the blacklist for that codec/format/etc
	 */
	private function validateTranscoders(KDLMediaDataSet $source){
		foreach($this->_transcoders as $key=>$flag) {

			/*
			 * Source Blacklist processing
			 */
			$this->checkBlackList(KDLConstants::$TranscodersSourceBlackList, $key, $source);

			/*
			 * Target Blacklist processing
			 */
			$this->checkBlackList(KDLConstants::$TranscodersTargetBlackList, $key, $this);

			/*
			 * Remove encoding.com for DAR<>PAR
			 */
			if($key==KDLTranscoders::ENCODING_COM
			&& $source->_video && $source->_video->_dar) {
				if(abs($source->_video->GetPAR()-$source->_video->_dar)>0.01) {
					unset($this->_transcoders[$key]);
					$this->_warnings[KDLConstants::VideoIndex][] = //"The transcoder (".$key.") does not handle properly DAR<>PAR.";
					KDLWarnings::ToString(KDLWarnings::TranscoderDAR_PAR, $key);
				}
			}
				
			/*
			 * Remove mencoder, encoding.com and cli_encode and ee3
			 * for audio only flavors
			 */
			if(($key==KDLTranscoders::MENCODER || $key==KDLTranscoders::ENCODING_COM || $key==KDLTranscoders::ON2  || $key==KDLTranscoders::EE3)
			&& $this->_video==null) {
				unset($this->_transcoders[$key]);
				$this->_warnings[KDLConstants::AudioIndex][] = //"The transcoder (".$key.") does not handle properly DAR<>PAR.";
				KDLWarnings::ToString(KDLWarnings::TranscoderLimitation, $key);
			}

			/*
			 * Remove encoding.com and ffmpegs
			 * for rotated videos
			 */
			if(($key==KDLTranscoders::ENCODING_COM || $key==KDLTranscoders::FFMPEG || $key==KDLTranscoders::FFMPEG_AUX)
			&& $this->_video && $this->_video->_rotation) {
				unset($this->_transcoders[$key]);
				$this->_warnings[KDLConstants::VideoIndex][] = //"The transcoder (".$key.") does not handle properly DAR<>PAR.";
				KDLWarnings::ToString(KDLWarnings::TranscoderLimitation, $key);
			}
		}
		if(count($this->_transcoders)){
			return true;
		}
		return false;
	}

	/* ---------------------------
	 * SetTranscoderCmdLineGenerator
	 */
	public function SetTranscoderCmdLineGenerator($inFile=KDLCmdlinePlaceholders::InFileName, $outFile=KDLCmdlinePlaceholders::OutFileName)
	{
		$cmdLine = new KDLTranscoderCommand($inFile,$outFile);

		if($this->_video){
			$cmdLine->_vidId = $this->_video->_id;
			$cmdLine->_vidBr = $this->_video->_bitRate;
			$cmdLine->_vidWid = $this->_video->_width;
			$cmdLine->_vidHgt = $this->_video->_height;
			$cmdLine->_vidFr = $this->_video->_frameRate;
			$cmdLine->_vidGop = $this->_video->_gop;
			$cmdLine->_vid2pass = $this->_isTwoPass;
			$cmdLine->_vidRotation = $this->_video->_rotation;
		}
		else
		$cmdLine->_vidId="none";
			
		if($this->_audio){
			$cmdLine->_audId = $this->_audio->_id;
			$cmdLine->_audBr = $this->_audio->_bitRate;
			$cmdLine->_audCh = $this->_audio->_channels;
			$cmdLine->_audSr = $this->_audio->_sampleRate;
		}
		else
		$cmdLine->_audId="none";
			
		if($this->_container){
			$cmdLine->_conId = $this->_container->_id;
		}
		else
		$cmdLine->_conId="none";

		return $cmdLine;
	}

	/* ---------------------------
	 * Blacklist processing
	 */
	private function checkBlackList($blackList, $transcoder, $mediaSet)
	{
		if(array_key_exists($transcoder, $blackList)) {
			foreach ($blackList[$transcoder] as $keyPart => $subBlackList){
				$sourcePart = null;
				switch($keyPart){
				case KDLConstants::ContainerIndex;
					$sourcePart = $mediaSet->_container;
					break;
				case KDLConstants::VideoIndex;
					$sourcePart = $mediaSet->_video;
					break;
				case KDLConstants::AudioIndex;
					$sourcePart = $mediaSet->_audio;
					break;
				default:
					continue;
				}
				if($sourcePart && is_array($subBlackList)
				&& (in_array($sourcePart->_id, $subBlackList)
				|| in_array($sourcePart->_format, $subBlackList))) {
					unset($this->_transcoders[$transcoder]);
					$this->_warnings[$keyPart][] = //"The transcoder (".$key.") can not process the (".$sourcePart->_id."/".$sourcePart->_format. ").";
					KDLWarnings::ToString(KDLWarnings::TranscoderFormat, $transcoder, ($sourcePart->_id."/".$sourcePart->_format));
					break;
				}
			}
		}
	}
}

#if 0
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
/* ===========================
 * KDLFlavor2Tags
 */
class KDLFlavor2Tags {
	static $ItunesFormats = array("mpeg-4","mpeg audio", "aiff", "wave");
	static $FlashFormats = array("flash video", "flv", "f4v","flash","flashvideo");
	static $FlashPlayableFormats = array("mpeg-4","mpeg audio");
	static $H264Synonyms = array("avc","avc1","h264","h.264");
	static $MP4ContainerSynonyms = array("mpeg-4", "mp4");

	/* ---------------------------
	 * ToTags
	 */

	public static function ToTags(KDLMediaDataSet $source, $tagsToCheck=null)
	{
		//		$aaa=KDLFlavor2Tags::$ItunesFormats;
		$tagsIn = array();
		$tagsOut = array();
		$flavor=null;
		if(is_array($tagsToCheck)) {
			if($tagsToCheck[0] instanceof KDLFlavor) {
				foreach($tagsToCheck as $tagToCheck) {
					$tagsOut = $tagsOut + KDLFlavor2Tags::ToTags($source, $tagToCheck);
					return $tagsOut;
				}
			}
			else {
				$tagsIn = $tagsToCheck;
			}
		}
		else if($tagsToCheck instanceof KDLFlavor) {
			$flavor = $tagsToCheck;
			if(is_array($tagsToCheck->_tags))
			$tagsIn = $tagsToCheck->_tags;
			else
			$tagsIn[0] = $tagsToCheck->_tags;
		}
		else {
			$tagsIn[0] = $tagsToCheck;
		}

		foreach($tagsIn as $tag) {
			switch($tag){
				case "web":
					if($source->_container->IsFormatOf(KDLFlavor2Tags::$FlashFormats))
					$tagsOut[] = $tag;
					else if(KDLFlavor2Tags::isMp4($source))
					$tagsOut[] = $tag;
					else if(KDLFlavor2Tags::isMpegAudio($source))
					$tagsOut[] = $tag;
					/*
					 else {
						if($source->_container->IsFormatOf(KDLFlavor2Tags::$FlashPlayableFormats)) {
						$audFormats = array("mpeg audio");
						if(($source->_video && $source->_video->IsFormatOf(KDLFlavor2Tags::$H264Synonyms))
						|| ($source->_audio && $source->_audio->IsFormatOf($audFormats))){
						$tagsOut[] = $tag;
						}
						}
						}
						*/
					break;
				case "itunes":
					if($source->_container->_id=="qt"
					|| $source->_container->IsFormatOf(KDLFlavor2Tags::$ItunesFormats))
					$tagsOut[] = $tag;
					break;
				case "mbr":
					if($flavor!=null && KDLFlavor2Tags::isMbr($source, $flavor))
					$tagsOut[] = $tag;
					break;
				default:
					break;
			}
		}

		return $tagsOut;
	}

	/* ---------------------------
	 * isMbr
	 */
	private static function isMbr(KDLMediaDataSet $source, KDLFlavor $flavor)
	{
		if($source->_container->IsFormatOf(KDLFlavor2Tags::$FlashFormats)
		&& $flavor->_container->IsFormatOf(KDLFlavor2Tags::$FlashFormats)) {
			;
		}
		else
		if(KDLFlavor2Tags::isMp4($source) && KDLFlavor2Tags::isMp4($flavor)) {
			;
		}
		else {
			return false;
		}
		/*

		if(!(($source->_container->IsFormatOf(KDLFlavor2Tags::$FlashFormats) && $flavor->_container->IsFormatOf(KDLFlavor2Tags::$FlashFormats))
		|| ($source->_container->IsFormatOf(array("mpeg-4")) && $source->_video->IsFormatOf(KDLFlavor2Tags::$H264Synonyms))
		) ) )
		return false;
		*/
		return true;
		return false;
	}

	/* ---------------------------
	 * isMp4
	 */
	private static function isMp4(KDLMediaDataSet $media, $doVideoCheck=true)
	{
		if($media->_container->IsFormatOf(KDLFlavor2Tags::$MP4ContainerSynonyms)
		&&($media->_video==null || $media->_video->IsFormatOf(KDLFlavor2Tags::$H264Synonyms))
		&&($media->_audio==null || $media->_audio->IsFormatOf(array("mpeg audio", "mp3","aac")))
		){
			return true;
		}
		return false;
	}

	/* ---------------------------
	 * isMpegAudio
	 */
	private static function isMpegAudio(KDLMediaDataSet $media)
	{
		if($media->_container->IsFormatOf(array("mpeg audio", "mp3"))
		&& $media->_video!=null
		&& $media->_video->IsFormatOf(array("mpeg audio", "mp3"))){
			return true;
		}
		return false;
	}

}
#endif

?>