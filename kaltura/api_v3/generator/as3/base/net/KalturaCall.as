package com.kaltura.net {
	
	import com.kaltura.config.KalturaConfig;
	import com.kaltura.delegates.IKalturaCallDelegate;
	import com.kaltura.errors.KalturaError;
	import com.kaltura.events.KalturaEvent;
	
	import flash.events.EventDispatcher;
	import flash.net.URLVariables;
	
	public class KalturaCall extends EventDispatcher {
		
		public var args:URLVariables = new URLVariables();
		public var result:Object;
		public var error:KalturaError;
		public var config:KalturaConfig;
		public var success:Boolean = false;
		public var action : String;
		
		public var delegate : IKalturaCallDelegate;
		
		public function KalturaCall() {}
		
		//OVERRIDE this function in case something needs to be initialized prior to execution
		public function initialize():void {}
		
		//OVERRIDE this function to make init the right delegate action
		public function execute():void {}
		
		public function setRequestArgument(name:String, value:Object):void {
			if (value is Number && isNaN(value as Number)) { return; }
			
			if (name && value != null && String(value).length > 0) {
				this.args[name] = value;
			}
		}
		
		protected function clearRequestArguments():void {
			this.args = new URLVariables();
		}
		
		public function handleResult(result:Object):void {
			this.result = result;
			success = true;
			dispatchEvent(new KalturaEvent(KalturaEvent.COMPLETE, false, false, true, result));
		}
		
		public function handleError(error:KalturaError):void {
			this.error = error;
			success = false;
			dispatchEvent(new KalturaEvent(KalturaEvent.FAILED, false, false, false, null, error));
		}
		
		protected function applySchema(p_shema:Array, ...p_args:Array):void {
			var l:uint = p_shema.length;
			
			for (var i:uint=0;i<l;i++) {
				setRequestArgument(p_shema[i], p_args[i]);
			}
		}

	}
}