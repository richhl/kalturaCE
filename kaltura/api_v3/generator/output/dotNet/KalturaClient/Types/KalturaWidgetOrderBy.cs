using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaWidgetOrderBy : KalturaObjectBase
	{
		#region Properties
		#endregion

		#region CTor
		public KalturaWidgetOrderBy()
		{
		}

		public KalturaWidgetOrderBy(XmlElement node)
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

