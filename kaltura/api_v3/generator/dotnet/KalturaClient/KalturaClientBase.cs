/*
This file is part of the Kaltura Collaborative Media Suite which allows users
to do with audio, video, and animation what Wiki platfroms allow them to do with
text.

Copyright (C) 2006-2008 Kaltura Inc.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as
published by the Free Software Foundation, either version 3 of the
License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

using System;
using System.Collections.Generic;
using System.Text;
using System.Net;
using System.IO;
using System.Security.Cryptography;
using System.Xml;
using System.Xml.XPath;

namespace Kaltura
{
    public class KalturaClientBase
    {
        #region Private Fields

        private KalturaConfiguration _Config;
        private string _KS;
        private bool _ShouldLog;
        private KalturaParams _Params;

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
            this._Params = new KalturaParams();
            this._Config = config;
            if (this._Config.Logger != null)
            {
                this._ShouldLog = true;
            }
        }

        #endregion

        #region Methods

        public KalturaResult Hit(string method, KalturaSessionUser sessionUser)
        {
            DateTime startTime = DateTime.Now;

            this.Log("service url: [" + this._Config.ServiceUrl + "]");
            this.Log("trying to call method: [" + method + "] for user id: [" + sessionUser.UserId + "] using session: [" + this._KS + "]");

            // append the basic params
            this.AddParam("kaltura_api_version", this._Config.APIVersion);
            this.AddParam("partner_id", this._Config.PartnerId);
            this.AddParam("subp_id", this._Config.SubPartnerId);
            this.AddParam("format", this._Config.ServiceFormat.GetHashCode());
            this.AddParam("uid", sessionUser.UserId);
            this.AddOptionalParam("user_name", sessionUser.ScreenName);
            this.AddOptionalParam("ks", this._KS);

            this.AddParam("signiture" , this.Signiture(this._Params));

            string url = this._Config.ServiceUrl + "/api/" + method;
            this.Log("full reqeust url: [" + url + "]");

            string paramsString = this._Params.ToQueryString();


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

            this.Log("execution time for method [" + method + "]: [" + (endTime - startTime).ToString() + "]");

            this._Params = new KalturaParams();
            return this.ParseResult(responseString);
        }

        public void AddParam(string key, object value)
        {
            this._Params[key] = value.ToString();
        }

        public void AddOptionalParam(string key, object value)
        {
            if (value != null && value.ToString() != "")
            {
                // if its a boolean type and is false we dont add it
                if (value.GetType() == false.GetType() && (bool)value == false)
                    return;

                this.AddParam(key, value);
            }
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

        private string Signiture(KalturaParams paramsArray)
        {
            string str = "";
            foreach (KeyValuePair<string, string> param in paramsArray)
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

        private KalturaResult ParseResult(string result)
        {
            XmlDocument xml = new XmlDocument();
            xml.LoadXml(result);
            XmlNodeList nodes = xml.SelectNodes("/xml");
            if (nodes.Count == 1)
                return new KalturaResult(nodes[0].ChildNodes);
            else
                return new KalturaResult();
        }

        #endregion
    }
}
