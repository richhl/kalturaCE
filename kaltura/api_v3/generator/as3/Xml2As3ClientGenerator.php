<?php
require_once("utils/dir_copy.php");

class Xml2As3ClientGenerator
{
	private $xml;
	
	public function generate( $xmlFilePath ) 
	{
		if( ! is_dir( "client" ) ) mkdir("client","0777",true);
			$this->xml = new SimpleXMLElement( $xmlFilePath , NULL, TRUE);
		
		dircopy("base/", "client/");
		
		foreach ($this->xml->children() as $second_gen) 
		{
			switch($second_gen->getName())
			{
				case "enums": 
					if( ! is_dir( "client/types" ) ) mkdir("client/types","0777",true);
					foreach($second_gen->children() as $enums_node)
					{
						$this->createTypeClass($enums_node);
					}
				break;
				case "classes":
					if( ! is_dir( "client/vo" ) ) mkdir("client/vo","0777",true); 
					foreach($second_gen->children() as $classes_node)
					{
						$this->createVoClass($classes_node);
					}
				break;
				case "services": 
					if( ! is_dir( "client/commands" ) ) mkdir("client/commands","0777",true);
					if( ! is_dir( "client/delegates" ) ) mkdir("client/delegates","0777",true); 
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
		foreach($xml->children() as $child)
		{
			$str .= "		public static const " . $child->attributes()->name . " : int = " . $child->attributes()->value . ";\n"; 
		}
		$str .= "	}\n";
		$str .= "}\n";
		
		$this->write2File( "client/types/" . $xml->attributes()->name . ".as" , $str );
	}
	
	private function createVoClass( $xml )
	{
		$str = "package com.kaltura.vo\n";
		$str .= "{\n";
		
		$added_getDefinitionByName = false;
		foreach($xml->children() as $child)
		{
			switch($child->attributes()->type)
			{
				//if it's not an object don't add import
				case "string" : ; break; case "int" : ; break; case "bool" : ; break; case "float" : ; break;
				case "array" : ;
				default: $added_getDefinitionByName = true; break;
			}
		}
		
		if($added_getDefinitionByName)
			$str .= "	import flash.utils.getDefinitionByName;\n";
		
		if($xml->attributes()->base)
			$str .= "	import com.kaltura.vo." . $xml->attributes()->base . ";\n\n";

			
		$str .= "	public class " . $xml->attributes()->name;
		
		if($xml->attributes()->base)
			$str .= " extends " . $xml->attributes()->base;
	
		$str .= "\n	{\n";
		
		foreach($xml->children() as $child)
		{
			$type = "*";
			switch($child->attributes()->type)
			{
				case "string" : $type = "String"; break;
				case "float" : $type = "Number"; break;
				case "int" : $type = "int"; break;
				case "bool" : $type = "Boolean"; break;
				case "array" : $type = "Array = new Array()"; break;
				default :
					$type = $child->attributes()->type; 
					$str = $this->addImport2String( "	import com.kaltura.vo." .  $type , $str );
				break;
			}
			$str .= "		public var " . $child->attributes()->name . " : " . $type . ";\n"; 
		}
		
		$str .= "\n		public function " . $xml->attributes()->name . "( xml : XMLList = null )\n";
		$str .= "		{\n";
		
		if($xml->attributes()->base)
			$str .= "			super(xml);\n";
		
		$str .= "			if(xml)\n";
		$str .= "			{\n";
		foreach($xml->children() as $child)
		{
			switch($child->attributes()->type)
			{
				case "string" : 
				case "float" :
				case "int" : $str .= "				this." . $child->attributes()->name . " = xml.". $child->attributes()->name .";\n"; break;
				case "bool" : $str .= "				this." . $child->attributes()->name . " = Boolean(xml.". $child->attributes()->name .");\n"; break;
				case "array" :
					$str .= "				for each( var prop : XML in xml.objects.children())\n"; 
					$str .= "				{\n";
					$str .= "					var cls : Class = getDefinitionByName('com.kaltura.vo.'+prop.objectType) as Class;\n"; 	
					$str .= "					objects.push( new cls( XMLList(prop) ) );\n";
					$str .= "				}\n";
				break;
				default : 
					$str .= "				var cls : Class = getDefinitionByName('com.kaltura.vo.'+" . $child->attributes()->type . ") as Class;\n";
					$str .= "				this." . $child->attributes()->name . " = new cls( xml." . $child->attributes()->type . ");\n";
				break;	
			}
		}
		$str .= "			}\n";
		$str .= "		}\n";
		
		$str .= "	}\n";
		$str .= "}\n";
		$this->write2File( "client/vo/" . $xml->attributes()->name . ".as" , $str );
	}

	private function createCommands ( $xml )
	{
		foreach($xml->children() as $child)
		{
			if( ! is_dir( "client/commands/" . $xml->attributes()->name ) )
				mkdir( "client/commands/" . $xml->attributes()->name ,"0777",true); 
				
			$const_props = "";
			$first_schema_props = "";
			$second_schema_props = "";
			$imports = "";
			$check_init = "";
			$add_check_init = false;
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
								{
									if($prop->attributes()->default == '')
										$const_props .= "=''";
									else 
										$const_props .= "='" . $prop->attributes()->default . "'";
								}
								else
									$const_props .= "=null";
							}
							$const_props .= ",";				
							$first_schema_props .= "'" . $prop->attributes()->name . "',";
							$second_schema_props .= $prop->attributes()->name . ",";
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
							$first_schema_props .= "'" . $prop->attributes()->name . "',";
							$second_schema_props .= $prop->attributes()->name . ",";
						break;
						case "int": 
							$const_props .= $prop->attributes()->name . " : int";	
							if($prop->attributes()->optional == "1")
							{	
								if($prop->attributes()->default)
									$const_props .= "=" . $prop->attributes()->default;
								else
									$const_props .= "=0";	
							}
							$const_props .= ",";		
							$first_schema_props .= "'" . $prop->attributes()->name . "',";
							$second_schema_props .= $prop->attributes()->name . ",";
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
							$first_schema_props .= "'" . $prop->attributes()->name . "',";
							$second_schema_props .= $prop->attributes()->name . ",";
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
							
							$obj_props_arr = $this->getObjectProps($prop->attributes()->type);
							foreach( $obj_props_arr as $value )
							{
								$first_schema_props .=  "'" . $value . "',";
								$second_schema_props .= $prop->attributes()->name . "." . $value . ",";
							}
						break;
					}
				}
			}
			
