package com.kaltura.config 
{	
	import flash.events.EventDispatcher;

	public class KalturaConfig extends EventDispatcher implements IKalturaConfig
	{
		protected var _partnerId:String; 
		protected var _ks:String;
		
		protected var _domain : String = "http://www.kaltura.com";
		protected var _srvUrl:String = "/restserver.php"; //will be defined by the genertor
		
		public function KalturaConfig() {
			super();
		}

		public function set domain(value:String):void { _domain= value; }
		public function get domain():String { return _domain; }
		
		public function set srvUrl(value:String):void { _srvUrl= value; }
		public function get srvUrl():String { return _srvUrl; }

		public function get partnerId():String { return _partnerId;	}
		public function set partnerId(value:String):void {  _partnerId = value; }

		public function get ks():String { return _ks; }
		public function set ks(value:String):void { _ks = value; }

	}
}