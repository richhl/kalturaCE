<?php
class DotNetClientGenerator
{
	private $_xmlFilePath = "";
	private $_doc = null;
	private $_txt = "";
	private $_csprojIncludes = array();
	
	function DotNetClientGenerator($xmlFilePath)
	{
		$this->_xmlFilePath = $xmlFilePath;
		$this->_doc = new DOMDocument();
		$this->_doc->load($this->_xmlFilePath);
	}
	
	function generate() 
	{
		$this->makeDir("output");
		$this->makeDir("output/KalturaClient");
		$this->makeDir("output/KalturaClient/Enums");
		$this->makeDir("output/KalturaClient/Types");
		$this->makeDir("output/KalturaClient/Services");
		
		$this->copyr("source", "output");

		// enumes $ types
		$xpath = new DOMXPath($this->_doc);
		$enumNodes = $xpath->query("/xml/enums/enum");
		foreach($enumNodes as $enumNode)
		{
			$this->writeEnum($enumNode);
		}
		
		$classNodes = $xpath->query("/xml/classes/class");
		foreach($classNodes as $classNode)
		{
			$this->writeClass($classNode);
		}
		
		$this->writeObjectFactoryClass($classNodes);
		
		
		
		$serviceNodes = $xpath->query("/xml/services/service");
		
		$this->startNewTextBlock();
		foreach($serviceNodes as $serviceNode)
		{
		    $this->writeService($serviceNode);
		}
		
	    $this->writeMainClient($serviceNodes);
	     
    	$this->writeCsproj();
	}
	
	function writeEnum(DOMElement $enumNode)
	{
		$enumName = $enumNode->getAttribute("name");
		$s = "";
		$s .= "namespace Kaltura"."\n";
		$s .= "{"."\n";
		$s .= "	public enum $enumName"."\n";
		$s .= "	{"."\n";
		
		foreach($enumNode->childNodes as $constNode)
		{
			if ($constNode->nodeType != XML_ELEMENT_NODE)
				continue;
				
			$propertyName = $constNode->getAttribute("name");
			$propertyValue = $constNode->getAttribute("value");
			$s .= "		$propertyName = $propertyValue,"."\n";
		}
		$s .= "	}"."\n";
		$s .= "}"."\n";
		$file = "Enums/$enumName.cs";
		$this->writeToFile("output/KalturaClient/".$file, $s);
		$this->_csprojIncludes[] = $file; 
	}
	
