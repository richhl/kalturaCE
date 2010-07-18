<?php
include_once("KDLMediaInfoLoader.php");
include_once('KDLProcessor.php');
include_once 'KDLUtils.php';

	/* ===========================
	 * KDLWrap
	 */
class KDLWrap
{
	public 	$_targetList = array();
	public	$_errors = array();
	public	$_warnings = array();
	public  $_rv=true;
	
	/* ------------------------------
	 * function CDLGenerateTargetFlavors
	 */
	public static function CDLGenerateTargetFlavors(mediaInfo $cdlMediaInfo=null, $cdlFlavorList)
	{
		$kdlWrap = new KDLWrap();
		return $kdlWrap->generateTargetFlavors($cdlMediaInfo, $cdlFlavorList);
	}
	
	/* ------------------------------
	 * function CDLGenerateTargetFlavorsCmdLinesOnly
	 */
	public static function CDLGenerateTargetFlavorsCmdLinesOnly($fileSizeKb, $cdlFlavorList)
	{
		$kdlWrap = new KDLWrap();
		if($fileSizeKb<KDLSanityLimits::MinFileSize) {
			$kdlWrap->_rv = false;
			$kdlWrap->_errors[KDLConstants::ContainerIndex][] = KDLErrors::ToString(KDLErrors::SanityInvalidFileSize, $fileSizeKb);
			return $kdlWrap;
		}
		return $kdlWrap->generateTargetFlavors(null, $cdlFlavorList);
	}
	
	/* ------------------------------
	 * function generateTargetFlavors
	 */
	private function generateTargetFlavors(mediaInfo $cdlMediaInfo=null, $cdlFlavorList)
	{
		$mediaSet = new KDLMediaDataSet();
		if($cdlMediaInfo!=null) {
			self::ConvertMediainfoCdl2Mediadataset($cdlMediaInfo, $mediaSet);
		}
		$profile = new KDLProfile();
		foreach($cdlFlavorList as $cdlFlavor) {
			$fl = self::ConvertFlavorCdl2Kdl($cdlFlavor);
			$profile->_flavors[] = $fl;
			kLog::log( "...F-->".$fl->ToString());
		}
		kLog::log( "...S-->".$mediaSet->ToString());

		$trgList = array();
		{
			$dlPrc = new KDLProcessor();

			$dlPrc->Generate($mediaSet, $profile, $trgList);
			$this->_errors   = $this->_errors   + $dlPrc->get_errors();
			$this->_warnings = $this->_warnings + $dlPrc->get_warnings();
			if(count($this->_errors)>0)
				$this->_rv = false;
			else
				$this->_rv = true;
		}
		
		foreach ($trgList as $trg){
			kLog::log("...T-->".$trg->ToString());
			$this->_targetList[] = self::ConvertFlavorKdl2Cdl($trg);
		}
		
		return $this;
	}

	/* ------------------------------
	 * function CDLValidateProduct
	 */
	public static function CDLValidateProduct(mediaInfo $cdlSourceMediaInfo=null, flavorParamsOutput $cdlTarget, mediaInfo $cdlProductMediaInfo)
	{
		$kdlProduct = new KDLFlavor();
		KDLWrap::ConvertMediainfoCdl2Mediadataset($cdlProductMediaInfo, $kdlProduct);
		$kdlTarget = KDLWrap::ConvertFlavorCdl2Kdl($cdlTarget);
		$kdlSource = new KDLFlavor();
		if($cdlSourceMediaInfo)
			KDLWrap::ConvertMediainfoCdl2Mediadataset($cdlSourceMediaInfo, $kdlSource);
		
		$kdlTarget->ValidateProduct($kdlSource, $kdlProduct);

		$product = KDLWrap::ConvertFlavorKdl2Cdl($kdlProduct);
		return $product;
	}

	/* ------------------------------
	 * function CDLProceessFlavorsForCollection
	 */
	public static function CDLProceessFlavorsForCollection($cdlFlavorList)
	{

		$kdlFlavorList = array();
		foreach($cdlFlavorList as $cdlFlavor) {
			$kdlFlavor = KDLWrap::ConvertFlavorCdl2Kdl($cdlFlavor);
			$kdlFlavorList[]=$kdlFlavor;
		}
		
		$xml=KDLProcessor::ProceessFlavorsForCollection($kdlFlavorList);
		kLog::log(__METHOD__."-->".$xml."<--");
		return $xml;
	}

