using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaMediaEntryOrderBy : KalturaPlayableEntryOrderBy
	{
		#region Properties
		#endregion

		#region CTor
		public KalturaMediaEntryOrderBy()
		{
		}

		public KalturaMediaEntryOrderBy(XmlElement node) : base(node)
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

