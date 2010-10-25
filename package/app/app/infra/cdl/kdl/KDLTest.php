<?php

class KDLTest
{
	/* ------------------------------
	 * function mediaDs2flavor
	 */
	public static function simulateFlavor($fmt, $vcodec, $w=0, $h, $br, $acodec="", $ab=96, $ar=22050, $clipStart=0, $clipDur=0)
	{
		$fl = new KDLFlavor();
		$fl->_audio = new KDLAudioData();
		$fl->_video = new KDLVideoData();
		$fl->_container = new KDLContainerData();
		$fl->_clipDur = $clipDur;
		$fl->_clipStart = $clipStart;
		//		$fl = $source;
		$fl->_container->_id = $fmt;
		$fl->_video->_id = $vcodec;
		$fl->_video->_bitRate = $br;
		$fl->_video->_width = $w;
		$fl->_video->_height = $h; 
		$fl->_video->_gop = 0;
//		$fl->_video->_frameRate = 0;
//		$fl->_flags = KDLFlavor::ForceCommandLineFlagBit;
		$fl->_audio->_id = $acodec;
//		$fl->_audio->_channels = 2;
		$fl->_audio->_sampleRate = $ar;
		$fl->_audio->_bitRate = $ab;
//		$fl->_audio->_resolution=16;
		
/**/		$fl->_transcoders[] = new KDLOperationParams("cli_encode");
	
		$fl->_transcoders=KDLUtils::parseTranscoderList(/*"5,1,(1#2#3),4"*/"2,3,99,(6#2#7)","", KDLWrap::$TranscodersCdl2Kdl);
		/*
		$fl->_transcoders[] = new KDLOperationParams("encoding.com");
		$fl->_transcoders[] = new KDLOperationParams("ffmpeg");
		$fl->_transcoders[] = new KDLOperationParams("ffmpeg-aux");
		$fl->_transcoders[] = new KDLOperationParams("mencoder");
		//$fl->_transcoders["encoding.com"] = true; 
		//$fl->_transcoders["cli_encode"] = true; 
		 
		*/
		KDLUtils::RecursiveScan($fl->_transcoders, "transcoderSetFuncTest", null, null);
//kLog::log(__METHOD__."==>\n".print_r($fl->_transcoders,true));  
		return $fl;
	}
	
	/* ------------------------------
	 * function runDirTest
	 */
	public static function runDirTest($path, $pattern, $profile=null)
	{
		if ( !$path )
		{
			kLog::log ( "Usage " . $argv[0] . " <path-to-iterate> [<file-pattern>]" );
			die();
		}
		
		kLog::log ( "Will search in path [$path] for pattern [$pattern]" );
		if ( $pattern )
			$path_pattern = $path . "/" . $pattern;
		else
			$path_pattern = $path . "/*";
		$files = glob ( $path_pattern );
kLog::log( "--------");
	
		foreach ($files as $file )
		{
			// iterate files and links only
			if(is_dir($file)) {
				self::runDirTest($file, "*", $profile);
				continue;
			}

			if ( ! is_file( $file ) && ! is_link ( $file ) ) 
				continue;
				
			mediaTestStub($file, $profile);
				
//			$dlPrc = new KDLProcessor();
//			self::runFileTest($file, $dlPrc, $profile);
//			echo "<br>\n";
		}
	}

	/* ------------------------------
	 * function runFileTest
	 */
	public static function runFileTest($file, &$dlPrc, $profile=null){
//	echo $profile->ToString()."<br>\n"; 	
		kLog::log( $file);
		$mediaInfoStr = shell_exec(MediaInfoProgram." ". realpath($file));
		self::runMediainfoTest($mediaInfoStr, $dlPrc, $profile);
//	echo $profile->ToString()."<br>\n"; 	
	}

	/* ------------------------------
	 * function runMediainfoTest
	 */
	public static function runMediainfoTest($mediaInfoStr, &$dlPrc, $profile=null){
//echo $mediaInfoStr;
//	echo $profile->ToString()."<br>\n"; 	
		$mdLoader = new KDLMediaInfoLoader($mediaInfoStr);
		$mediaInfoObj = new KDLMediaDataSet();
		$mdLoader->Load($mediaInfoObj);

		self::runMediasetTest($mediaInfoObj, $dlPrc, $profile);
		return;
	}