	function writeClass(DOMElement $classNode)
	{
		$this->startNewTextBlock();
		$this->appendLine("using System;");
		$this->appendLine("using System.Xml;");
		$this->appendLine("using System.Collections.Generic;");
		$this->appendLine();
		$this->appendLine("namespace Kaltura");
        $this->appendLine("{");
		$type = $classNode->getAttribute("name");
		// class definition
		if ($classNode->hasAttribute("base"))
		{
			$this->appendLine("	public class $type : ".$classNode->getAttribute("base"));
		}
		else
		{
			$this->appendLine("	public class $type : KalturaObjectBase");
		}
		$this->appendLine("	{");
		
		// class properties
		$this->appendLine("		#region Properties");
		
		foreach($classNode->childNodes as $propertyNode)
		{
			if ($propertyNode->nodeType != XML_ELEMENT_NODE)
				continue;
				
			$propType = $propertyNode->getAttribute("type");
			$propName = $propertyNode->getAttribute("name");
			$isEnum = $propertyNode->hasAttribute("enumType");
			$dotNetPropName = $this->upperCaseFirstLetter($propName);
			
			if ($isEnum)
			    $dotNetPropType = $propertyNode->getAttribute("enumType");
		    else if ($propType == "array")
		        $dotNetPropType = "IList<".$propertyNode->getAttribute("arrayType").">";
	        else 
	            $dotNetPropType = $propType;
			
			
			$propertyLine =	"public $dotNetPropType $dotNetPropName";
			switch($propType)
			{
				case "int":
				    if ($isEnum)
				        $propertyLine .= " = ($dotNetPropType)Int32.MinValue";
			        else
					    $propertyLine .= " = Int32.MinValue";
					break;
				case "string":
					$propertyLine .= " = null";
					break;
				case "bool":
					$propertyLine .= " = false";
					break;
				case "float":
					$propertyLine .= " = Single.MinValue";
					break;
			}
			$this->appendLine("		$propertyLine;");
		}
		
		$this->appendLine("		#endregion");
		$this->appendLine();
		
		$this->appendLine("		#region CTor");
		// CTor
		$this->appendLine("		public $type()");
		$this->appendLine("		{");
		$this->appendLine("		}");
		$this->appendLine("");
		
		// CTor For XmlElement
	    if ($classNode->hasAttribute("base"))
		{
			$this->appendLine("		public $type(XmlElement node) : base(node)");
		}
		else
		{
			$this->appendLine("		public $type(XmlElement node)");
		}
		
		$this->appendLine("		{");
		if ($classNode->childNodes->length)
		{
    		$this->appendLine("			foreach (XmlElement propertyNode in node.ChildNodes)"); 
    		$this->appendLine("			{");
    		$this->appendLine("				string txt = propertyNode.InnerText;");
    		$this->appendLine("				switch (propertyNode.Name)");
    		$this->appendLine("				{");
    		foreach($classNode->childNodes as $propertyNode)
    		{
    			if ($propertyNode->nodeType != XML_ELEMENT_NODE)
    				continue;
    				
    			$propType = $propertyNode->getAttribute("type");
    			$propName = $propertyNode->getAttribute("name");
    			$isEnum = $propertyNode->hasAttribute("enumType");
    			$dotNetPropName = $this->upperCaseFirstLetter($propName);
    			$this->appendLine("					case \"$propName\":");
    			switch($propType)
    			{
    				case "int":
    				    if ($isEnum)
    				    {
    				        $enumType = $propertyNode->getAttribute("enumType");
    				        $this->appendLine("						this.$dotNetPropName = ($enumType)ParseEnum(typeof($enumType), txt);");
    				    }
    				    else
    					    $this->appendLine("						this.$dotNetPropName = ParseInt(txt);");
    					break;
    				case "string":
    					$this->appendLine("						this.$dotNetPropName = txt;");
    					break;
    				case "bool":
    					$this->appendLine("						this.$dotNetPropName = ParseBool(txt);");
    					break;
    				case "float":
    					$this->appendLine("						this.$dotNetPropName = ParseFloat(txt);");
    					break;
    				case "array":
    				    $arrayType = $propertyNode->getAttribute("arrayType");
    					$this->appendLine("				        this.$dotNetPropName = new List<$arrayType>();");
    				    $this->appendLine("						foreach(XmlElement arrayNode in propertyNode.ChildNodes)");
    				    $this->appendLine("						{");
    				    $this->appendLine("					        this.$dotNetPropName.Add(($arrayType)KalturaObjectFactory.Create(arrayNode));");
    				    $this->appendLine("						}");
    					break;
    				default: // sub object
    				    $this->appendLine("				        this.$dotNetPropName = ($propType)KalturaObjectFactory.Create(propertyNode);");
    				    break;
    			}
    			$this->appendLine("						continue;");
    		}
    		$this->appendLine("				}");
		    $this->appendLine("			}");
		}
		$this->appendLine("		}");
		$this->appendLine("		#endregion");
		$this->appendLine("");
		
		$this->appendLine("		#region Methods");
		// ToParams method
		$this->appendLine("		public new KalturaParams ToParams()");
		$this->appendLine("		{");
		$this->appendLine("			KalturaParams kparams = base.ToParams();");
		foreach($classNode->childNodes as $propertyNode)
		{
			if ($propertyNode->nodeType != XML_ELEMENT_NODE)
				continue;
				
			$propType = $propertyNode->getAttribute("type");
			$propName = $propertyNode->getAttribute("name");
			$isEnum = $propertyNode->hasAttribute("enumType");
			$dotNetPropName = $this->upperCaseFirstLetter($propName);
			
			switch($propType)
			{
				case "int":
				    if ($isEnum)
				        $this->appendLine("			kparams.AddEnumIfNotNull(\"$propName\", this.$dotNetPropName);");
				    else
					    $this->appendLine("			kparams.AddIntIfNotNull(\"$propName\", this.$dotNetPropName);");
					break;
				case "string":
					$this->appendLine("			kparams.AddStringIfNotNull(\"$propName\", this.$dotNetPropName);");
					break;
				case "bool":
					$this->appendLine("			kparams.AddBoolIfNotNull(\"$propName\", this.$dotNetPropName);");
					break;
				case "float":
					$this->appendLine("			kparams.AddFloatIfNotNull(\"$propName\", this.$dotNetPropName);");
					break;
				case "enum":
					$this->appendLine("			kparams.AddEnumIfNotNull(\"$propName\", this.$dotNetPropName);");
					break;
			}
		}
		$this->appendLine("			return kparams;");
		$this->appendLine("		}");
		$this->appendLine("		#endregion");
		
		// close class
		$this->appendLine("	}");
		$this->appendLine("}");
		$this->appendLine();
		
		$file = "Types/$type.cs";
		$this->writeToFile("output/KalturaClient/".$file, $this->getTextBlock());
		$this->_csprojIncludes[] = $file; 
	}
	
