using System;
using System.Collections.Generic;
using System.Text;
using System.Net;
using System.IO;
using System.Security.Cryptography;
using System.Xml;
using System.Xml.XPath;
using System.Runtime.Serialization;

namespace Kaltura
{
    public class KalturaClientBase
    {
        #region Private Fields

        private KalturaConfiguration _Config;
        private string _KS;
        private bool _ShouldLog;

        #endregion

        #region Properties

        public string KS
        {
            get { return _KS; }
            set { _KS = value; }
        }

        #endregion

        #region CTor

        public KalturaClientBase(KalturaConfiguration config)
        {
            this._Config = config;
            if (this._Config.Logger != null)
            {
                this._ShouldLog = true;
            }
        }

        #endregion

        #region Methods

        public XmlElement CallService(string service, string action, KalturaParams kparams)
        {
            DateTime startTime = DateTime.Now;

            this.Log("service url: [" + this._Config.ServiceUrl + "]");
            this.Log("trying to call service: [" + service + "], action [" + action + "] using session: [" + this._KS + "]");

            // in start session partner id is optional (default -1). if partner id was not set, use the one in the config
            if (!kparams.ContainsKey("partnerId") || kparams["partnerId"] == "-1")
                kparams.AddIntIfNotNull("partnerId", this._Config.PartnerId);

            // append the basic params
            kparams.Add("apiVersion", this._Config.APIVersion);
            kparams.AddIntIfNotNull("format", this._Config.ServiceFormat.GetHashCode());
            kparams.AddStringIfNotNull("ks", this._KS);

            kparams.Add("sig", this.Signature(kparams));

            string url = this._Config.ServiceUrl + "/api_v3/index.php?service=" + service + "&action=" + action;
            this.Log("full reqeust url: [" + url + "]");

            string paramsString = kparams.ToQueryString();

            // build request
            HttpWebRequest request = (HttpWebRequest)HttpWebRequest.Create(url);
            request.Method = "POST";
            request.ContentType = "application/x-www-form-urlencoded";
            request.ContentLength = paramsString.Length;

            StreamWriter requestStream = new StreamWriter(request.GetRequestStream(), Encoding.ASCII);
            requestStream.Write(paramsString);
            requestStream.Close();

            // do request
            WebResponse response = request.GetResponse();
            Encoding enc = System.Text.Encoding.UTF8;
            StreamReader responseStream = new StreamReader(response.GetResponseStream(), enc);
            string responseString = responseStream.ReadToEnd();

            this.Log("result (serialized): " + responseString);

            DateTime endTime = DateTime.Now;

            this.Log("execution time for [" + service + "/" + action + "]: [" + (endTime - startTime).ToString() + "]");

            XmlDocument xml = new XmlDocument();
            xml.LoadXml(responseString);

            this.ValidateXmlResult(xml);
            XmlElement result = xml["xml"]["result"];
            this.ThrowExceptionOnAPIError(result);

            return result;
        }

        #endregion

        #region Private Helpers

        private void Log(string msg)
        {
            if (this._ShouldLog)
            {
                this._Config.Logger.Log(msg);
            }
        }

        private string Signature(KalturaParams kparams)
        {
            string str = "";
            foreach (KeyValuePair<string, string> param in kparams)
            {
                str += (param.Key + param.Value);
            }

            MD5CryptoServiceProvider md5 = new MD5CryptoServiceProvider();
            byte[] data = Encoding.ASCII.GetBytes(str);
            data = md5.ComputeHash(data);
            StringBuilder sBuilder = new StringBuilder();
            for (int i = 0; i < data.Length; i++)
            {
                sBuilder.Append(data[i].ToString("x2"));
            }
            return sBuilder.ToString();
        }

        private void ValidateXmlResult(XmlDocument doc)
        {
            XmlElement xml = doc["xml"];
            if (xml != null)
            {
                XmlElement result = xml["result"];
                if (result != null)
                {
                    return;
                }
            }

            throw new SerializationException("Invalid result");
        }

        private void ThrowExceptionOnAPIError(XmlElement result)
        {
            XmlElement error = result["error"];
            if (error != null)
                throw new KalturaAPIException(error["code"].InnerText, error["message"].InnerText);
        }

        #endregion
    }
}
