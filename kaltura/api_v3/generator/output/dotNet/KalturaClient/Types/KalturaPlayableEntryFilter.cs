using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaPlayableEntryFilter : KalturaBaseEntryFilter
	{
		#region Properties
		#endregion

		#region CTor
		public KalturaPlayableEntryFilter()
		{
		}

		public KalturaPlayableEntryFilter(XmlElement node) : base(node)
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

