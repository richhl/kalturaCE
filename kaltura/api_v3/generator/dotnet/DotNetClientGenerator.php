<?php
class DotNetClientGenerator extends ClientGeneratorBase 
{
	protected function writeHeader()
	{
		$this->echoLine("using System;");
		$this->echoLine("using System.Text;");
		$this->echoLine("using System.Collections.Generic;");
		$this->echoLine("using System.Collections.Specialized;");
		$this->echoLine("using System.Xml;");
		$this->echoLine();
		$this->echoLine('namespace Kaltura');
		$this->echoLine('{');
	}
	
	protected function writeFooter()
	{
		$this->echoLine("}");
	}
	
	protected function writeBeforeServices()
	{
		$this->echoLine('	public class KalturaClient : KalturaClientBase');
		$this->echoLine('	{');
		$this->echoLine('		public KalturaClient(KalturaConfiguration config) : base(config)');
		$this->echoLine('		{');
		$this->echoLine('		}');
	}
	
	protected function writeBeforeService(KalturaServiceReflector $serviceReflector)
	{
		$serviceName = $serviceReflector->getServiceName();
		
		$dotNetServiceName = $this->upperCaseFirstLetter($serviceName)."Service";
		$dotNetServiceType = "Kaltura" . $dotNetServiceName;
		
		$this->echoLine();		
		$this->echoLine("		$dotNetServiceType _$dotNetServiceName;");
		$this->echoLine("		public $dotNetServiceType $dotNetServiceName");
		$this->echoLine("		{");
		$this->echoLine("			get");
		$this->echoLine("			{");
		$this->echoLine("				if (_$dotNetServiceName == null)");
		$this->echoLine("					_$dotNetServiceName = new $dotNetServiceType(this);");
		$this->echoLine("");
		$this->echoLine("				return _$dotNetServiceName;");
		$this->echoLine("			}");
		$this->echoLine("		}");
		$this->echoLine("");
		$this->echoLine("		public class $dotNetServiceType : KalturaServiceBase");
		$this->echoLine("		{");
		$this->echoLine("			public $dotNetServiceType(KalturaClient _Client)");
		$this->echoLine("				: base(_Client)");
		$this->echoLine("			{");
		$this->echoLine("			}");
	}
	
	protected function writeServiceAction($serviceName, $action, $actionParams, $outputTypeReflector)
	{
			// method signiture
			$signature = "";
			if ($outputTypeReflector)
			{
				if ($outputTypeReflector->isArray())	
					$dotNetOutputType = "IList<".$outputTypeReflector->getArrayType().">";
				else
					$dotNetOutputType = $outputTypeReflector->getType();
			}
			else 
			{
				$dotNetOutputType = "void";
			}
			
			$signature .= "public $dotNetOutputType ".$this->upperCaseFirstLetter($action)."(";
				
			foreach($actionParams as $actionParam)
			{
				if ($actionParam->isArray())
					$dotNetType = "IList<".$actionParam->getArrayType().">";
				else
					$dotNetType = $actionParam->getType();

				$paramName = $actionParam->getName();
				$signature .= "$dotNetType $paramName";
				
				if ($actionParam->isOptional())
				{
					if ($actionParam->isSimpleType())
						$signature .= " = ".$actionParam->getDefaultValue();
					else if (!$actionParam->isEnum())
						$signature .= " = null";
				}
					
				$signature .= ", ";
			}
			if ($this->endsWith($signature, ", "))
				$signature = substr($signature, 0, strlen($signature) - 2);
			$signature .= ")";
			
			$this->echoLine();	
			$this->echoLine("			$signature");
			$this->echoLine("			{");
			
			$this->echoLine("				KalturaParams kparams = new KalturaParams();");
			foreach($actionParams as $actionParam)
			{
				$paramType = $actionParam->getType();
				$paramName = $actionParam->getName();
				
				if ($actionParam->isComplexType())
				{
					if ($actionParam->isEnum())
					{
						$this->echoLine("				kparams.Add(\"$paramName\", $paramName.GetHashCode().ToString());");
					}
					else if ($actionParam->isArray())
					{
						$this->echoLine("				foreach(".$actionParam->getArrayType()." obj in $paramName)");
						$this->echoLine("				{");
						$this->echoLine("					kparams.Add(\"$paramName\", obj.ToParams());");
						$this->echoLine("				}");
					}
					else
					{
						$this->echoLine("				kparams.Add(\"$paramName\", $paramName.ToParams());");
					}
				}
				else if ($paramType == "string") 
				{
					$this->echoLine("				kparams.Add(\"$paramName\", $paramName);");
				}
				else
				{
					$this->echoLine("				kparams.Add(\"$paramName\", $paramName.ToString());");
				}
			}
			
			$this->echoLine("				XmlNode result = _Client.CallService(\"$serviceName\", \"$action\", kparams);");
			
			if ($outputTypeReflector)
			{
				if ($outputTypeReflector->isArray())
				{
					$arrayType = $outputTypeReflector->getArrayType();
					$this->echoLine("				_Client.ValidateArrayType(result, \"".$arrayType."\");");
					
					$this->echoLine("				IList<$arrayType> list = new List<$arrayType>();");
					$this->echoLine("				foreach(XmlNode node in result.ChildNodes)");
					$this->echoLine("				{");
					$this->echoLine("					list.Add(new $arrayType(node.ChildNodes[0]));");
					$this->echoLine("				}");
					$this->echoLine("				return list;");
				}
				else
				{
					$this->echoLine("				_Client.ValidateObjectType(result, \"".$outputTypeReflector->getType()."\");");
	            	$this->echoLine("				return new ".$outputTypeReflector->getType()."(result.ChildNodes[0]);");
				}
			}
			$this->echoLine("			}");	
	}
	
