<?php
require_once 'PHPUnit/Framework.php';
require_once 'cache/KalturaConfiguration.php';

class CodeKeeperTests extends PHPUnit_Framework_TestCase
{
	public function testThatObjectClassNameEqualToFileNames()
	{
		$typesDir = KalturaConfiguration::BASE_PATH; 
		$this->loadAndAssertDirectory($typesDir);
	}
	
	private function loadAndAssertDirectory($dir)
	{
		foreach(scandir($dir) as $file)
		{
			if ($file != "." && $file != "..")
			{
				if (is_dir($dir."/".$file))
				{
					$this->loadAndAssertDirectory($dir."/".$file);
				}
				else 
				{
					$fileData = file_get_contents($dir."/".$file);
					$result = null;
					if (preg_match_all("/class (\\w*)/", $fileData, $result))
					{
						$classNameInCode = $result[1][0];						
					}
					
					$classNameInFile = str_replace(".php", "", $file);
					$this->assertEquals($classNameInFile, $classNameInCode);
				}
			}
		}
	}
	
	public function testPropertyTypes()
	{
		$this->markTestIncomplete("TODO");
	}
	
	public function testPropertyEnums()
	{
		$this->markTestIncomplete("TODO");
	}
}

?>