	function writeObjectFactoryClass(DOMNodeList $classNodes)
	{
	    $this->startNewTextBlock();
	    $this->appendLine("using System;");
	    $this->appendLine("using System.Text;");
	    $this->appendLine("using System.Xml;");
	    $this->appendLine("using System.Runtime.Serialization;");
	    $this->appendLine();
        $this->appendLine("namespace Kaltura");
        $this->appendLine("{");
        $this->appendLine("	public static class KalturaObjectFactory");
        $this->appendLine("	{");
        $this->appendLine("		public static object Create(XmlElement xmlElement)");
        $this->appendLine("		{");
        $this->appendLine("			switch (xmlElement[\"objectType\"].InnerText)");
        $this->appendLine("			{");
        foreach($classNodes as $classNode)
        {
            $this->appendLine("				case \"".$classNode->getAttribute("name")."\":");
            $this->appendLine("					return new ".$classNode->getAttribute("name")."(xmlElement);");    
        }
        $this->appendLine("			}");
        $this->appendLine("			throw new SerializationException(\"Invalid object type\");");
        $this->appendLine("		}");
        $this->appendLine("	}");
        $this->appendLine("}");
        
        $file = "KalturaObjectFactory.cs";
		$this->writeToFile("output/KalturaClient/".$file, $this->getTextBlock());
        $this->_csprojIncludes[] = $file;
	}
	
	function writeCsproj()
	{
	    $csprojDoc = new DOMDocument();
		$csprojDoc->formatOutput = true;
		$csprojDoc->load("output/KalturaClient/KalturaClient.csproj");
		$csprojXPath = new DOMXPath($csprojDoc);
		$csprojXPath->registerNamespace("m", "http://schemas.microsoft.com/developer/msbuild/2003");
		$compileNodes = $csprojXPath->query("//m:ItemGroup/m:Compile/..");
		$compileItemGroupElement = $compileNodes->item(0); 
		
		foreach($this->_csprojIncludes as $include)
		{
		    $compileElement = $csprojDoc->createElement("Compile");
		    $compileElement->setAttribute("Include", str_replace("/","\\", $include));
		    $compileItemGroupElement->appendChild($compileElement);
		}
		$csprojDoc->save("output/KalturaClient/KalturaClient.csproj");
	}
	
	function writeService(DOMElement $serviceNode)
	{
	    $this->startNewTextBlock();
	    $this->appendLine("using System;");
		$this->appendLine("using System.Xml;");
		$this->appendLine("using System.Collections.Generic;");
		$this->appendLine();
		$this->appendLine("namespace Kaltura");
        $this->appendLine("{");
		$serviceName = $serviceNode->getAttribute("name");
		
		$dotNetServiceName = $this->upperCaseFirstLetter($serviceName)."Service";
		$dotNetServiceType = "Kaltura" . $dotNetServiceName;
		
		$this->appendLine();
		$this->appendLine("    public class $dotNetServiceType : KalturaServiceBase");
		$this->appendLine("	{");
		$this->appendLine("    public $dotNetServiceType(KalturaClient client)");
		$this->appendLine("			: base(client)");
		$this->appendLine("		{");
		$this->appendLine("		}");	   
		 
		
		$actionNodes = $serviceNode->childNodes;
		foreach($actionNodes as $actionNode)
		{
		    if ($actionNode->nodeType != XML_ELEMENT_NODE)
				continue;
				
		    $this->writeAction($serviceName, $actionNode);
		}
		$this->appendLine("	}");
		$this->appendLine("}");
		
		$file = "Services/".$dotNetServiceName."Service.cs";
		$this->writeToFile("output/KalturaClient/".$file, $this->getTextBlock());
		$this->_csprojIncludes[] = $file; 
	}
	
