using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaMixEntryFilter : KalturaPlayableEntryFilter
	{
		#region Properties
		#endregion

		#region CTor
		public KalturaMixEntryFilter()
		{
		}

		public KalturaMixEntryFilter(XmlElement node) : base(node)
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

