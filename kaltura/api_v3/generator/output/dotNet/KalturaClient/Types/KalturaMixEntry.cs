using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaMixEntry : KalturaPlayableEntry
	{
		#region Properties
		public bool? HasRealThumbnail = false;
		public KalturaEditorType EditorType = (KalturaEditorType)Int32.MinValue;
		public string DataContent = null;
		#endregion

		#region CTor
		public KalturaMixEntry()
		{
		}

		public KalturaMixEntry(XmlElement node) : base(node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "hasRealThumbnail":
						this.HasRealThumbnail = ParseBool(txt);
						continue;
					case "editorType":
						this.EditorType = (KalturaEditorType)ParseEnum(typeof(KalturaEditorType), txt);
						continue;
					case "dataContent":
						this.DataContent = txt;
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public new KalturaParams ToParams()
		{
			KalturaParams kparams = base.ToParams();
			kparams.AddBoolIfNotNull("hasRealThumbnail", this.HasRealThumbnail);
			kparams.AddEnumIfNotNull("editorType", this.EditorType);
			kparams.AddStringIfNotNull("dataContent", this.DataContent);
			return kparams;
		}
		#endregion
	}
}

