using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaPlayableEntry : KalturaBaseEntry
	{
		#region Properties
		public int Plays = Int32.MinValue;
		public int Views = Int32.MinValue;
		public int Width = Int32.MinValue;
		public int Height = Int32.MinValue;
		public string ThumbnailUrl = null;
		public int Duration = Int32.MinValue;
		#endregion

		#region CTor
		public KalturaPlayableEntry()
		{
		}

		public KalturaPlayableEntry(XmlElement node) : base(node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "plays":
						this.Plays = ParseInt(txt);
						continue;
					case "views":
						this.Views = ParseInt(txt);
						continue;
					case "width":
						this.Width = ParseInt(txt);
						continue;
					case "height":
						this.Height = ParseInt(txt);
						continue;
					case "thumbnailUrl":
						this.ThumbnailUrl = txt;
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
			kparams.AddIntIfNotNull("plays", this.Plays);
			kparams.AddIntIfNotNull("views", this.Views);
			kparams.AddIntIfNotNull("width", this.Width);
			kparams.AddIntIfNotNull("height", this.Height);
			kparams.AddStringIfNotNull("thumbnailUrl", this.ThumbnailUrl);
			kparams.AddIntIfNotNull("duration", this.Duration);
			return kparams;
		}
		#endregion
	}
}

