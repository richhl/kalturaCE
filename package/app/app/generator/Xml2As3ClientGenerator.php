<?php
class Xml2As3ClientGenerator extends ClientGeneratorFromXml 
{
	private $xml;
	private $base_client_dir;
	
	public function Xml2As3ClientGenerator($xmlFilePath)
	{
		parent::ClientGeneratorFromXml($xmlFilePath, "sources/as3");
	}
	
	public function generate(  ) 
	{
		$this->base_client_dir = $this->getParam("type");
		
		$this->xml = new SimpleXMLElement( $this->_xmlFile , NULL, TRUE);
		
		foreach ($this->xml->children() as $second_gen) 
		{
			switch($second_gen->getName())
			{
				case "enums": 
					foreach($second_gen->children() as $enums_node)
					{
						$this->createTypeClass($enums_node);
					}
				break;
				case "classes":

					foreach($second_gen->children() as $classes_node)
					{
						$this->createVoClass($classes_node);
					}
				break;
				case "services": 
					foreach($second_gen->children() as $services_node)
					{
						$this->createCommands($services_node);
						$this->createServices($services_node);
					}
				break;	
			}
		}
	}	
	
	//Private functions
	/////////////////////////////////////////////////////////////
	private function createTypeClass( $xml )
	{
		$str = "package com.kaltura.types\n";
		$str .= "{\n";
		$str .= "	public class " . $xml->attributes()->name . "\n";
		$str .= "	{\n";
		$enumType = $xml->attributes()->enumType;
		foreach($xml->children() as $child)
		{
			switch($enumType)
			{
				case "int" : $str .= "		public static const " . $child->attributes()->name . " : int = " . $child->attributes()->value . ";\n"; break;
				case "string" : $str .= "		public static const " . $child->attributes()->name . " : String = '" . $child->attributes()->value . "';\n"; break;
			}
		}
		$str .= "	}\n";
		$str .= "}\n";
		
		$this->write2File( "types/" . $xml->attributes()->name . ".as" , $str );
	}
	
	private function createVoClass( $xml )
	{
		$str = "package com.kaltura.vo\n";
		$str .= "{\n";
		
		if($xml->attributes()->base)
			$str .= "	import com.kaltura.vo." . $xml->attributes()->base . ";\n\n";
		else if( $this->base_client_dir == "flex_client" )
		{
			$str .= "	import com.kaltura.vo.BaseFlexVo;\n";
		}
		else //Must be flash client
		{
			$str .= "	import com.kaltura.vo.BaseFlashVo;\n";
		}
			
		if( $this->base_client_dir == "flex_client" )
			$str .= "	[Bindable]\n";	
			
		$str .= "	public dynamic class " . $xml->attributes()->name;
		
		if($xml->attributes()->base)
			$str .= " extends " . $xml->attributes()->base;
		else if( $this->base_client_dir == "flex_client" )
		{
			$str .= " extends BaseFlexVo";
		}
		else
		{
			$str .= " extends BaseFlashVo";
		}
	
		$str .= "\n	{\n";

		foreach($xml->children() as $child)
		{
			$type = "*";
			switch($child->attributes()->type)
			{
				case "string" : $type = "String"; break;
				case "float" : $type = "Number = NaN"; break;
				case "int" : $type = "int = int.MIN_VALUE"; break;
				case "bool" : $type = "Boolean"; break;
				case "array" : $type = "Array = new Array()"; break;
				default :
					$type = $child->attributes()->type; 
					$str = $this->addImport2String( "	import com.kaltura.vo." .  $type , $str );
				break;
			}
			$str .= "		public var " . $child->attributes()->name . " : " . $type . ";\n\n"; 
		}

		//every VO can return an Array with all the his properties and is inheritance properties
		///////////////////////////////////////////////
		if($xml->attributes()->base)
			$str .= "override public function getUpdateableParamKeys():Array\n";
		else
			$str .= "public function getUpdateableParamKeys():Array\n";

		$str .="		{\n";
		$str .= "			var arr : Array;\n";
		
		if($xml->attributes()->base)
			$str .= "			arr = super.getUpdateableParamKeys();\n";
		else
			$str .= "			arr = new Array();\n"; 
				
		foreach($xml->children() as $child)
		{
			if($child->attributes()->readOnly == "0" && $child->attributes()->insertOnly == "0")
				$str .= "			arr.push('" . $child->attributes()->name . "');\n";
		}
			
		$str .= "			return arr;\n";	
		$str .= "		}\n";

		////////////////////////////////////////////////
		
		$str .= "	}\n";
		$str .= "}\n";
		$this->write2File( "vo/" . $xml->attributes()->name . ".as" , $str );
	}

