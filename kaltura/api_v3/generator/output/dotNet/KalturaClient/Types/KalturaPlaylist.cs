using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaPlaylist : KalturaBaseEntry
	{
		#region Properties
		public string PlaylistContent = null;
		public KalturaPlaylistType PlaylistType = (KalturaPlaylistType)Int32.MinValue;
		public int Plays = Int32.MinValue;
		public int Views = Int32.MinValue;
		public int Duration = Int32.MinValue;
		#endregion

		#region CTor
		public KalturaPlaylist()
		{
		}

		public KalturaPlaylist(XmlElement node) : base(node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "playlistContent":
						this.PlaylistContent = txt;
						continue;
					case "playlistType":
						this.PlaylistType = (KalturaPlaylistType)ParseEnum(typeof(KalturaPlaylistType), txt);
						continue;
					case "plays":
						this.Plays = ParseInt(txt);
						continue;
					case "views":
						this.Views = ParseInt(txt);
						continue;
					case "duration":
						this.Duration = ParseInt(txt);
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public new KalturaParams ToParams()
		{
			KalturaParams kparams = base.ToParams();
			kparams.AddStringIfNotNull("playlistContent", this.PlaylistContent);
			kparams.AddEnumIfNotNull("playlistType", this.PlaylistType);
			kparams.AddIntIfNotNull("plays", this.Plays);
			kparams.AddIntIfNotNull("views", this.Views);
			kparams.AddIntIfNotNull("duration", this.Duration);
			return kparams;
		}
		#endregion
	}
}