	/* ------------------------------
	 * function CDLMediaInfo2Tags
	 */
	public static function CDLMediaInfo2Tags(mediaInfo $cdlMediaInfo, $tagList) 
	{
		$mediaSet = new KDLMediaDataSet();
		self::ConvertMediainfoCdl2Mediadataset($cdlMediaInfo, $mediaSet);
		kLog::log( "...S-->".$mediaSet->ToString());
		$tagsOut = array();
		$tagsOut = $mediaSet->ToTags($tagList);
		return $tagsOut;
	}
	
	/* ------------------------------
	 * function CDLIsFLV
	 */
	public static function CDLIsFLV(mediaInfo $cdlMediaInfo) 
	{
		$tagList[] = "flv";
		$mediaSet = new KDLMediaDataSet();
		self::ConvertMediainfoCdl2Mediadataset($cdlMediaInfo, $mediaSet);
		kLog::log("In CDLIsFLV");
		kLog::log("...S-->".$mediaSet->ToString());
		$tagsOut = array();
		$tagsOut = $mediaSet->ToTags($tagList);
		if(count($tagsOut)==1) {
			kLog::log("... an FLV file");
			return true;
		}
		else {
			kLog::log("... NOT an FLV file");
			return false;
		}
	}
	
	/* ------------------------------
	 * function ConvertFlavorKdl2Cdl
	 */
	public static function ConvertFlavorKdl2Cdl(KDLFlavor $target){
		$flavor = new flavorParamsOutputWrap();

		$flavor->setFlavorParamsId($target->_id);
		$flavor->setReadyBehavior($target->_ready_behavior);
		$flavor->setTags($target->_tags);
		
		$flavor->setName($target->_name);
		if($target->IsRedundant()) {
			$flavor->_isRedundant = true;
		}
		else {
			$flavor->_isRedundant = false;
		}
		
		if($target->IsNonComply()) {
			$flavor->_isNonComply = true;
		}
		else {
			$flavor->_isNonComply = false;
		}
		$flavor->_errors = $flavor->_errors + $target->_errors;
		$flavor->_warnings = $flavor->_warnings + $target->_warnings;
		
		if($target->_container)
			$flavor->setFormat($target->_container->GetIdOrFormat());
		
		if($target->_video) {
//echo "\n target->_video - "; print_r($target->_video); echo "\n";
			$flavor->setVideoCodec($target->_video->GetIdOrFormat());
			$flavor->setVideoBitrate($target->_video->_bitRate);
			$flavor->setWidth($target->_video->_width);
			$flavor->setHeight($target->_video->_height);
			$flavor->setFrameRate($target->_video->_frameRate);
			$flavor->setGopSize($target->_video->_gop);
		}

		if($target->_audio) {
			$flavor->setAudioCodec($target->_audio->GetIdOrFormat());
			$flavor->setAudioBitrate($target->_audio->_bitRate);
			$flavor->setAudioChannels($target->_audio->_channels);
			$flavor->setAudioSampleRate($target->_audio->_sampleRate);
		}

		$convEnginesAssociated = null;
		$commandLines = array();
		foreach($target->_transcoders as $key => $transcoder) {
			$extra = $target->_extras[$key];
//			if($flag) 
			{
				$str = null;
				switch($key){
					case KDLTranscoders::KALTURA:
						$str = kConvertJobData::CONVERSION_ENGINE_KALTURA_COM; // "0";
						$commandLines[kConvertJobData::CONVERSION_ENGINE_KALTURA_COM]=$key;
						break;
					case KDLTranscoders::ON2:
						$str = kConvertJobData::CONVERSION_ENGINE_ON2; // "1";
						$commandLines[kConvertJobData::CONVERSION_ENGINE_ON2]=$transcoder;;
						break;
					case KDLTranscoders::FFMPEG:
						$str = kConvertJobData::CONVERSION_ENGINE_FFMPEG; // "2";
						$cmdStr=$transcoder;
						if($flavor->getFormat()=="mp4"){
							$commandLines[kConvertJobData::CONVERSION_ENGINE_FFMPEG]=$cmdStr.kConvertJobData::CONVERSION_MILTI_COMMAND_LINE_SEPERATOR.kConvertJobData::CONVERSION_FAST_START_SIGN;
						}
						else
							$commandLines[kConvertJobData::CONVERSION_ENGINE_FFMPEG]=$cmdStr;
						break;
					case KDLTranscoders::MENCODER:
						$str = kConvertJobData::CONVERSION_ENGINE_MENCODER; // "3";
						$cmdStr=$transcoder;
						if($flavor->getFormat()=="mp4"){
							$commandLines[kConvertJobData::CONVERSION_ENGINE_MENCODER]=$cmdStr.kConvertJobData::CONVERSION_MILTI_COMMAND_LINE_SEPERATOR.kConvertJobData::CONVERSION_FAST_START_SIGN;
						}
						else
							$commandLines[kConvertJobData::CONVERSION_ENGINE_MENCODER]=$cmdStr;
						break;
					case KDLTranscoders::ENCODING_COM:
						$str = kConvertJobData::CONVERSION_ENGINE_ENCODING_COM; //"4";
						$commandLines[kConvertJobData::CONVERSION_ENGINE_ENCODING_COM]=$transcoder;
						break;
					case KDLTranscoders::FFMPEG_AUX:
						$str = kConvertJobData::CONVERSION_ENGINE_FFMPEG_AUX; // "99;
						$cmdStr=$transcoder;
						if($flavor->getFormat()=="mp4"){
							$commandLines[kConvertJobData::CONVERSION_ENGINE_FFMPEG_AUX]=$cmdStr.kConvertJobData::CONVERSION_MILTI_COMMAND_LINE_SEPERATOR.kConvertJobData::CONVERSION_FAST_START_SIGN;
						}
						else
							$commandLines[kConvertJobData::CONVERSION_ENGINE_FFMPEG_AUX]=$cmdStr;
						break;
					case KDLTranscoders::EE3:
						$str = kConvertJobData::CONVERSION_ENGINE_EXPRESSION_ENCODER3; //"5";
						$commandLines[kConvertJobData::CONVERSION_ENGINE_EXPRESSION_ENCODER3]=$transcoder;
						break;
					case KDLTranscoders::FFMPEG_VP8:
						$str = kConvertJobData::CONVERSION_ENGINE_FFMPEG_VP8; //"98";
						$commandLines[kConvertJobData::CONVERSION_ENGINE_FFMPEG_VP8]=$transcoder;
						break;
				}
				if($convEnginesAssociated!==null) {
					$convEnginesAssociated = $convEnginesAssociated.",".$str;
				}
				else {
					$convEnginesAssociated = $str;
				}					
//echo "transcoder-->".$key." flag:".$flag." str:".$trnsStr."<br>\n";
			}
		}
		$flavor->setCommandLines($commandLines);
		$flavor->setConversionEngines($convEnginesAssociated);
		$flavor->setFileExt($target->EvaluateFileExt());
		$flavor->_errors = $flavor->_errors + $target->_errors;
//echo "target errs "; print_r($target->_errors);
//echo "flavor errs "; print_r($flavor->_errors);
		$flavor->_warnings = $flavor->_warnings + $target->_warnings;
//echo "target wrns "; print_r($target->_warnings);
//echo "flavor wrns "; print_r($flavor->_warnings);
		
//echo "flavor "; print_r($flavor);
		
		return $flavor;
	}
	