	private function createCommands ( $xml )
	{
		foreach($xml->children() as $child)
		{
			$const_props = "";
			$imports = "";
			$check_init = "";
			$add_check_init = false;
			$first_object = true;
			
			$keys_values_creator = "\n			var keyArr : Array = new Array();\n";
			$keys_values_creator .= "			var valueArr : Array = new Array();\n";
			$keys_values_creator .= "			var keyValArr : Array = new Array();\n";
			
			foreach($child->children() as $prop)
			{
				if($prop->getName() == "param" )
				{
					switch($prop->attributes()->type)
					{
						case "string": 
							$const_props .= $prop->attributes()->name . " : String";
							if($prop->attributes()->optional == "1")
							{
								if($prop->attributes()->default)
									$const_props .= "='" . $prop->attributes()->default . "'";
								else
									$const_props .= "=null";
							}
							$const_props .= ",";			
							
							$keys_values_creator .= "			keyArr.push( '" . $prop->attributes()->name . "' );\n";
							$keys_values_creator .= "			valueArr.push( " . $prop->attributes()->name . " );\n";	

						break;
						case "float" :
							$const_props .= $prop->attributes()->name . " : Number";
							if($prop->attributes()->optional == "1")
							{
								if($prop->attributes()->optional == "1")
								{	
									if($prop->attributes()->default)
										$const_props .= "=" . $prop->attributes()->default;
									else
										$const_props .= "=NaN";	
								}
							}	
							$const_props .= ",";	

							$keys_values_creator .= "			keyArr.push( '" . $prop->attributes()->name . "' );\n";
							$keys_values_creator .= "			valueArr.push( " . $prop->attributes()->name . " );\n";	

						break;
						case "int": 
							$const_props .= $prop->attributes()->name . " : int";	
							if($prop->attributes()->optional == "1")
							{	
								if($prop->attributes()->default && $prop->attributes()->default != "")
									$const_props .= "=" . $prop->attributes()->default;
								else
									$const_props .= "=undefined";	
							}
							$const_props .= ",";	

							$keys_values_creator .= "			keyArr.push( '" . $prop->attributes()->name . "' );\n";
							$keys_values_creator .= "			valueArr.push( " . $prop->attributes()->name . " );\n";	
							
						break;
						case "bool" : 
							$const_props .= $prop->attributes()->name . " : Boolean";
							if($prop->attributes()->optional == "1")	
							{
								if($prop->attributes()->default)
									$const_props .= "=" . $prop->attributes()->default;
								else
									$const_props .= "=false";	
							}
							$const_props .= ",";
							
							$keys_values_creator .= "			keyArr.push( '" . $prop->attributes()->name . "' );\n";
							$keys_values_creator .= "			valueArr.push( " . $prop->attributes()->name . " );\n";
								
						break;
						case "array" :
							$const_props .= $prop->attributes()->name . " : Array";
							if($prop->attributes()->optional == "1")
							{	
								$add_check_init = true;
								$check_init .= "			if(" . $prop->attributes()->name . "== null)" . $prop->attributes()->name . "= new Array();\n";
								
								if($prop->attributes()->default)
									$const_props .= "=" . $prop->attributes()->default;
								else
									$const_props .= "=null";
							}
							$const_props .= ",";	 
							$keys_values_creator .= " 			keyValArr = extractArray(" . $prop->attributes()->name . ",'" . $prop->attributes()->name . "');\n";
							$keys_values_creator .= "			keyArr = keyArr.concat( keyValArr[0] );\n";
							$keys_values_creator .= "			valueArr = valueArr.concat( keyValArr[1] );\n";
						break;
						default: //is Object	
							$const_props .= $prop->attributes()->name . " : " . $prop->attributes()->type;
							if($prop->attributes()->optional == "1")
							{	
								$add_check_init = true;
								$check_init .= "			if(" . $prop->attributes()->name . "== null)" . $prop->attributes()->name . "= new " .$prop->attributes()->type . "();\n";
								
								if($prop->attributes()->default)
									$const_props .= "=" . $prop->attributes()->default;
								else
									$const_props .= "=null";
							}
							$const_props .= ",";	
							$imports .=  "	import com.kaltura.vo." .  $this->toUpperCamaleCase( $prop->attributes()->type ) . ";\n"; 
							$keys_values_creator .= " 			keyValArr = kalturaObject2Arrays(" . $prop->attributes()->name . ",'" . $prop->attributes()->name . "');\n";
							$keys_values_creator .= "			keyArr = keyArr.concat( keyValArr[0] );\n";
							$keys_values_creator .= "			valueArr = valueArr.concat( keyValArr[1] );\n";
						break;
					}
				}
			}
			
			$const_props = substr($const_props , 0 , -1);
			
			$str = "package com.kaltura.commands." .  $xml->attributes()->name  . "\n";
			$str .= "{\n";
			$str .= $imports;
			$str .= "	import com.kaltura.delegates." . $xml->attributes()->name . "." . $this->toUpperCamaleCase($xml->attributes()->name) . $this->toUpperCamaleCase( $child->attributes()->name ) . "Delegate;\n";
			$str .= "	import com.kaltura.net.KalturaCall;\n\n";
			
			$str .= "	public class " . $this->toUpperCamaleCase($xml->attributes()->name) . $this->toUpperCamaleCase( $child->attributes()->name ) . " extends KalturaCall\n" ;
			$str .= "	{\n";
			$str .= "		public var filterFields : String;\n";
			$str .= "		public function " . $this->toUpperCamaleCase($xml->attributes()->name) . $this->toUpperCamaleCase( $child->attributes()->name ) . "( " . $const_props . " )\n";
			$str .= "		{\n";
			if($add_check_init)
			$str .= $check_init;
			$str .= "			service= '" . $xml->attributes()->id . "';\n";
			$str .= "			action= '" . $child->attributes()->name . "';\n";
			$str .=	$keys_values_creator;
			$str .= "			applySchema( keyArr , valueArr );\n";

			$str .= "		}\n\n";
			
			$str .= "		override public function execute() : void\n";
			$str .= "		{\n";
			$str .= "			setRequestArgument('filterFields',filterFields);\n";
			$str .= "			delegate = new " . $this->toUpperCamaleCase($xml->attributes()->name) . $this->toUpperCamaleCase($child->attributes()->name) . "Delegate( this , config );\n";
			$str .= "		}\n";
			$str .= "	}\n";
			$str .= "}\n";
			
			$this->write2File( "commands/" . $xml->attributes()->name . "/" . $this->toUpperCamaleCase($xml->attributes()->name) . $this->toUpperCamaleCase($child->attributes()->name) . ".as" , $str );
		}
	}
	
