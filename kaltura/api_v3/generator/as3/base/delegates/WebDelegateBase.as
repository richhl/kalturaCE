package com.kaltura.delegates {
	
	import com.kaltura.config.IKalturaConfig;
	import com.kaltura.config.KalturaConfig;
	import com.kaltura.errors.KalturaError;
	import com.kaltura.events.KalturaEvent;
	import com.kaltura.net.KalturaCall;
	
	import flash.events.ErrorEvent;
	import flash.events.Event;
	import flash.events.EventDispatcher;
	import flash.events.HTTPStatusEvent;
	import flash.events.IOErrorEvent;
	import flash.events.SecurityErrorEvent;
	import flash.events.TimerEvent;
	import flash.net.FileReference;
	import flash.net.URLLoader;
	import flash.net.URLLoaderDataFormat;
	import flash.net.URLRequest;
	import flash.net.URLRequestMethod;
	import flash.utils.Timer;
	
	public class WebDelegateBase extends EventDispatcher implements IKalturaCallDelegate {
		
		private static const CONNECT_TIME : int = 8000; //8 secs
		private static const LOAD_TIME : int = 30000; //30 secs
		protected var connectTimer:Timer;
		protected var loadTimer:Timer;
		
		protected var _call:KalturaCall;
		protected var _config:KalturaConfig;
		
		protected var loader:URLLoader;
		protected var fileRef:FileReference;
		
		//Setters & getters 
		public function get call():KalturaCall { return _call; }
		public function set call(newVal:KalturaCall):void { _call = newVal; }

		public function get config():IKalturaConfig { return _config; }
		public function set config(newVal:IKalturaConfig):void { _config = newVal as KalturaConfig; }
		
		public function WebDelegateBase(call:KalturaCall, config:KalturaConfig) 
		{
			this.call = call;
			this.config = config;

			connectTimer = new Timer(CONNECT_TIME, 1);
			connectTimer.addEventListener(TimerEvent.TIMER_COMPLETE, onConnectTimeout);
			
			loadTimer = new Timer(LOAD_TIME, 1);
			loadTimer.addEventListener(TimerEvent.TIMER_COMPLETE, onLoadTimeOut);
			
			execute();
		}
		
		public function close():void {
			try {
				loader.close();
			} catch (e:*) { }
			
			connectTimer.stop();
			loadTimer.stop();
		}
		
		protected function onConnectTimeout(event:TimerEvent):void {
			var kError:KalturaError = new KalturaError();
			//kError.errorCode =
			kError.errorMsg = "Connection Timeout: " + CONNECT_TIME/1000 + " sec with no post command from kaltura client.";
			_call.handleError(kError);
			dispatchEvent(new KalturaEvent(KalturaEvent.FAILED, false, false, false, null, kError));
			
			loadTimer.stop();
			close();
		}
		
		protected function onLoadTimeOut(event:TimerEvent):void {
			connectTimer.stop();
			
			close();
			
			var kError:KalturaError = new KalturaError();
			kError.errorMsg = "Post Timeout: "+ LOAD_TIME/1000 + " sec with no post result.";
			_call.handleError(kError);
			dispatchEvent(new KalturaEvent(KalturaEvent.FAILED, false, false, false, null, kError));
		}

		protected function execute():void {
			if (call == null) { throw new Error('No call defined.'); }
			post(); //post the call
		}

		/**
		 * Helper function for sending the call straight to the server
		 */
		protected function post():void {
			
			addOptionalArguments();
			
			formatRequest();
			
			sendRequest();
			
			connectTimer.start();
		}
		
		protected function formatRequest():void 
		{
			//The configuration is stronger then the args
			if(_config.partnerId != null && _call.args["partnerId"] == -1)
				_call.setRequestArgument("partnerId", _config.partnerId); 
				
			if (_config.ks != null)
				_call.setRequestArgument("ks", _config.ks);

			//Create signature hash.
			//call.setRequestArgument("kalsig", getMD5Checksum(call));
		}
		
		protected function sendRequest():void {
			//construct the loader
			createURLLoader();
			
			//create the service request for normal calls
			var req:URLRequest = new URLRequest(_config.domain +"/"+_config.srvUrl+"?"+call.action);
			req.contentType = "application/x-www-form-urlencoded";
			req.method = URLRequestMethod.POST;
			req.data = call.args; 

			loader.dataFormat = URLLoaderDataFormat.TEXT;
			loader.load(req);
		}
		
		protected function createURLLoader():void {
			loader = new URLLoader();
			loader.addEventListener(Event.COMPLETE, onDataComplete);
			loader.addEventListener(HTTPStatusEvent.HTTP_STATUS, onHTTPStatus);
			loader.addEventListener(IOErrorEvent.IO_ERROR, onError);
			loader.addEventListener(SecurityErrorEvent.SECURITY_ERROR, onError);
			loader.addEventListener(Event.OPEN, onOpen);
		}
		
		protected function onHTTPStatus(event:HTTPStatusEvent):void { }
		
		protected function onOpen(event:Event):void {
			connectTimer.stop();
			loadTimer.start();
		}
		
		protected function addOptionalArguments():void {
			//add optional args here
		}
		
		// Event Handlers
		protected function onDataComplete(event:Event):void {
				
			handleResult( XML(event.target.data) );
		}
		
		protected function onError( event:ErrorEvent ):void {
			clean();
			var kError:KalturaError = createKalturaError( event, loader.data);
			
			if(!kError)
			{
				kError.errorMsg = event.text;
				//kError.errorCode;
			}
				
			call.handleError(kError);
			
			dispatchEvent(new KalturaEvent(KalturaEvent.FAILED, false, false, false, null, kError));
		}
		
		protected function handleResult(result:XML):void {
			clean();
			
			var error:KalturaError = validateKalturaResponse(result);
			
			if (error == null) {
				var digestedResult : Object = parse(result);
				call.handleResult( digestedResult );
			} else {
				call.handleError(error);
			}
		}
		
		protected function clean():void {
			connectTimer.stop();
			loadTimer.stop();
			
			if (loader == null) { return; }
			
			loader.removeEventListener(Event.COMPLETE, onDataComplete);
			loader.removeEventListener(IOErrorEvent.IO_ERROR, onError);
			loader.removeEventListener(SecurityErrorEvent.SECURITY_ERROR, onError);
			loader.removeEventListener(Event.OPEN, onOpen);
		}
		
		//override this parssing function in the spasific delegate 
		protected function parse( result : XML ) : * { }
		
		//Overide this to create validation object and fill it
		protected function validateKalturaResponse(result:String) : KalturaError { return null; }
		
		//Overide this to create error object and fill it
		protected function createKalturaError( event : ErrorEvent , loaderData : * ) : KalturaError { return null; }
	}
}