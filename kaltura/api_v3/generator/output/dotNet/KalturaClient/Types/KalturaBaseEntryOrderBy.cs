using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaBaseEntryOrderBy : KalturaObjectBase
	{
		#region Properties
		#endregion

		#region CTor
		public KalturaBaseEntryOrderBy()
		{
		}

		public KalturaBaseEntryOrderBy(XmlElement node)
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

