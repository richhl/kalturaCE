package com.kaltura.commands
{
	import com.kaltura.delegates.MultiRequestDelegate;
	import com.kaltura.net.KalturaCall;

	public class MultiRequest extends KalturaCall
	{
		private var _addedParams:Object = new Object();
		private var _mapParamArr : Array = new Array();
		public var actions : Array = new Array();
		 
		public function MultiRequest()
		{
			service = 'multirequest';
		}
		
		public function addAction( kalturaCall : KalturaCall ) :void
		{
			actions.push( kalturaCall );
		}
		
		public function mapMultiRequestParam( fromRequestIndex : int , 
											  fromRequestParam : String ,  
											  toRequestIndex : int , 
											  toRequestParam : String ) : void
		{
			var obj : Object = {fromRequestIndex:fromRequestIndex,fromRequestParam:fromRequestParam,toRequestIndex:toRequestIndex,toRequestParam:toRequestParam};
			_mapParamArr.push( obj );
		}
		
		public function addRequestParam( key : String, value:String) : void
		{
			_addedParams[key] = value;
		}
		
		override public function execute() : void
		{
			var keyArray : Array = new Array();
			var valueArr : Array = new Array();
			
			for( var j:int=0; j<actions.length; j++)
			{
				keyArray.push((j+1)+":service");
				valueArr.push( actions[j].service );
				keyArray.push((j+1)+":action");
				valueArr.push( actions[j].action );

				var argsArr : Array = ((actions[j] as KalturaCall).args.toString()).split('&');
				for(var k:int=0; k< argsArr.length; k++)
				{
					var inMap : Boolean = false;
					var key : String = decodeURIComponent(argsArr[k].split('=')[0]);
					
					//search the key in request map
					for( var m:int=0; m<_mapParamArr.length; m++ )
					{
						if( _mapParamArr[m].toRequestParam == key && _mapParamArr[m].toRequestIndex == (j+1) )
						{
							inMap = true;
							keyArray.push((j+1)+":"+key);
							valueArr.push( "{" + _mapParamArr[m].fromRequestIndex + ":result:" + _mapParamArr[m].fromRequestParam+ "}" );
						}	
					}
					
					if( !inMap && argsArr[k] ) //if not in the multi request map
					{
						keyArray.push((j+1)+":"+key);
						valueArr.push(  decodeURIComponent(argsArr[k].split('=')[1]) );
					}
				}
			}
			
			for (var i:uint=0;i<keyArray.length;i++) 
				setRequestArgument(keyArray[i], valueArr[i]);

			for(var oKey:String in _addedParams)
				setRequestArgument(oKey, _addedParams[oKey]);
			
			delegate = new MultiRequestDelegate( this , config );
		}
	}
}