	/* ------------------------------
	 * function ConvertFlavorCdl2Kdl
	 */
	public static function ConvertFlavorCdl2Kdl($cdlFlavor)
	{
		$kdlFlavor = new KDLFlavor();

		$kdlFlavor->_name = $cdlFlavor->getName();
		$kdlFlavor->_id = $cdlFlavor->getId();
		$kdlFlavor->_ready_behavior = $cdlFlavor->getReadyBehavior();
		$kdlFlavor->_tags = $cdlFlavor->getTags(); 
		
		$kdlFlavor->_container = new KDLContainerData();
		$kdlFlavor->_container->_id=$cdlFlavor->getFormat();

//		$kdlFlavor->_container->_duration=$api->getContainerDuration();
//		$kdlFlavor->_container->_bitRate=$api->getContainerBitRate();
//		$kdlFlavor->_container->_fileSize=$api->getFileSize();
		if($kdlFlavor->_container->IsDataSet()==false)
			$kdlFlavor->_container = null;

		$kdlFlavor->_video = new KDLVideoData();
		$kdlFlavor->_video->_id = $cdlFlavor->getVideoCodec();
//		$kdlFlavor->_video->_format = $api->getVideoFormat();
//		$kdlFlavor->_video->_duration = $api->getVideoDuration();
		$kdlFlavor->_video->_bitRate = $cdlFlavor->getVideoBitRate();
		$kdlFlavor->_video->_width = $cdlFlavor->getWidth();
		$kdlFlavor->_video->_height = $cdlFlavor->getHeight();
		$kdlFlavor->_video->_frameRate = $cdlFlavor->getFrameRate();
		$kdlFlavor->_video->_gop = $cdlFlavor->getGopSize();
		$kdlFlavor->_isTwoPass = $cdlFlavor->getTwoPass();
//		$flavor->_video->_dar = $api->getVideoDar();
		if($kdlFlavor->_video->IsDataSet()==false)
			$kdlFlavor->_video = null;

		$kdlFlavor->_audio = new KDLAudioData();
		$kdlFlavor->_audio->_id = $cdlFlavor->getAudioCodec();
//		$flavor->_audio->_format = $cdlFlavor->getAudioFormat();
//		$flavor->_audio->_duration = $cdlFlavor->getAudioDuration();
		$kdlFlavor->_audio->_bitRate = $cdlFlavor->getAudioBitRate();
		$kdlFlavor->_audio->_channels = $cdlFlavor->getAudioChannels();
		$kdlFlavor->_audio->_sampleRate = $cdlFlavor->getAudioSampleRate();
		$kdlFlavor->_audio->_resolution = $cdlFlavor->getAudioResolution();
		if($kdlFlavor->_audio->IsDataSet()==false)
			$kdlFlavor->_audio = null;

$trnsStr = $cdlFlavor->getConversionEngines();
$transParse = array();
		$trnsStr = KDLUtils::trima($trnsStr);
		preg_match_all("/([0-9]*),?/", $trnsStr, $trnsParse);

$extraStr = $cdlFlavor->getConversionEnginesExtraParams();
$extraParse = array();
		preg_match_all("/([^\|]*)\|?/", $extraStr, $extraParse);
//print_r($extraParse);
		$kdlFlavor->_transcoders = array();
		foreach ($trnsParse[1] as $trKey=>$tr) {
			if($tr==null) 
				continue;

			if(array_key_exists($trKey, $extraParse[1])){
				$extra = $extraParse[1][$trKey];
			}
			else
				$extra = null;			
			$ii = (int)$tr;
			switch($ii){
				case kConvertJobData::CONVERSION_ENGINE_KALTURA_COM: // 0 Kaltura.com
					$kdlFlavor->_extras[KDLTranscoders::KALTURA] = $extra;
					$kdlFlavor->_transcoders[KDLTranscoders::KALTURA] = null;
					break;
				case kConvertJobData::CONVERSION_ENGINE_ON2: // 1 ON2
					$kdlFlavor->_extras[KDLTranscoders::ON2] = $extra;
					$kdlFlavor->_transcoders[KDLTranscoders::ON2] = null;
					break;
				case kConvertJobData::CONVERSION_ENGINE_FFMPEG: // 2 FFMpeg
					$kdlFlavor->_extras[KDLTranscoders::FFMPEG] = $extra;
					$kdlFlavor->_transcoders[KDLTranscoders::FFMPEG] = null;
					break;
				case kConvertJobData::CONVERSION_ENGINE_MENCODER: // 3 MEncoder
					$kdlFlavor->_extras[KDLTranscoders::MENCODER] = $extra;
					$kdlFlavor->_transcoders[KDLTranscoders::MENCODER] = null;
					break;
				case kConvertJobData::CONVERSION_ENGINE_ENCODING_COM: // 4 Encoding com
					$kdlFlavor->_extras[KDLTranscoders::ENCODING_COM] = $extra;
					$kdlFlavor->_transcoders[KDLTranscoders::ENCODING_COM] = null;
					break;
				case kConvertJobData::CONVERSION_ENGINE_FFMPEG_AUX: // 99 FFMpeg_aux
					$kdlFlavor->_extras[KDLTranscoders::FFMPEG_AUX] = $extra;
					$kdlFlavor->_transcoders[KDLTranscoders::FFMPEG_AUX] = null;
					break;
				case kConvertJobData::CONVERSION_ENGINE_FFMPEG_VP8: // 98 FFMpeg_vp8
					$kdlFlavor->_extras[KDLTranscoders::FFMPEG_VP8] = $extra;
					$kdlFlavor->_transcoders[KDLTranscoders::FFMPEG_VP8] = null;
					break;
				case kConvertJobData::CONVERSION_ENGINE_EXPRESSION_ENCODER3: // 5 EE3
					$kdlFlavor->_extras[KDLTranscoders::EE3] = $extra;
kLog::log(__METHOD__."-->".get_class($cdlFlavor));
					if($cdlFlavor instanceof flavorParamsOutputWrap || $cdlFlavor instanceof flavorParamsOutput) {
						$cmdLines = $cdlFlavor->getCommandLines();
						$kdlFlavor->_transcoders[KDLTranscoders::EE3] = $cmdLines[kConvertJobData::CONVERSION_ENGINE_EXPRESSION_ENCODER3];
					}
					else
						$kdlFlavor->_transcoders[KDLTranscoders::EE3] = null;
					break;
			}
		}

		if(strstr($cdlFlavor->getCustomData(),KDLConstants::ForceCommandLineToken)) {
			$kdlFlavor->_flags = $kdlFlavor->_flags | KDLFlavor::ForceCommandLineFlagBit;
		}
		if($cdlFlavor instanceof flavorParamsOutputWrap) {
			if($cdlFlavor->_isRedundant) {
				$kdlFlavor->_flags = $kdlFlavor->_flags | KDLFlavor::RedundantFlagBit;
			}
			if($cdlFlavor->_isNonComply) {
				$kdlFlavor->_flags = $kdlFlavor->_flags | KDLFlavor::BitrateNonComplyFlagBit;
			}
			$kdlFlavor->_errors = $kdlFlavor->_errors + $cdlFlavor->_errors;
			$kdlFlavor->_warnings = $kdlFlavor->_warnings + $cdlFlavor->_warnings;
		}
		return $kdlFlavor;
	}
	