	private function createServices( $xml )
	{
		foreach($xml->children() as $child)
		{
			$str = "package com.kaltura.delegates." . $xml->attributes()->name . "\n";
			$str .= "{\n";
			$str .= "	import flash.utils.getDefinitionByName;\n";
			$str .= "	import com.kaltura.config.KalturaConfig;\n";
			$str .= "	import com.kaltura.net.KalturaCall;\n";
			$str .= "	import com.kaltura.delegates.WebDelegateBase;\n"; 

			$str .= "	public class " . $this->toUpperCamaleCase($xml->attributes()->name) . $this->toUpperCamaleCase( $child->attributes()->name ) . "Delegate extends WebDelegateBase\n" ;
			$str .= "	{\n";
			$str .= "		public function " . $this->toUpperCamaleCase($xml->attributes()->name) . $this->toUpperCamaleCase( $child->attributes()->name ) . "Delegate(call:KalturaCall, config:KalturaConfig)\n";
			$str .= "		{\n";
			$str .= "			super(call, config);\n";
			$str .= "		}\n\n";



			switch( $child->result->attributes()->type )
			{
				case "int":
				case "bool":
				case "float" :
				case "string": 
					$str .= "		override public function parse( result : XML ) : *\n";
					$str .= "		{\n";
					$str .= "			return result.result.toString();\n"; 
					$str .= "		}\n\n";
				break;
				case "array":
					$str .= "		override public function parse( result : XML ) : *\n";
					$str .= "		{\n";
					$str = $this->addImport2String( "	import com.kaltura.core.KClassFactory" , $str );
					if( $child->result->attributes()->arrayType )
						$str = $this->addImport2String( "	import com.kaltura.vo." .  $child->result->attributes()->arrayType . ";" . $child->result->attributes()->arrayType . ";", $str);
						
					$str .= "			var arr : Array = new Array();\n";
					$str .= "			for( var i:int=0; i<result.result.children().length() ; i++)\n";
					$str .= "			{\n";
					$str .= "				var cls : Class = getDefinitionByName('com.kaltura.vo.'+ result.result.children()[i].objectType) as Class;\n";
					$str .= "				var obj : * = (new KClassFactory( cls )).newInstanceFromXML( XMLList(result.result.children()[i]) );\n";
					$str .= "				arr.push(obj);\n";
					$str .= "			}\n";
					$str .= "			return arr;\n";
					$str .= "		}\n\n";
				break;
				default:
					//this code moved to the delegate class so it's not needed
					/*$str = $this->addImport2String( "	import com.kaltura.core.KClassFactory" , $str );
					$str .= "			var cls : Class = getDefinitionByName('com.kaltura.vo.'+ result.result.objectType) as Class;\n";
					$str .= "			var obj : * = (new KClassFactory( cls )).newInstanceFromXML( result.result );\n";
					$str .= "			return obj;\n";*/
				break;
			}
			

			$str .= "	}\n";
			$str .= "}\n";
			
			$this->write2File( "delegates/" . $xml->attributes()->name . "/" . $this->toUpperCamaleCase($xml->attributes()->name) . $this->toUpperCamaleCase($child->attributes()->name) . "Delegate.as" , $str );
		}
	}
	
