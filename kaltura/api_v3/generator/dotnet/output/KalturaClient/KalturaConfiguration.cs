using System;
using System.Text;

namespace Kaltura
{
    public class KalturaConfiguration
    {
        #region Private Fields

        private string _ServiceUrl = "http://www.kaltura.com/";
        private EKalturaServiceFormat _ServiceFormat = EKalturaServiceFormat.RESPONSE_TYPE_XML;
        private int _PartnerId;
        private IKalturaLogger _Logger;
        private string _APIVersion = "3.0";

        #endregion

        #region Properties

        public string ServiceUrl
        {
            set { _ServiceUrl = value; }
            get { return _ServiceUrl; }
        }

        public EKalturaServiceFormat ServiceFormat
        {
            get { return _ServiceFormat; }
        }

        public int PartnerId
        {
            set { _PartnerId = value; }
            get { return _PartnerId; }
        }

        public IKalturaLogger Logger
        {
            set { _Logger = value;  }
            get { return _Logger; }
        }

        public string APIVersion
        {
            set { _APIVersion = value; }
            get { return _APIVersion; }
        }

        #endregion

        #region CTor

        /// <summary>
        /// Constructs new kaltura configuration object, expecting partner id
        /// </summary>
        /// <param name="partnerId"></param>
        public KalturaConfiguration(int partnerId)
        {
            this._PartnerId = partnerId;
        } 

        #endregion
    }
}
