using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaCommercialUseType : KalturaObjectBase
	{
		#region Properties
		#endregion

		#region CTor
		public KalturaCommercialUseType()
		{
		}

		public KalturaCommercialUseType(XmlElement node)
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

