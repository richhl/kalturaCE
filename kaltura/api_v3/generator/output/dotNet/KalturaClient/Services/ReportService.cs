using System;
using System.Xml;
using System.Collections.Generic;
using System.IO;

namespace Kaltura
{

    public class KalturaReportService : KalturaServiceBase
	{
    public KalturaReportService(KalturaClient client)
			: base(client)
		{
		}

		public KalturaReportGraph GetGraph()
		{
			KalturaParams kparams = new KalturaParams();
			_Client.QueueServiceCall("report", "getGraph", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaReportGraph)KalturaObjectFactory.Create(result);
		}

		public IList<KalturaReportGraph> GetGraphs(KalturaReportType reportType, KalturaReportInputFilter reportInputFilter)
		{
			return this.GetGraphs(reportType, reportInputFilter, "");
		}

		public IList<KalturaReportGraph> GetGraphs(KalturaReportType reportType, KalturaReportInputFilter reportInputFilter, string dimension)
		{
			return this.GetGraphs(reportType, reportInputFilter, "", "");
		}

		public IList<KalturaReportGraph> GetGraphs(KalturaReportType reportType, KalturaReportInputFilter reportInputFilter, string dimension, string objectIds)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddEnumIfNotNull("reportType", reportType);
			kparams.Add("reportInputFilter", reportInputFilter.ToParams());
			kparams.AddStringIfNotNull("dimension", dimension);
			kparams.AddStringIfNotNull("objectIds", objectIds);
			_Client.QueueServiceCall("report", "getGraphs", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			IList<KalturaReportGraph> list = new List<KalturaReportGraph>();
			foreach(XmlElement node in result.ChildNodes)
			{
				list.Add((KalturaReportGraph)KalturaObjectFactory.Create(node));
			}
			return list;
		}

		public KalturaReportTotal GetTotal(KalturaReportType reportType, KalturaReportInputFilter reportInputFilter)
		{
			return this.GetTotal(reportType, reportInputFilter, "");
		}

		public KalturaReportTotal GetTotal(KalturaReportType reportType, KalturaReportInputFilter reportInputFilter, string objectIds)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddEnumIfNotNull("reportType", reportType);
			kparams.Add("reportInputFilter", reportInputFilter.ToParams());
			kparams.AddStringIfNotNull("objectIds", objectIds);
			_Client.QueueServiceCall("report", "getTotal", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaReportTotal)KalturaObjectFactory.Create(result);
		}

		public KalturaReportTable GetTable(KalturaReportType reportType, KalturaReportInputFilter reportInputFilter, KalturaFilterPager pager)
		{
			return this.GetTable(reportType, reportInputFilter, pager, "");
		}

		public KalturaReportTable GetTable(KalturaReportType reportType, KalturaReportInputFilter reportInputFilter, KalturaFilterPager pager, string order)
		{
			return this.GetTable(reportType, reportInputFilter, pager, "", "");
		}

		public KalturaReportTable GetTable(KalturaReportType reportType, KalturaReportInputFilter reportInputFilter, KalturaFilterPager pager, string order, string objectIds)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddEnumIfNotNull("reportType", reportType);
			kparams.Add("reportInputFilter", reportInputFilter.ToParams());
			kparams.Add("pager", pager.ToParams());
			kparams.AddStringIfNotNull("order", order);
			kparams.AddStringIfNotNull("objectIds", objectIds);
			_Client.QueueServiceCall("report", "getTable", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaReportTable)KalturaObjectFactory.Create(result);
		}

		public string GetUrlForReportAsCsv(string reportTitle, string reportText, string headers, KalturaReportType reportType, KalturaReportInputFilter reportInputFilter)
		{
			return this.GetUrlForReportAsCsv(reportTitle, reportText, headers, reportType, reportInputFilter, "");
		}

		public string GetUrlForReportAsCsv(string reportTitle, string reportText, string headers, KalturaReportType reportType, KalturaReportInputFilter reportInputFilter, string dimension)
		{
			return this.GetUrlForReportAsCsv(reportTitle, reportText, headers, reportType, reportInputFilter, "", null);
		}

		public string GetUrlForReportAsCsv(string reportTitle, string reportText, string headers, KalturaReportType reportType, KalturaReportInputFilter reportInputFilter, string dimension, KalturaFilterPager pager)
		{
			return this.GetUrlForReportAsCsv(reportTitle, reportText, headers, reportType, reportInputFilter, "", null, "");
		}

		public string GetUrlForReportAsCsv(string reportTitle, string reportText, string headers, KalturaReportType reportType, KalturaReportInputFilter reportInputFilter, string dimension, KalturaFilterPager pager, string order)
		{
			return this.GetUrlForReportAsCsv(reportTitle, reportText, headers, reportType, reportInputFilter, "", null, "", "");
		}

		public string GetUrlForReportAsCsv(string reportTitle, string reportText, string headers, KalturaReportType reportType, KalturaReportInputFilter reportInputFilter, string dimension, KalturaFilterPager pager, string order, string objectIds)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("reportTitle", reportTitle);
			kparams.AddStringIfNotNull("reportText", reportText);
			kparams.AddStringIfNotNull("headers", headers);
			kparams.AddEnumIfNotNull("reportType", reportType);
			kparams.Add("reportInputFilter", reportInputFilter.ToParams());
			kparams.AddStringIfNotNull("dimension", dimension);
			kparams.Add("pager", pager.ToParams());
			kparams.AddStringIfNotNull("order", order);
			kparams.AddStringIfNotNull("objectIds", objectIds);
			_Client.QueueServiceCall("report", "getUrlForReportAsCsv", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return result.InnerText;
		}
	}
}
