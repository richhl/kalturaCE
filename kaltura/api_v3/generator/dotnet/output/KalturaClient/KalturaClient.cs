using System;

namespace Kaltura
{
    public class KalturaClient : KalturaClientBase
    {
        public KalturaClient(KalturaConfiguration config)
            : base(config)
        {
        }

		KalturaMediaService _MediaService;
		public KalturaMediaService MediaService
		{
			get
			{
				if (_MediaService == null)
					_MediaService = new KalturaMediaService(this);

				return _MediaService;
			}
		}

		KalturaMixingService _MixingService;
		public KalturaMixingService MixingService
		{
			get
			{
				if (_MixingService == null)
					_MixingService = new KalturaMixingService(this);

				return _MixingService;
			}
		}

		KalturaBaseEntryService _BaseEntryService;
		public KalturaBaseEntryService BaseEntryService
		{
			get
			{
				if (_BaseEntryService == null)
					_BaseEntryService = new KalturaBaseEntryService(this);

				return _BaseEntryService;
			}
		}

		KalturaSessionService _SessionService;
		public KalturaSessionService SessionService
		{
			get
			{
				if (_SessionService == null)
					_SessionService = new KalturaSessionService(this);

				return _SessionService;
			}
		}

		KalturaUiConfService _UiConfService;
		public KalturaUiConfService UiConfService
		{
			get
			{
				if (_UiConfService == null)
					_UiConfService = new KalturaUiConfService(this);

				return _UiConfService;
			}
		}

		KalturaPlaylistService _PlaylistService;
		public KalturaPlaylistService PlaylistService
		{
			get
			{
				if (_PlaylistService == null)
					_PlaylistService = new KalturaPlaylistService(this);

				return _PlaylistService;
			}
		}

		KalturaUserService _UserService;
		public KalturaUserService UserService
		{
			get
			{
				if (_UserService == null)
					_UserService = new KalturaUserService(this);

				return _UserService;
			}
		}

		KalturaWidgetService _WidgetService;
		public KalturaWidgetService WidgetService
		{
			get
			{
				if (_WidgetService == null)
					_WidgetService = new KalturaWidgetService(this);

				return _WidgetService;
			}
		}

		KalturaSearchService _SearchService;
		public KalturaSearchService SearchService
		{
			get
			{
				if (_SearchService == null)
					_SearchService = new KalturaSearchService(this);

				return _SearchService;
			}
		}

		KalturaPartnerService _PartnerService;
		public KalturaPartnerService PartnerService
		{
			get
			{
				if (_PartnerService == null)
					_PartnerService = new KalturaPartnerService(this);

				return _PartnerService;
			}
		}

		KalturaAdminuserService _AdminuserService;
		public KalturaAdminuserService AdminuserService
		{
			get
			{
				if (_AdminuserService == null)
					_AdminuserService = new KalturaAdminuserService(this);

				return _AdminuserService;
			}
		}

		KalturaSystemService _SystemService;
		public KalturaSystemService SystemService
		{
			get
			{
				if (_SystemService == null)
					_SystemService = new KalturaSystemService(this);

				return _SystemService;
			}
		}

		KalturaNotificationService _NotificationService;
		public KalturaNotificationService NotificationService
		{
			get
			{
				if (_NotificationService == null)
					_NotificationService = new KalturaNotificationService(this);

				return _NotificationService;
			}
		}
	}
}