	function writeAction($serviceName, DOMElement $actionNode)
	{
	    $action = $actionNode->getAttribute("name");
	    $resultNode = $actionNode->getElementsByTagName("result")->item(0);
	    $resultType = $resultNode->getAttribute("type");
		// method signiture
		$signature = "";
		
		switch($resultType)
		{
		    case null:
		        $dotNetOutputType = "void";
		        break;
	        case "array":
	            $arrayType = $resultNode->getAttribute("arrayType"); 
	            $dotNetOutputType = "IList<".$arrayType.">";
		        break;
	        default:
	            $dotNetOutputType = $resultType;
	            break;
		}
			
		$signature .= "public $dotNetOutputType ".$this->upperCaseFirstLetter($action)."(";
			
		$paramNodes = $actionNode->getElementsByTagName("param");
		foreach($paramNodes as $paramNode)
		{
		    $paramType = $paramNode->getAttribute("type");
		    $paramName = $paramNode->getAttribute("name");
		    $optional = $paramNode->getAttribute("optional");
		    
		    if ($paramType == "array")
				$dotNetType = "IList<".$paramNode->getAttribute("arrayType").">";
			else
				$dotNetType = $paramType;

			$signature .= "$dotNetType $paramName";
			
			/*
			if ($optional == "1")
			{
				if ($actionParam->isSimpleType())
					$signature .= " = ".$actionParam->getDefaultValue();
				else if (!$actionParam->isEnum())
					$signature .= " = null";
			}*/
				
			$signature .= ", ";
		}
		if ($this->endsWith($signature, ", "))
			$signature = substr($signature, 0, strlen($signature) - 2);
		$signature .= ")";
		
		$this->appendLine();	
		$this->appendLine("		$signature");
		$this->appendLine("		{");
		
		$this->appendLine("			KalturaParams kparams = new KalturaParams();");
		foreach($paramNodes as $paramNode)
		{
			$paramType = $paramNode->getAttribute("type");
		    $paramName = $paramNode->getAttribute("name");
		    $isEnum = $paramNode->hasAttribute("enumType");

	        switch ($paramType)
	        {
                case "string":
                    $this->appendLine("			kparams.Add(\"$paramName\", $paramName);");
                    break;
                case "int":
                case "float":
	                if ($isEnum)
				        $this->appendLine("			kparams.Add(\"$paramName\", $paramName.GetHashCode().ToString());");
			        else
                        $this->appendLine("			kparams.Add(\"$paramName\", $paramName.ToString());");
                    break;
                case "bool":
                    $this->appendLine("			kparams.Add(\"$paramName\", $paramName.ToString());");
                    break;
                case "array":
                    $this->appendLine("			foreach(".$paramNode->getAttribute("arrayType")." obj in $paramName)");
                    $this->appendLine("			{");
                    $this->appendLine("				kparams.Add(\"$paramName\", obj.ToParams());");
                    $this->appendLine("			}");
                    break;
                default: // for objects
                    $this->appendLine("			kparams.Add(\"$paramName\", $paramName.ToParams());");
                    break;
		    }
		}
		
		$this->appendLine("			XmlElement result = _Client.CallService(\"$serviceName\", \"$action\", kparams);");
		
		if ($resultType)
		{
			switch ($resultType)
			{
			    case "array":
    				$arrayType = $resultNode->getAttribute("arrayType");
    				$this->appendLine("			IList<$arrayType> list = new List<$arrayType>();");
    				$this->appendLine("			foreach(XmlElement node in result.ChildNodes)");
    				$this->appendLine("			{");
    				$this->appendLine("				list.Add(($arrayType)KalturaObjectFactory.Create(node));");
    				$this->appendLine("			}");
    				$this->appendLine("			return list;");
				    break;
			    case "int":
            	    $this->appendLine("			return int.Parse(result.InnerText);");
            	    break;
			    case "float":
            	    $this->appendLine("			return Single.Parse(result.InnerText);");
            	    break;
			    case "bool":
            	    $this->appendLine("			return bool.Parse(result.InnerText);");
            	    break;
			    case "string":
            	    $this->appendLine("			return result.InnerText;");
            	    break;
			    default:
            	    $this->appendLine("			return ($resultType)KalturaObjectFactory.Create(result);");
            	    break;
			}
		}
		$this->appendLine("		}");
	}
	
