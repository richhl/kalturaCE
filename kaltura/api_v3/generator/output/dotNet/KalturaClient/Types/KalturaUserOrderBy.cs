using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaUserOrderBy : KalturaObjectBase
	{
		#region Properties
		#endregion

		#region CTor
		public KalturaUserOrderBy()
		{
		}

		public KalturaUserOrderBy(XmlElement node)
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

