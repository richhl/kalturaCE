package com.kaltura.commands.stats
{
	import com.kaltura.vo.KalturaCEError;
	import com.kaltura.delegates.stats.StatsReportKceErrorDelegate;
	import com.kaltura.net.KalturaCall;

	public class StatsReportKceError extends KalturaCall
	{
		public var filterFields : String;
		public function StatsReportKceError( kalturaCEError : KalturaCEError )
		{
			service= 'stats';
			action= 'reportKceError';
			applySchema(['kalturaCEError:id','kalturaCEError:partnerId','kalturaCEError:browser','kalturaCEError:serverIp','kalturaCEError:serverOs','kalturaCEError:phpVersion','kalturaCEError:ceAdminEmail','kalturaCEError:type','kalturaCEError:description','kalturaCEError:data'] , kalturaCEError.id,kalturaCEError.partnerId,kalturaCEError.browser,kalturaCEError.serverIp,kalturaCEError.serverOs,kalturaCEError.phpVersion,kalturaCEError.ceAdminEmail,kalturaCEError.type,kalturaCEError.description,kalturaCEError.data);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new StatsReportKceErrorDelegate( this , config );
		}
	}
}