	/* ------------------------------
	 * function runMediasetTest
	 */
	public static function runMediasetTest(KDLMediaDataSet $mediaSet, &$dlPrc, $profile=null){
			$inFile = realpath($mediaSet->_container->_fileName);
//$mediaSet = 100; //new KDLMediaDataSet();
		kLog::log( "....S-->".$mediaSet->ToString());

		//		unset($targetList); // Remarked by Tan-Tan $targetList doesn't exist
		$targetList = array();
		$errors = array();
		$warnings = array();
		{
			$dlPrc = new KDLProcessor();

			$dlPrc->Generate($mediaSet, $profile, $targetList);
			$dlPrc->_targets=$targetList;
			$errors   = $errors   + $dlPrc->get_errors();
			$warnings = $warnings + $dlPrc->get_warnings();
			if(count($errors)>0)
				$rv = false;
			else
				$rv = true;
		}
		if($rv==false){
			kLog::log( "....E==>");
			print_r($errors);
			kLog::log( "\n");
		}
		kLog::log( "....W==>");
		print_r($warnings);
		kLog::log( "\n");
		if($profile==null)
			return;

$xmlStr = KDLProcessor::ProceessFlavorsForCollection($targetList);
kLog::log(__METHOD__."-->XML-->\n".print_r($xmlStr,true)."\n<--");
	
		foreach ($targetList as $target){


$output = array();
$rv = 0;
			kLog::log( "...T-->".$target->ToString());
			$outFile = "aaa1.mp4";
			
			if(file_exists($outFile)) unlink($outFile);
$cmdLineGenerator = $target->SetTranscoderCmdLineGenerator($inFile,$outFile);
			$cmdLineGenerator->_clipDur = 10000;
$exeStr = "FFMpeg ".$cmdLineGenerator->FFMpeg(null);
//			kLog::log( ".CMD-->".$exeStr);
			$exeStr = "cli_encode ".$cmdLineGenerator->Generate(new KDLOperationParams(KDLTranscoders::ON2), 1000);
			kLog::log( ".CMD-->".$exeStr);
			$exeStr = "mencoder ".$cmdLineGenerator->Generate(new KDLOperationParams(KDLTranscoders::MENCODER), 1000);
			kLog::log( ".CMD-->".$exeStr);
			$exeStr = "ffmpeg ".$cmdLineGenerator->Generate(new KDLOperationParams(KDLTranscoders::FFMPEG), 1000);
			kLog::log( ".CMD-->".$exeStr);
//			exec($exeStr, $output, $rv);
			kLog::log( "..RV-->In".$inFile."==>");
			if(!file_exists($outFile) || filesize($outFile)==0)
				kLog::log( "Failed");
			else {
				kLog::log( "Succeeded, Filesize:".filesize($outFile));
				$mediaInfoStr = shell_exec(MediaInfoProgram." ". realpath($outFile));
				$medLoader = new KDLMediaInfoLoader($mediaInfoStr);
				$product = new KDLFlavor();
				$medLoader->Load($product);
				$target->ValidateProduct($mediaSet, $product);
				kLog::log("\n".$mediaInfoStr);
//				kLog::log( ".PRD-->".$product->ToString());
				
				//				unlink($outFile);
			}
		}
	}
}
	
		/* ---------------------------
		 * transcoderSetFuncTest
		 */
function transcoderSetFuncTest($oprObj, $transDictionary, $param2)
{
	$trId = KDLUtils::trima($oprObj->_id);
	if(!is_null($transDictionary) && array_key_exists($trId, $transDictionary)){
		$oprObj->_id = $transDictionary[$trId];
	}
	if($oprObj->_id==KDLTranscoders::QUICK_TIME_PLAYER_TOOLS){
		$engineClassName = "KDLTranscoderQTPTools";
	}
	else if($oprObj->_id==KDLTranscoders::QT_FASTSTART){
		$engineClassName = "KDLOperatorQTFastStart";
	}
	else if($oprObj->_id==KDLTranscoders::PDF_CREATOR){
		$engineClassName = "KDLTranscoderPdfCreator";
	}
	else if($oprObj->_id==KDLTranscoders::PDF2SWF){
		$engineClassName = "KDLTranscoderPdf2Swf";
	}
	else {
		$engineClassName = "KDLOperatorWrapper";
	}
	$oprObj->_engine = new $engineClassName($oprObj->_id,"");
}

?>