package com.kaltura
{
	import com.kaltura.config.KalturaConfig;
	import com.kaltura.net.KalturaCall;
	
	import flash.events.EventDispatcher;

	public class KalturaClient extends EventDispatcher
	{	
		protected var _currentConfig:KalturaConfig;
		
		public function KalturaClient( config : KalturaConfig) 
		{
			_currentConfig = config;
		}
		
		//Setters & Getters
		public function get partnerId():String  { return _currentConfig ? this._currentConfig.partnerId : null; }
		public function get domain():String { return _currentConfig ? this._currentConfig.domain : null; }
		
		public function set ks( currentConfig : String ):void  {  _currentConfig.ks = currentConfig; }
		public function get ks():String  { return _currentConfig ? this._currentConfig.ks : null; }
		

		public function post(call:KalturaCall):KalturaCall {
			if (_currentConfig) {
				call.config = _currentConfig;
				call.initialize();
				call.execute();
			} else {
				throw new Error("Cannot post a call; no kaltura config has been set.");
			}
			return call;
		}
	}
}