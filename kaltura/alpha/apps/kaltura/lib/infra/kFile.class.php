<?php
class kFile
{
	// TODO - implement recursion
	static public function dirList ($directory , $return_directory_as_prefix = true , $should_recurse = false )
	{
		// create an array to hold directory list
		$results = array();

		// create a handler for the directory
		$handler = @opendir($directory);
		if (!$handler)
			sfLogger::getInstance()->alert("dirList $directory does not exist");

		// keep going until all files in directory have been read
		while ($file = readdir($handler)) 
		{

			// if $file isn't this directory or its parent,
			// add it to the results array
			if ($file != '.' && $file != '..')
			{
				$results[] = ( $return_directory_as_prefix ? $directory ."/" : "" ) .$file;
			}	
		}

		// tidy up: close the handler
		closedir($handler);

		// done!
		return $results;
	}

	/*
	 * Besure to limit the search with $max_results if not all files are reqquired
	 */
	static public function recursiveDirList ($directory , $return_directory_as_prefix = true , $should_recurse = false ,  $file_pattern = NULL , $depth = 0 , $max_results = -1 )
	{
		if ( $depth > 10 ) 
		{
			// exceeded the recursion depth
			return NULL;
		}
	
		$depth++;
		
		// create an array to hold directory list
		$results = array();
		// create a handler for the directory
		$handler = @opendir($directory);
		if ( !$handler ) return NULL;
 
//		echo  ( "directory: " .$directory . "<br>" );

		$current_path = pathinfo( $directory , PATHINFO_DIRNAME )  . "/" . pathinfo( $directory , PATHINFO_BASENAME ) . "/" ;
		// keep going until all files in directory have been read
		while ( ( $file = readdir($handler) ) != NULL )
		{
			// if $file isn't this directory or its parent,
			// add it to the results array
			if ($file != '.' && $file != '..')
			{
				$match = 1;
				if ( $file_pattern != NULL )
				{
					$match = preg_match ( $file_pattern , $file );
				}
 
				if ( $match > 0)
				{
					$results[] = ( $return_directory_as_prefix ? $directory ."/" : "" ) .$file;
					if ( $max_results > 1 && count ( $results ) >  $max_results ) return $results;
				}

				if ( $should_recurse && is_dir( $current_path . $file) )
				{	
//				echo "Recursing... [$should_recurse] [$current_path $file]<br>"; 	
					
					$child_dir_results  = self::recursiveDirList ( $current_path . $file , $return_directory_as_prefix , $should_recurse , $file_pattern , $depth);
					if ( $child_dir_results )
					{
						$results = kArray::append ( $results , $child_dir_results );
					}
				}				
			}	
		}
		// tidy up: close the handler
		closedir($handler);

		// done!
		return $results;
	}
	
	/**
	 * the result is a list of tuples - files_name , files_size 
	 */
	// TODO - implement recursion
	static public function dirListExtended ($directory , $return_directory_as_prefix = true , $should_recurse = false ,  
		$file_pattern = NULL , $depth = 0 , $fetch_content=false)
	{
		if ( $depth > 10 ) 
		{
			// exceeded the recursion depth
			return NULL;
		}
		
	
		// create an array to hold directory list
		$results = array();

		// create a handler for the directory
		$handler = @opendir($directory);
		if ( !$handler ) return NULL;

//		echo  ( "directory: " .$directory . "<br>" );

		$current_path = pathinfo( $directory , PATHINFO_DIRNAME )  . "/" . pathinfo( $directory , PATHINFO_BASENAME ) . "/" ;
		// keep going until all files in directory have been read
		while ( ( $file = readdir($handler) ) != NULL )
		{

			// if $file isn't this directory or its parent,
			// add it to the results array
			if ($file != '.' && $file != '..')
			{
				if ( !$file_pattern )
					$match = 1;
				else
					$match = preg_match ( $file_pattern , $file );
 
				if ( $match > 0)
				{
					$file_full_path = $directory . "/" . $file;
					$result = array();
					// first - name (with or without the full path)
					$result[] = ( $return_directory_as_prefix ? $directory ."/" : "" ) .$file;
					// second - size 
					$result[] = filesize( $file_full_path );
					// third - time
					$result[] = filemtime ( $file_full_path );
					// forth - content (only if requested
					if ( $fetch_content )
						$result[] = file_get_contents( $file_full_path );
					$results[] = $result;
				}

				if ( $should_recurse && is_dir( $current_path . $file) )
				{	
//				echo "Recursing... [$should_recurse] [$current_path $file]<br>"; 	
					
					$child_dir_results  = self::dirListExtended ( $current_path . $file , $return_directory_as_prefix , $should_recurse , $file_pattern , ++$depth);
					if ( $child_dir_results )
					{
						$results =kArray::append ( $results , $child_dir_results );
					}
				}				
			}	
		}

		// tidy up: close the handler
		closedir($handler);

		// done!
		return $results;
	}

	
	static public function getFileContent ( $file_name , $from_byte = 0 , $to_byte = -1  )
	{
		$file_name = self::fixPath ( $file_name );
		
		try
		{
			if (  ! file_exists( $file_name) )
				return NULL;
			$fh = fopen($file_name, 'r');
			
			if ( $fh == NULL )
				return NULL;
			if ( $from_byte > 0 )
			{
				$from_byte = max ( 0 , $from_byte );
				$dummy = fread($fh,$from_byte);
			}
			
			if ( $to_byte > 0 )
			{
				$to_byte = min ( $to_byte , filesize($file_name) );
				$length = $to_byte - $from_byte;
			}
			else
			{
				$length = filesize($file_name);
			}
			
			$theData = fread($fh, $length );
			fclose($fh);
			return $theData;
		}
		catch ( Exception $ex )
		{
			return NULL;
		}
	}
	