	/* ------------------------------
	 * function ConvertMediainfoCdl2Mediadataset
	 */
	public static function ConvertMediainfoCdl2Mediadataset(mediaInfo $cdlMediaInfo, KDLMediaDataSet &$medSet)
	{
		$medSet->_container = new KDLContainerData();
		$medSet->_streamsCollectionStr = $cdlMediaInfo->getMultiStreamInfo();
		
		$medSet->_container->_id=$cdlMediaInfo->getContainerId();
		$medSet->_container->_format=$cdlMediaInfo->getContainerFormat();
		$medSet->_container->_duration=$cdlMediaInfo->getContainerDuration();
		$medSet->_container->_bitRate=$cdlMediaInfo->getContainerBitRate();
		$medSet->_container->_fileSize=$cdlMediaInfo->getFileSize();
		if($medSet->_container->IsDataSet()==false)
			$medSet->_container = null;

		$medSet->_video = new KDLVideoData();
		$medSet->_video->_id = $cdlMediaInfo->getVideoCodecId();
		$medSet->_video->_format = $cdlMediaInfo->getVideoFormat();
		$medSet->_video->_duration = $cdlMediaInfo->getVideoDuration();
		$medSet->_video->_bitRate = $cdlMediaInfo->getVideoBitRate();
		$medSet->_video->_width = $cdlMediaInfo->getVideoWidth();
		$medSet->_video->_height = $cdlMediaInfo->getVideoHeight();
		$medSet->_video->_frameRate = $cdlMediaInfo->getVideoFrameRate();
		$medSet->_video->_dar = $cdlMediaInfo->getVideoDar();
		$medSet->_video->_rotation = $cdlMediaInfo->getVideoRotation();
		if($medSet->_video->IsDataSet()==false)
			$medSet->_video = null;

		$medSet->_audio = new KDLAudioData();
		$medSet->_audio->_id = $cdlMediaInfo->getAudioCodecId();
		$medSet->_audio->_format = $cdlMediaInfo->getAudioFormat();
		$medSet->_audio->_duration = $cdlMediaInfo->getAudioDuration();
		$medSet->_audio->_bitRate = $cdlMediaInfo->getAudioBitRate();
		$medSet->_audio->_channels = $cdlMediaInfo->getAudioChannels();
		$medSet->_audio->_sampleRate = $cdlMediaInfo->getAudioSamplingRate();
		$medSet->_audio->_resolution = $cdlMediaInfo->getAudioResolution();
		if($medSet->_audio->IsDataSet()==false)
			$medSet->_audio = null;

		return $medSet;
	}

