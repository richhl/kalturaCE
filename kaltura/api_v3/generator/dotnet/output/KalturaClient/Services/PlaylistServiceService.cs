using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{

    public class KalturaPlaylistService : KalturaServiceBase
	{
    public KalturaPlaylistService(KalturaClient client)
			: base(client)
		{
		}

		public KalturaPlaylist Add(KalturaPlaylist playlist, bool updateStats)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("playlist", playlist.ToParams());
			kparams.Add("updateStats", updateStats.ToString());
			XmlElement result = _Client.CallService("playlist", "add", kparams);
			return (KalturaPlaylist)KalturaObjectFactory.Create(result);
		}

		public KalturaPlaylist Get(string id)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("id", id);
			XmlElement result = _Client.CallService("playlist", "get", kparams);
			return (KalturaPlaylist)KalturaObjectFactory.Create(result);
		}

		public KalturaUiConf Update(string id, KalturaPlaylist playlist, bool updateStats)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("id", id);
			kparams.Add("playlist", playlist.ToParams());
			kparams.Add("updateStats", updateStats.ToString());
			XmlElement result = _Client.CallService("playlist", "update", kparams);
			return (KalturaUiConf)KalturaObjectFactory.Create(result);
		}

		public KalturaPlaylist Delete(string id)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("id", id);
			XmlElement result = _Client.CallService("playlist", "delete", kparams);
			return (KalturaPlaylist)KalturaObjectFactory.Create(result);
		}

		public IList<KalturaMediaEntry> List(KalturaPlaylistFilter filter, KalturaFilterPager pager)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("filter", filter.ToParams());
			kparams.Add("pager", pager.ToParams());
			XmlElement result = _Client.CallService("playlist", "list", kparams);
			IList<KalturaMediaEntry> list = new List<KalturaMediaEntry>();
			foreach(XmlElement node in result.ChildNodes)
			{
				list.Add((KalturaMediaEntry)KalturaObjectFactory.Create(node));
			}
			return list;
		}

		public IList<KalturaMediaEntry> Execute(string id, string detailed)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("id", id);
			kparams.Add("detailed", detailed);
			XmlElement result = _Client.CallService("playlist", "execute", kparams);
			IList<KalturaMediaEntry> list = new List<KalturaMediaEntry>();
			foreach(XmlElement node in result.ChildNodes)
			{
				list.Add((KalturaMediaEntry)KalturaObjectFactory.Create(node));
			}
			return list;
		}

		public IList<KalturaMediaEntry> ExecuteFromContent(int playlistType, string playlistContent, string detailed)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("playlistType", playlistType.GetHashCode().ToString());
			kparams.Add("playlistContent", playlistContent);
			kparams.Add("detailed", detailed);
			XmlElement result = _Client.CallService("playlist", "executeFromContent", kparams);
			IList<KalturaMediaEntry> list = new List<KalturaMediaEntry>();
			foreach(XmlElement node in result.ChildNodes)
			{
				list.Add((KalturaMediaEntry)KalturaObjectFactory.Create(node));
			}
			return list;
		}

		public IList<KalturaMediaEntry> GetStatsFromContent(int playlistType, string playlistContent)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("playlistType", playlistType.GetHashCode().ToString());
			kparams.Add("playlistContent", playlistContent);
			XmlElement result = _Client.CallService("playlist", "getStatsFromContent", kparams);
			IList<KalturaMediaEntry> list = new List<KalturaMediaEntry>();
			foreach(XmlElement node in result.ChildNodes)
			{
				list.Add((KalturaMediaEntry)KalturaObjectFactory.Create(node));
			}
			return list;
		}
	}
}
