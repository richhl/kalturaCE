<?php
require_once("PHPUnit/Framework/TestCase.php");

class CodeKeeperTests extends PHPUnit_Framework_TestCase 
{
	public function __construct()
	{
		parent::__construct();
		require_once("dummy/DummyGenerator.php");
	}
	public function testThatObjectClassNameEqualToFileNames()
	{
    	$this->loadAndAssertDirectory(KALTURA_ROOT_PATH."/lib");
    	$this->loadAndAssertDirectory(KALTURA_ROOT_PATH."/services");
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
				else if (pathinfo($dir."/".$file, PATHINFO_EXTENSION) == "php") 
				{
					$fileData = file_get_contents($dir."/".$file);
					$result = null;
					$classNameInCode = null;
					if (preg_match_all("/^\\s?class\\s?(\\w*)/m", $fileData, $result))
					{
						$classNameInCode = $result[1][0];						
					}
					
					$classNameInFile = str_replace(".php", "", $file);
					if ($classNameInCode) // only if we have class in that file
					    $this->assertEquals($classNameInFile, $classNameInCode);
				}
			}
		}
	}
	
	public function testApiObjectsPropertyTypes()
	{
		return;
		// test that only string, int, float, bool, instanceof KalturaEnum, instanceof KalturaObject are allowed in API objects 
		$dummyGenerator = new DummyGenerator();
		$dummyGenerator->load();
		$services = $dummyGenerator->getServices();
		foreach($services as $service)
		{
			$actions = $service->getActions();
			$actions = array_keys($actions);
			foreach($actions as $actionId)
			{
				$actionParams = $service->getActionParams($actionId);
				foreach($actionParams as $actionParam)
				{
					if (!$actionParam->isSimpleType())
						$actionParam->getTypeReflector(); // will fail if the type doesn't exists					
				}
			}
		}
	}
	
	public function testEnumsValuesAreIntegers()
	{
		// test that enum values are set as integers
		$this->markTestIncomplete("TODO");
	}
	
	public function testApiSignaturesMatchPhpDoc()
	{
	}
}

?>