	/* ------------------------------
	 * function ConvertMediainfoCdl2Mediadataset
	 */
	public static function ConvertMediainfoCdl2FlavorAsset(mediaInfo $cdlMediaInfo, flavorAsset &$fla)
	{
/*
$flavorAsset->setWidth($mediaInfoDb->getVideoWidth());
$flavorAsset->setHeight($mediaInfoDb->getVideoHeight());
$flavorAsset->setFrameRate($mediaInfoDb->getVideoFrameRate());
$flavorAsset->setBitrate($mediaInfoDb->getContainerBitRate());
$flavorAsset->setSize($mediaInfoDb->getFileSize());
$flavorAsset->setContainerFormat($mediaInfoDb->getContainerFormat());
$flavorAsset->setVideoCodecId($mediaInfoDb->getVideoCodecId());
*/
  	$medSet = new KDLMediaDataSet();
		self::ConvertMediainfoCdl2Mediadataset($cdlMediaInfo, $medSet);
		
//	$fla = new flavorAsset();
		if(!is_null($medSet->_container)){
			$fla->setContainerFormat($medSet->_container->GetIdOrFormat());
		}
  		$fla->setSize($cdlMediaInfo->getFileSize());

  	$vidBr = 0;
		if($medSet->_video){
			$fla->setWidth($medSet->_video->_width);
  			$fla->setHeight($medSet->_video->_height);
  			$fla->setFrameRate($medSet->_video->_frameRate);
			$vidBr = $medSet->_video->_bitRate;
			$fla->setVideoCodecId($medSet->_video->GetIdOrFormat());
		}
		if($vidBr==0)
			$fla->setBitrate($medSet->_container->_bitRate);
		else
			$fla->setBitrate($vidBr);
		
		return $fla;
	}
	/* ------------------------------
	 * function simulateFlavor
	 */
	public static function simulateFlavor($fmt, $codec, $w, $h, $br)
	{
		$fl = new flavorParams();

		$fl->setFormat($fmt);
		
		$fl->setVideoCodec($codec);
		$fl->setVideoBitRate($br);
		$fl->setWidth($w);
		$fl->setHeight($h);
//		$fl->setFrameRate($fr);

		$fl->setAudioCodec("mp3");
		$fl->setAudioChannels(2);
		$fl->setAudioSampleRate(44100);
		$fl->setAudioBitRate(96);
		//$fl->setAudioResolution(16);
		
		$fl->setConversionEngines("0,1,2,4");
		return $fl;
	}
}

	/* ===========================
	 * flavorParamsOutputWrap
	 */
class flavorParamsOutputWrap extends flavorParamsOutput {

	/* ---------------------
	 * Data
	 */
	public  $_isRedundant=false;
	public 	$_isNonComply=false;
	public 	$_force=false;
	public	$_create_anyway=false;
	
	public  $_errors=array(),
			$_warnings=array();

	/* ------------------------------
	 * IsValid
	 */
	public function IsValid()
	{
		return (count($this->_errors)==0);
	}
		
}

?>