<?php
abstract class ClientGeneratorFromXml 
{
	protected $_files = array();
	protected $_xmlFile = "";
	protected $_sourcePath = "";
	protected $_params = array();
	
	public function ClientGeneratorFromXml($xmlFile, $sourcePath = null)
	{
		$this->_xmlFile = realpath($xmlFile);
		$this->_sourcePath = realpath($sourcePath);
		
		if (!file_exists($this->_xmlFile))
			throw new Exception("The file [" . $this->_xmlFile . "] was not found");
			
		if (($sourcePath !== null) && !(file_exists($sourcePath)))
			throw new Exception("Source path was not found");
			
		if (is_dir($this->_sourcePath))
			$this->addSourceFiles($this->_sourcePath);
	}
	
	public abstract function generate();
	
	public function getOutputFiles()
	{
		return $this->_files;
	}
	
	protected function addFile($fileName, $fileContents)
	{
		 $this->_files[$fileName] = $fileContents;
	}
	
	protected function addSourceFiles($directory)
	{
		// add if file
		if (is_file($directory)) 
		{
			$file = str_replace($this->_sourcePath.DIRECTORY_SEPARATOR, "", $directory);
			$this->addFile($file, file_get_contents($directory));
			return;
		}
		
		// loop through the folder
		$dir = dir($directory);
		while (false !== $entry = $dir->read()) 
		{
			// skip pointers & hidden files
			if ($this->beginsWith($entry, ".")) 
			{
				continue;
			}
			 
			$this->addSourceFiles(realpath("$directory/$entry"));
		}
		 
		// clean up
		$dir->close();
	}
	
	protected function endsWith($str, $end) 
	{
		return (substr($str, strlen($str) - strlen($end)) === $end);
	}
	
	protected function beginsWith($str, $start) 
	{
		return (substr($str, 0, strlen($start)) === $start);
	}
	
	public function setParam($key, $value)
	{
		$this->_params[$key] = $value;		
	}
	
	public function getParam($key)
	{
		if (!array_key_exists($key, $this->_params))
			return null;
		return $this->_params[$key];
	}
}