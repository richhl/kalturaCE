using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaPlayableEntryOrderBy : KalturaBaseEntryOrderBy
	{
		#region Properties
		#endregion

		#region CTor
		public KalturaPlayableEntryOrderBy()
		{
		}

		public KalturaPlayableEntryOrderBy(XmlElement node) : base(node)
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