	protected function writeAfterService(KalturaServiceReflector $serviceReflector)
	{
		$this->echoLine("		}");
	}
	
	protected function writeAfterServices()
	{
		$this->echoLine("	}");
	}
	
	protected function writeBeforeTypes()
	{
		
	}
	
	protected function writeType(KalturaTypeReflector $typeReflector)
	{
		$type = $typeReflector->getType();
		if ($typeReflector->isEnum())
		{
			$contants = $typeReflector->getConstants();
			$this->echoLine("	public enum $type");
			$this->echoLine("	{");
			foreach($contants as $contant)
			{
				$name = $contant->getName();
				$value = $contant->getDefaultValue();
				$this->echoLine("		$name = $value,");
			}
			$this->echoLine("	}");
			$this->echoLine();
		}
		else if (!$typeReflector->isArray())
		{
			// class definition
			$properties = $typeReflector->getProperties();
			$this->echoLine("	public class $type : KalturaObjectBase");
			$this->echoLine("	{");
			
			$this->echoLine("		#region Properties");
			// class properties
			foreach($properties as $property)
			{
				$propType = $property->getType();
				$propName = $property->getName();
				$dotNetPropName = $this->upperCaseFirstLetter($propName);
				$propertyLine =	"public $propType $dotNetPropName";
				if ($property->isSimpleType())
				{
					switch($propType)
					{
						case "int":
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
				}
				else if ($property->isEnum())
				{
					$propertyLine .= " = ($propType)Int32.MinValue";
				}
				$this->echoLine("		$propertyLine;");
			}
			$this->echoLine("		#endregion");
			$this->echoLine();
			
			$this->echoLine("		#region CTor");
			// CTor
			$this->echoLine("		public $type()");
			$this->echoLine("		{");
			$this->echoLine("		}");
			$this->echoLine("");
			
			// CTor For XmlNode
			$this->echoLine("		public $type(XmlNode node)");
			$this->echoLine("		{");
            $this->echoLine("			foreach (XmlNode propertyNode in node.ChildNodes)"); 
            $this->echoLine("			{");
			$this->echoLine("				string txt = propertyNode.InnerText;");
           	$this->echoLine("				switch (propertyNode.Value)");
			$this->echoLine("				{");
			foreach($properties as $property)
			{
				$propType = $property->getType();
				$propName = $property->getName();
				$dotNetPropName = $this->upperCaseFirstLetter($propName);
				$this->echoLine("					case \"$propName\":");
				if ($property->isSimpleType())
				{
					switch($propType)
					{
						case "int":
							$this->echoLine("						this.$dotNetPropName = int.Parse(txt);");
							break;
						case "string":
							$this->echoLine("						this.$dotNetPropName = txt;");
							break;
						case "bool":
							$this->echoLine("						this.$dotNetPropName = bool.Parse(txt);");
							break;
						case "float":
							$this->echoLine("						this.$dotNetPropName = float.Parse(txt);");
							break;
					}
				}
				else if ($property->isEnum())
				{
					$this->echoLine("						this.$dotNetPropName = ($propType)Int32.Parse(txt);");
				}
				$this->echoLine("						continue;");
			}
			$this->echoLine("				}");
			$this->echoLine("			}");
			$this->echoLine("		}");
			$this->echoLine("		#endregion");
			$this->echoLine("");
			
			$this->echoLine("		#region Methods");
			// ToParams method
			$this->echoLine("		public KalturaParams ToParams()");
			$this->echoLine("		{");
			$this->echoLine("			KalturaParams kparams = new KalturaParams();");
			foreach($properties as $property)
			{
				$propType = $property->getType();
				$propName = $property->getName();
				$dotNetPropName = $this->upperCaseFirstLetter($propName);
				
				if ($property->isSimpleType())
				{
					switch($propType)
					{
						case "int":
							$this->echoLine("			this.AddIntIfNotNull(kparams, \"$propName\", this.$dotNetPropName);");
							break;
						case "string":
							$this->echoLine("			this.AddStringIfNotNull(kparams, \"$propName\", this.$dotNetPropName);");
							break;
						case "bool":
							$this->echoLine("			this.AddBoolIfNotNull(kparams, \"$propName\", this.$dotNetPropName);");
							break;
						case "float":
							$this->echoLine("			this.AddFloatIfNotNull(kparams, \"$propName\", this.$dotNetPropName);");
							break;
					}
				}
				else if ($property->isEnum())
				{
						$this->echoLine("			this.AddEnumIfNotNull(kparams, \"$propName\", this.$dotNetPropName);");
				}
				else
				{ 
					continue; // ignore sub objects and arrays
				}
			}
			$this->echoLine("			return kparams;");
			$this->echoLine("		}");
			$this->echoLine("		#endregion");
			
			// close class
			$this->echoLine("	}");
			$this->echoLine();
		}
	}
	
	protected function writeAfterTypes()
	{
		
	}
	
	private function echoLine($text = "")
	{
		echo $text."\n";
	}
	
	private function upperCaseFirstLetter($text)
	{
		if (strlen($text) > 0)
			$text[0] = strtoupper($text[0]);
		return $text;
	}
}