	static public function setFileContent ( $file_name , $content )
	{
		$file_name = self::fixPath ( $file_name );
		
		// TODO - this code should be written in fullMkdir
		if ( !file_exists( dirname( $file_name ))) self::fullMkdir ( $file_name );
		
		$fh = fopen($file_name, 'w');
		try
		{
			fwrite($fh, $content);
		}
		catch (Exception $ex )
		{
			// whatever happens - don't forget to cloes $fh
		}
		fclose($fh);
	}

	static public function fixPath ( $file_name )
	{
		$res = str_replace ( "\\" , "/" , $file_name);
		$res = str_replace ( "//" , "/" , $res);
		return $res;		 
	}

	public static function fullMkdir($path, $rights = 0777)
	{
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

	public static function moveFile($from, $to, $override_if_exists = false, $copy = false )
	{
		$from = str_replace( "\\" , "/" , $from );
		$to = str_replace( "\\" , "/" , $to );

		if ( $override_if_exists && is_file( $to ) )
		{
			self::deleteFile ( $to );
		}
		
		if ( !is_dir ( dirname ( $to )) )
		{
			self::fullMkdir($to);
		}

		if ($copy)
			return copy($from, $to);
		else
			return rename($from, $to);
	}

	// make sure the file is closed , then remove it
	public static function deleteFile ( $file_name )
	{
		$fh = fopen($file_name, 'w') or die("can't open file");
		fclose($fh);
		unlink($file_name);
	}

	static public function replaceExt($file_name, $new_ext)
	{
		$ext = pathinfo($file_name, PATHINFO_EXTENSION);
		$len = strlen($ext);
		return ($len ? substr($file_name, 0, -strlen($ext)) : $file_name) . $new_ext;
	}
	
	static public function getFileNameNoExtension ( $file_name , $include_file_path = false )
	{
		$ext = pathinfo ($file_name, PATHINFO_EXTENSION);
		$base_file_name = pathinfo ($file_name, PATHINFO_BASENAME);
		$len = strlen ( $base_file_name ) - strlen ( $ext );
		if ( strlen ( $ext ) > 0  )
		{
			$len = $len - 1;
		}
		
		$res = substr ( $base_file_name , 0 , $len )  ;
		if ( $include_file_path )
		{
			$res = pathinfo ($file_name, PATHINFO_DIRNAME ) . "/" . $res;
		}
		return $res  ;
	}
	
	public static function readLastBytesFromFile ( $file_name , $bytes = 1024)
	{
		$fh = fopen($file_name, 'r');
		$data = "";
		if ( $fh )
		{
			fseek ( $fh , -$bytes , SEEK_END );
			$data = fread ( $fh , $bytes ); 
		}
		
		fclose($fh);
		
		return $data;
	}
	//
	// downloadHeader - 1 only body, 2 - only header, 3 - both body and header
	//
	static public function downloadUrlToString($sourceUrl, $downloadHeader = 1, $extraHeaders = null)
	{
		// create a new curl resource
		// TODO - remove this hack !!!
		// I added it only because for some reason or other I couldn't get hold of the http_get 
		/*
		if ( function_exists ('http_get'))
		{
			return http_get($sourceUrl, array('redirect' => 5));
			
		}
		else
		*/
		{
			$ch = curl_init();
			
			// set URL and other appropriate options
			curl_setopt($ch, CURLOPT_URL, $sourceUrl);
			curl_setopt($ch, CURLOPT_USERAGENT, "curl/7.11.1");
			curl_setopt($ch, CURLOPT_HEADER, ($downloadHeader & 2) ? 1 : 0);
			curl_setopt($ch, CURLOPT_NOBODY, ($downloadHeader & 1) ? 0 : 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER , TRUE);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
			if ($extraHeaders)
				curl_setopt($ch, CURLOPT_HTTPHEADER, $extraHeaders);
			
			// grab URL and pass it to the browser
			$content = curl_exec($ch);
			
			// close curl resource, and free up system resources
			curl_close($ch);
	
		}
		return $content;
	}
	
	static public function downloadUrlToFile($sourceUrl, $fullPath)
	{
		if ( empty ( $sourceUrl) )
		{
			$fullPath = null;
			return false;
		}
		$f = fopen($fullPath, "wb");
		
		$ch = curl_init();
		
		// set URL and other appropriate options
		curl_setopt($ch, CURLOPT_URL, $sourceUrl);
		curl_setopt($ch, CURLOPT_USERAGENT, "curl/7.11.1");
		curl_setopt($ch, CURLOPT_FILE, $f);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		
		curl_exec($ch);
		
		curl_close($ch);
		fclose($f);
		return true;
		
	}
	
	public static function getFileData ( $file_full_path )
	{
		return new kFileData( $file_full_path );
	}

	public static function getFileDataWithContent ( $file_full_path )
	{
		$add_content = ( strpos ( $file_full_path , ".txt") !== false || strpos ( $file_full_path , ".log") !== false);
		
		return new kFileData( $file_full_path , $add_content );
		
	}
	
	public static function findInFile ( $file_name , $pattern )
	{
		
	}
	
	public static function dumpFile ( $file_name , $mime_type=null, $max_age = null)
	{
		if (!file_exists($file_name))
			die;
			
		$ext = pathinfo ($file_name, PATHINFO_EXTENSION);
		$total_length = filesize($file_name);
		
		if ( $mime_type )
		{
			requestUtils::sendCdnHeaders($file_name, $total_length , $max_age , $mime_type );
		}
		else
			requestUtils::sendCdnHeaders($ext, $total_length, $max_age);
		
		$chunk_size = 100000;
		$fh = fopen($file_name, "rb");
		if ($fh)
		{
			$pos = 0;
			while ($total_length >= 0)
			{
				$content = fread( $fh , $chunk_size );
				echo $content;
				$total_length -= $chunk_size;
			}
			fclose($fh);
		}
		
		die;
	}
	
	
	public static function mimeType (  $file_name )
	{
		if (!function_exists('mime_content_type'))
		{
//            ob_start();
//            system('file -i -b ' . realpath($file_name));
//           $type = ob_get_clean();
			
			$type = null;
			exec ( 'file -i -b ' . realpath($file_name) , $type  );
			
			$parts = @ explode ( ";" , $type[0] ); // can be of format text/plain;  charset=us-ascii 
			
            return trim($parts[0]);
		}
		else
		{
			return mime_content_type (  $file_name );
		}
	}
		

}

class kFileData
{
	public $exists;
	public $full_path = NULL ;
	public $name = NULL ;
	public $size = NULL ;
	public $timestamp = NULL ;
	public $ext = NULL ;
	public $content = NULL;
	public $raw_timestamp = NULL ;
	
	public function kFileData ( $full_file_path , $add_content = false )
	{
		//debugUtils::st();
		$this->full_path = realpath ( $full_file_path ); 
		$this->exists = file_exists( $full_file_path );
		$this->name = pathinfo ($full_file_path, PATHINFO_BASENAME); 
		$this->ext = pathinfo ($full_file_path, PATHINFO_EXTENSION);
		
		if ( $this->exists )
		{
			$this->size = filesize( $full_file_path );
			$this->raw_timestamp = filectime($full_file_path);
			$this->timestamp = date ("Y-m-d H:i:s.", $this->raw_timestamp );
			
			if ( $add_content )
			{
				$this->content = file_get_contents( $full_file_path );
			}
		}
	}
}
?>