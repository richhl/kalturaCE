using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaPlaylistFilter : KalturaBaseEntryFilter
	{
		#region Properties
		#endregion

		#region CTor
		public KalturaPlaylistFilter()
		{
		}

		public KalturaPlaylistFilter(XmlElement node) : base(node)
		{
		}
		#endregion

		#region Methods
		public new KalturaParams ToParams()
		{
			KalturaParams kparams = base.ToParams();
			return kparams;
		}
		#endregion
	}
}

