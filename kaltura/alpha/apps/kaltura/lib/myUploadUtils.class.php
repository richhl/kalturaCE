<?php
class myUploadUtils
{
	public static function uploadFile ( $file_data , $id , $filename , $hash , $extra_id = null )
	{
		$realHash = myContentStorage::getTempUploadHash($filename, $id);
		
		// TODO - what if there is  an error while uploading ?

		// filename is OK?
		if($realHash == $hash && $hash != "")
		{
			//create the directory if doesn't exists (should have write permissons)
			// if(!is_dir("./files")) mkdir("./files", 0755);
			//move the uploaded file

			$origFilename = $file_data['name'];
			$parts = pathinfo($origFilename);
			$extension = strtolower($parts['extension']);

			$filename = $id.'_'.$filename;
			// add the file extension after the "." character
			$fullPath = myContentStorage::getFSUploadsPath().$filename . ( $extra_id ? "_" . $extra_id : "" ) .".".$extension;

			myContentStorage::fullMkdir($fullPath);
			if ( ! move_uploaded_file($file_data['tmp_name'], $fullPath) )
			{
				kLog::log ( "Error while uploading [$id] [$filename] [$hash] [$extra_id] " . print_r ( $file_data ,true ) ."\n->[$fullPath]" );
				return false;
			}
			@chmod ( $fullPath , 0777 );

			return true;
		}
		
		return false;
	}

	public static function uploadFileByToken ( $file_data , $token , $filename , $extra_id = null , $create_thumb = false )
	{
		kLog::log( "Trace while uploading1 [$filename] [$token] [$extra_id] " . print_r ( $file_data ,true ) );
		
		$origFilename = @$file_data['name'];
		if ( ! $origFilename )
		{
			kLog::log ( "Error while uploading, file does not have a name. [$filename] [$token] [$extra_id] " . print_r ( $file_data ,true ) . 
				"\nerror: [" . @$file_data["error"] . "]" );			
			return;
		}
		$parts = pathinfo($origFilename);
		$extension = @strtolower($parts['extension']);
/*
		$filename = $token .'_'. $filename;
		// add the file extension after the "." character
		$fullPath = myContentStorage::getFSUploadsPath().$filename . ( $extra_id ? "_" . $extra_id : "" ) .".".$extension;
*/
		list ( $fullPath , $fullUrl )  = self::getUploadPathAndUrl ( $token , $filename , $extra_id , $extension );
		
		kLog::log ( "Trace while uploading2 [$filename] [$token] [$extra_id] " . print_r ( $file_data ,true ) ."\n->[$fullPath]" );
			
		myContentStorage::fullMkdir($fullPath);
		if ( ! move_uploaded_file($file_data['tmp_name'], $fullPath) )
		{
			kLog::log ( "Error while uploading [$token] [$filename] [$extra_id] [$create_thumb] " . print_r ( $file_data ,true ) ."\n->[$fullPath]" );
					
			$err =  array ( 	"token" => $token , 
						"filename" => $filename , 
						"origFilename" => $origFilename ,
						"error" => @$file_data["error"] , );

			kLog::log ( "Error while uploading [$token] [$filename] [$extra_id] [$create_thumb] " . print_r ( $file_data ,true ) ."\n->[$fullPath]" . "\n" 
				. print_r ( $err , true ) );			
			return $err;
		}
		chmod ( $fullPath , 0777 );
		
		$upload_server_header = @$_SERVER["HTTP_X_KALTURA_SERVER"];
		
		// if the file originated from a kaltura upload server we dont need a thumbnail (kuploader)
		if ( $create_thumb && myContentStorage::fileExtAccepted ( $extension ) && !$upload_server_header)
		{
			$thumb_path = pathinfo ( $fullPath , PATHINFO_DIRNAME );
			// target thumb path
			$thumbFullPath = self::getThumbnailPath ( $fullPath , ".jpg" );
			kFile::fullMkdir( $thumbFullPath );
			myFileConverter::createImageThumbnail($fullPath, $thumbFullPath, "image2" );
			$thumb_url = self::getThumbnailPath ( $fullUrl , ".jpg" ); 
			$thumb_created = file_exists( $thumbFullPath );
		}
		else
		{
			// in this case no thumbnail was created - don't extract false data 
			$thumb_url = ""; 
			$thumb_created = false;
		}
		
		return array ( 	"token" => $token , 
						"filename" => $filename , 
						"origFilename" => $origFilename ,
						"thumb_url" => $thumb_url , 
						"thumb_created" => $thumb_created ,
//						"extra_data" => @$file_data, 
						);
	}
	
	
	private static function getThumbnailPath ( $path , $new_extension )
	{
		$fixed = str_replace ( "uploads/" , "uploads/thumbnail/thumb_" , $path ) ;
		return kFile::getFileNameNoExtension( $fixed , true ). $new_extension;
	}
	
	public static function uploadJpeg ( $data, $id , $filename , $hash , $extra_id = null , $return_extended_data=false)
	{
		//$realHash = myContentStorage::getTempUploadHash($filename, $id);

		$origFilename = $filename; 
		// filename is OK?
		if( true /*$realHash == $hash && $hash != ""*/)
		{
			$filename = $id.'_'.$filename;
			// add the file extension after the "." character
			$fullPath = myContentStorage::getFSUploadsPath().$filename . ( $extra_id ? "_" . $extra_id : "" ) .".jpg";

			kFile::setFileContent($fullPath, $data);
			chmod ( $fullPath , 0777 );

			if ( $return_extended_data )
			{
				return array ( 	"token" => $id , 
					"filename" => $filename , 
					"origFilename" => $origFilename ,
					"thumb_url" => null , 
					"thumb_created" => false);
			}
			return true;
		}
		
		return false;
	}
	
	// return the file path WITHOUT the extension
	// if the extension is known - pass it as the 4rt parameter
	public static function getUploadPath ($token , $file_alias , $extra_id = null , $extension = "" )
	{
//		$extension = ""; // strtolower($parts['extension']);
		
		$filename = $token .'_'. $file_alias;
		// add the file extension after the "." character
		$fullPath = myContentStorage::getFSUploadsPath().$filename . ( $extra_id ? "_" . $extra_id : "" ) .".".$extension;
		
		return $fullPath;
	}
	
	public static function getUploadPathAndUrl ($token , $file_alias , $extra_id = null , $extension = "" )
	{
//		$extension = ""; // strtolower($parts['extension']);
		
		$filename = $token .'_'. $file_alias;
		// add the file extension after the "." character
		$suffix = $filename . ( $extra_id ? "_" . $extra_id : "" ) .".".$extension;
		$fullPath = myContentStorage::getFSUploadsPath().$suffix;
		$fullUrl = requestUtils::getRequestHost()."/". myContentStorage::getFSUploadsPath( false ).$suffix;
		return array ( $fullPath , $fullUrl );
	}
	
}
?>