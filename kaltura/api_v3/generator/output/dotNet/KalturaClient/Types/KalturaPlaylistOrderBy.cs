using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaPlaylistOrderBy : KalturaBaseEntryOrderBy
	{
		#region Properties
		#endregion

		#region CTor
		public KalturaPlaylistOrderBy()
		{
		}

		public KalturaPlaylistOrderBy(XmlElement node) : base(node)
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