	private function addImport2String( $type ,  $str ) 
	{
		$import = $type . ";";
		$cut_pos = strpos($str , "{");
		$first_str = substr($str ,0 , ($cut_pos+1));
		$sec_str = substr($str ,($cut_pos +1));
		$str = $first_str . "\n" . $import . "\n" . $sec_str;
		return $str;
	}
	
	private function getObjectProps($type)
	{
		$val_arr = array();
		foreach ( $this->xml->classes->children() as $k_class) //TODO: SEE IF XML CAN DO IT WITHOUT LOOPING
		{
			if($k_class->attributes()->name == rtrim($type) )
			{
				if($k_class->attributes()->base)
					$val_arr = array_merge( $val_arr, $this->getObjectProps( $k_class->attributes()->base )	);
				
				foreach($k_class->children() as $prop)
					array_push( $val_arr , $prop->attributes()->name);
			}
		}
		
		//TODO: ADD THE BASE ATTRIBUTES
		return $val_arr;
	}
	
	private function getDelegateParseFunction()
	{
		foreach($xml->children() as $child)
		{
			$res = "override public function parse( result : XML ) : * {";
		}
	}
	
	private function write2File( $filename , $contents )
	{
		$this->addFile($filename, $contents);
	}
	
	private function toUpperCamaleCase( $str )
	{
		$upper=ucwords($str); 
		$str=str_replace(' ', '', $upper); 
		return $str;
	}
}
?>