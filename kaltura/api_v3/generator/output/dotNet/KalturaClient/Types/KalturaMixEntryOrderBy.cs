using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaMixEntryOrderBy : KalturaPlayableEntryOrderBy
	{
		#region Properties
		#endregion

		#region CTor
		public KalturaMixEntryOrderBy()
		{
		}

		public KalturaMixEntryOrderBy(XmlElement node) : base(node)
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