			$const_props = substr($const_props , 0 , -1);
			$first_schema_props = substr( $first_schema_props , 0 , -1);
			$second_schema_props = substr( $second_schema_props , 0 , -1);
			
			/*if(! $const_props ) $const_props = "";*/
			if(! $first_schema_props ) $first_schema_props = "''";
			if(! $second_schema_props ) $second_schema_props = "''";
			
			$str = "package com.kaltura.commands." .  $xml->attributes()->name  . "\n";
			$str .= "{\n";
			$str .= $imports;
			$str .= "	import com.kaltura.delegates." . $xml->attributes()->name . "." . $this->toUpperCamaleCase($xml->attributes()->name) . $this->toUpperCamaleCase( $child->attributes()->name ) . "Delegate;\n";
			$str .= "	import com.kaltura.net.KalturaCall;\n\n";
			
			$str .= "	public class " . $this->toUpperCamaleCase($xml->attributes()->name) . $this->toUpperCamaleCase( $child->attributes()->name ) . " extends KalturaCall\n" ;
			$str .= "	{\n";
			$str .= "		public function " . $this->toUpperCamaleCase($xml->attributes()->name) . $this->toUpperCamaleCase( $child->attributes()->name ) . "( " . $const_props . " )\n";
			$str .= "		{\n";
			if($add_check_init)
			$str .= $check_init;
			$str .= "			action = 'service=" . $xml->attributes()->name . "&action=" . $child->attributes()->name . "';\n";
			$str .= "			applySchema([" . $first_schema_props . "] , " . $second_schema_props . ");\n";
			$str .= "		}\n\n";
			
			$str .= "		override public function execute() : void\n";
			$str .= "		{\n";
			$str .= "			delegate = new " . $this->toUpperCamaleCase($xml->attributes()->name) . $this->toUpperCamaleCase($child->attributes()->name) . "Delegate( this , config );\n";
			$str .= "		}\n";
			$str .= "	}\n";
			$str .= "}\n";
			
