using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaUiConfOrderBy : KalturaObjectBase
	{
		#region Properties
		#endregion

		#region CTor
		public KalturaUiConfOrderBy()
		{
		}

		public KalturaUiConfOrderBy(XmlElement node)
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