	function writeMainClient(DOMNodeList  $serviceNodes)
	{
	    $this->startNewTextBlock();
	    
	    $this->appendLine("using System;");
	    $this->appendLine();
	    
		$this->appendLine("namespace Kaltura");
		$this->appendLine("{");
	    $this->appendLine("    public class KalturaClient : KalturaClientBase");
        $this->appendLine("    {");
        $this->appendLine("        public KalturaClient(KalturaConfiguration config)");
        $this->appendLine("            : base(config)");
        $this->appendLine("        {");
        $this->appendLine("        }");
	    foreach($serviceNodes as $serviceNode)
		{
		    $serviceName = $serviceNode->getAttribute("name");
		    $dotNetServiceName = $this->upperCaseFirstLetter($serviceName)."Service";
		    $dotNetServiceType = "Kaltura" . $dotNetServiceName;
		    
		    $this->appendLine();		
		    $this->appendLine("		$dotNetServiceType _$dotNetServiceName;");
    		$this->appendLine("		public $dotNetServiceType $dotNetServiceName");
    		$this->appendLine("		{");
    		$this->appendLine("			get");
    		$this->appendLine("			{");
    		$this->appendLine("				if (_$dotNetServiceName == null)");
    		$this->appendLine("					_$dotNetServiceName = new $dotNetServiceType(this);");
    		$this->appendLine("");
    		$this->appendLine("				return _$dotNetServiceName;");
    		$this->appendLine("			}");
    		$this->appendLine("		}");
		}
		$this->appendLine("	}");
		$this->appendLine("}");
		
		$this->writeToFile("output/KalturaClient/KalturaClient.cs", $this->getTextBlock());

		// not needed because it is included in the sources
	    //$this->_csprojIncludes[] = "KalturaClient.cs";
	}
	private function writeToFile($fileName, $contents)
	{
		$handle = fopen($fileName, "w");
		fwrite($handle, $contents);
		fclose($handle);
	}
	
	private function upperCaseFirstLetter($str)
	{
		return ucwords($str); 
	}
	
	private function isSimpleType($type)
	{
		return in_array($type, array("int","string","bool","float"));
	}
	
	private function startNewTextBlock()
	{
		$this->_txt = "";
	}
	
	private function appendLine($txt = "")
	{
		$this->_txt .= $txt ."\n";
	}
	
	private function getTextBlock()
	{
		return $this->_txt;
	}
	
	function makeDir($dir)
	{
		if (!file_exists($dir))
			mkdir($dir,"0777",true);
	}
	
	function copyr($source, $dest)
	{
		// Simple copy for a file
		if (is_file($source)) 
		{
			$c = copy($source, $dest);
			chmod($dest, 0777);
			return $c;
		}
 
		// Make destination directory
		if (!is_dir($dest)) 
		{
			$oldumask = umask(0);
			mkdir($dest, 0777);
			umask($oldumask);
		}
		 
		// Loop through the folder
		$dir = dir($source);
		while (false !== $entry = $dir->read()) 
		{
			// Skip pointers
			if ($entry == "." || $entry == ".." || $entry == ".svn") 
			{
				continue;
			}
			 
			// Deep copy directories
			if ($dest !== "$source/$entry") 
			{
				$this->copyr("$source/$entry", "$dest/$entry");
			}
		}
		 
		// Clean up
		$dir->close();
		return true;
	}
	
	function endsWith($str, $end) 
	{
		return (substr($str, strlen($str) - strlen($end)) === $end);
	}
	
	function beginsWith($str, $end) 
	{
		return (substr($str, 0, strlen($end)) === $end);
	}
}
?>