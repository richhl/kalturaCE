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

namespace Kaltura
{
    public class KalturaConfiguration
    {
        #region Private Fields

        private string _ServiceUrl = "http://www.kaltura.com";
        private EKalturaServiceFormat _ServiceFormat = EKalturaServiceFormat.RESPONSE_TYPE_XML;
        private int _PartnerId;
        private int _SubPartnerId;
        private IKalturaLogger _Logger;
        private string _APIVersion = "0.7";

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

        public int SubPartnerId
        {
            set { _SubPartnerId = value; }
            get { return _SubPartnerId; }
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
        /// Constructs new kaltura configuration object, expecting partner id & sub partner id
        /// </summary>
        /// <param name="partnerId"></param>
        /// <param name="subPartnerId"></param>
        public KalturaConfiguration(int partnerId, int subPartnerId)
        {
            this._PartnerId = partnerId;
            this._SubPartnerId = subPartnerId;
        } 

        #endregion
    }
}
