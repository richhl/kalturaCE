using System;
using System.Xml;
using System.Collections.Generic;
using System.IO;

namespace Kaltura
{

    public class KalturaPlaylistService : KalturaServiceBase
	{
    public KalturaPlaylistService(KalturaClient client)
			: base(client)
		{
		}

		public KalturaPlaylist Add(KalturaPlaylist playlist)
		{
			return this.Add(playlist, false);
		}

		public KalturaPlaylist Add(KalturaPlaylist playlist, bool updateStats)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("playlist", playlist.ToParams());
			kparams.AddBoolIfNotNull("updateStats", updateStats);
			_Client.QueueServiceCall("playlist", "add", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaPlaylist)KalturaObjectFactory.Create(result);
		}

		public KalturaPlaylist Get(string id)
		{
			return this.Get(id, -1);
		}

		public KalturaPlaylist Get(string id, int version)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("id", id);
			kparams.AddIntIfNotNull("version", version);
			_Client.QueueServiceCall("playlist", "get", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaPlaylist)KalturaObjectFactory.Create(result);
		}

		public KalturaPlaylist Update(string id, KalturaPlaylist playlist)
		{
			return this.Update(id, playlist, false);
		}

		public KalturaPlaylist Update(string id, KalturaPlaylist playlist, bool updateStats)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("id", id);
			kparams.Add("playlist", playlist.ToParams());
			kparams.AddBoolIfNotNull("updateStats", updateStats);
			_Client.QueueServiceCall("playlist", "update", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaPlaylist)KalturaObjectFactory.Create(result);
		}

		public void Delete(string id)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("id", id);
			_Client.QueueServiceCall("playlist", "delete", kparams);
			if (this._Client.IsMultiRequest)
				return;
			XmlElement result = _Client.DoQueue();
		}

		public KalturaPlaylistListResponse List()
		{
			return this.List(null);
		}

		public KalturaPlaylistListResponse List(KalturaPlaylistFilter filter)
		{
			return this.List(null, null);
		}

		public KalturaPlaylistListResponse List(KalturaPlaylistFilter filter, KalturaFilterPager pager)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("filter", filter.ToParams());
			kparams.Add("pager", pager.ToParams());
			_Client.QueueServiceCall("playlist", "list", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaPlaylistListResponse)KalturaObjectFactory.Create(result);
		}

		public IList<KalturaMediaEntry> Execute(string id)
		{
			return this.Execute(id, "");
		}

		public IList<KalturaMediaEntry> Execute(string id, string detailed)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("id", id);
			kparams.AddStringIfNotNull("detailed", detailed);
			_Client.QueueServiceCall("playlist", "execute", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			IList<KalturaMediaEntry> list = new List<KalturaMediaEntry>();
			foreach(XmlElement node in result.ChildNodes)
			{
				list.Add((KalturaMediaEntry)KalturaObjectFactory.Create(node));
			}
			return list;
		}

		public IList<KalturaMediaEntry> ExecuteFromContent(KalturaPlaylistType playlistType, string playlistContent)
		{
			return this.ExecuteFromContent(playlistType, playlistContent, "");
		}

		public IList<KalturaMediaEntry> ExecuteFromContent(KalturaPlaylistType playlistType, string playlistContent, string detailed)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddEnumIfNotNull("playlistType", playlistType);
			kparams.AddStringIfNotNull("playlistContent", playlistContent);
			kparams.AddStringIfNotNull("detailed", detailed);
			_Client.QueueServiceCall("playlist", "executeFromContent", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			IList<KalturaMediaEntry> list = new List<KalturaMediaEntry>();
			foreach(XmlElement node in result.ChildNodes)
			{
				list.Add((KalturaMediaEntry)KalturaObjectFactory.Create(node));
			}
			return list;
		}

		public KalturaPlaylist GetStatsFromContent(KalturaPlaylistType playlistType, string playlistContent)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddEnumIfNotNull("playlistType", playlistType);
			kparams.AddStringIfNotNull("playlistContent", playlistContent);
			_Client.QueueServiceCall("playlist", "getStatsFromContent", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaPlaylist)KalturaObjectFactory.Create(result);
		}
	}
}