			$this->write2File( "client/commands/" . $xml->attributes()->name . "/" . $this->toUpperCamaleCase($xml->attributes()->name) . $this->toUpperCamaleCase($child->attributes()->name) . ".as" , $str );
		}
	}
	
	private function createServices( $xml )
	{
		foreach($xml->children() as $child)
		{
			if( ! is_dir( "client/delegates/" . $xml->attributes()->name ) )
				mkdir( "client/delegates/" . $xml->attributes()->name ,"0777",true); 
			
			$str = "package com.kaltura.delegates." . $xml->attributes()->name . "\n";
			$str .= "{\n";
			$str .= "	import flash.utils.getDefinitionByName;\n";
			$str .= "	import com.kaltura.config.KalturaConfig;\n";
			$str .= "	import com.kaltura.net.KalturaCall;\n";
			$str .= "	import com.kaltura.delegates.WebDelegateBase;\n";
			$str .= "	import com.kaltura.errors.KalturaError;\n";
			$str .= "	import flash.events.ErrorEvent;\n\n";

			$str .= "	public class " . $this->toUpperCamaleCase($xml->attributes()->name) . $this->toUpperCamaleCase( $child->attributes()->name ) . "Delegate extends WebDelegateBase\n" ;
			$str .= "	{\n";
			$str .= "		public function " . $this->toUpperCamaleCase($xml->attributes()->name) . $this->toUpperCamaleCase( $child->attributes()->name ) . "Delegate(call:KalturaCall, config:KalturaConfig)\n";
			$str .= "		{\n";
			$str .= "			super(call, config);\n";
			$str .= "		}\n\n";
			$str .= "		override protected function parse( result : XML ) : *\n";
			$str .= "		{\n";


			$is_complex = false;
			if(!$child->result->attributes()->type)
				$str .= "			return '';\n";
			else
			{
				switch( $child->result->attributes()->type )
				{
					case "int":
					case "bool":
					case "float" :
					case "string": $str .= "			return result.result.toString();\n"; break;
					default:
						$is_complex = true;
						$str .= "			var cls : Class = getDefinitionByName('com.kaltura.vo.'+ result.result.objectType) as Class;\n";
						$str .= "			var obj : * = new cls(result.result);\n";
						$str .= "			return obj;\n";
						
						/*$class_name = $child->result->attributes()->type;
						$str = $this->addImport2String($class_name , $str);
						
						$str .= "			var obj : " . $class_name ." = new " . $class_name . "();\n";
						$str .= $this->getDelegateSetters( $class_name , "obj" , "result.result"); //TODO: FILL THE OBJECT WITH ALL IT'S PARAMS
						$str .= "			return obj;\n";*/
					break;
				}
			} 
			
			$str .= "		}\n\n";
			$str .= "		override protected function validateKalturaResponse(  result : String ) : KalturaError\n";
			$str .= "		{\n";
			
			if($is_complex){
				$str = $this->addImport2String( "	import com.kaltura.events.KalturaEvent" , $str );
				$str .= "			var kError : KalturaError;\n";
				$str .= "			var xml : XML = XML(result);\n";
				$str .= "			if(xml.result.hasOwnProperty('error')){\n";
				$str .= "				kError = new KalturaError();\n";
				$str .= "				kError.errorCode = xml.result.error.code;\n";
				$str .= "				kError.errorMsg = xml.result.error.message;\n";
				$str .= "				call.handleError(kError);\n";
				$str .= "				dispatchEvent(new KalturaEvent(KalturaEvent.FAILED, false, false, false, null, kError));\n";
				$str .= "				return kError;\n";
				$str .= "			}\n";	
			}
	
			$str .= "			return null;\n";
			$str .= "		}\n\n";
			$str .= "		override protected function createKalturaError( event : ErrorEvent , loaderData : * ) : KalturaError\n";
			$str .= "		{\n";
			$str .= "			return null;\n";
			$str .= "		}\n\n";
			$str .= "	}\n";
			$str .= "}\n";
			
			$this->write2File( "client/delegates/" . $xml->attributes()->name . "/" . $this->toUpperCamaleCase($xml->attributes()->name) . $this->toUpperCamaleCase($child->attributes()->name) . "Delegate.as" , $str );
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
	
	private function getDelegateSetters($type , $obj_name , $res_path)
	{
		$flat_params = "";
		foreach ( $this->xml->classes->children() as $k_class) 
		{
			if($k_class->attributes()->name == rtrim($type) )
			{
				foreach($k_class->children() as $prop)
				{
					if($prop->attributes()->type == "array")
					{
						$flat_params .= "			var arr : Array = new Array();\n";
						$flat_params .= "			for( var i:int=0; i<result.result.objects.length() ; i++)\n";
						$flat_params .= "			{\n";
						$flat_params .= "			var o : " . $prop->attributes()->arrayType . " = new " . $prop->attributes()->arrayType . "();\n";
						$flat_params .= "" . $this->getDelegateSetters( $prop->attributes()->arrayType , "o" , "result.result.objects[i]"); //TODO: fix this to be good!!!
						$flat_params .= "			arr.push(o);\n";
						$flat_params .= "			}\n";
						$flat_params .= "			" . $obj_name . "." . $prop->attributes()->name . " = arr;\n"; 
					}
					else
						$flat_params .= "			" . $obj_name . "." . $prop->attributes()->name .  " = " . $res_path . "." . $prop->attributes()->name . ";\n"; 
				}
				
				//TODO: ADD THE BASE ATTRIBUTES if $k_class inheret
			}
		}
		return $flat_params;
	}
	
	private function getObjectProps($type)
	{
		$val_arr = array();
		foreach ( $this->xml->classes->children() as $k_class) //TODO: SEE IF XML CAN DO IT WITHOUT LOOPING
		{
			if($k_class->attributes()->name == rtrim($type) )
			{
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
			$res = "override protected function parse( result : XML ) : * {";
		}
	}
	
	private function write2File( $filename , $contents )
	{
		$handle = fopen($filename, "w");
		fwrite( $handle , $contents );
		fclose( $handle  );
	}
	
	private function toUpperCamaleCase( $str )
	{
		$upper=ucwords($str); 
		$str=str_replace(' ', '', $upper); 
		return $str;
	}
}
?>