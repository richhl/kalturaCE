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
using System.Xml;

namespace Kaltura
{
    public class KalturaResult
    {
        #region Private Fields

        private KalturaDynamicCollection _Container;

        #endregion

        #region Properties

        public int ErrorsCount
        {
            get
            {
                return _Container["error"].Count;
            }
        }

        public KalturaDynamicCollection this[string key]
        {
            get { return _Container[key]; }
            set { _Container[key] = value; }
        }

        #endregion

        #region CTor

        public KalturaResult()
        {
            _Container = new KalturaDynamicCollection();
        }

        public KalturaResult(XmlNodeList nodes)
        {
            _Container = KalturaDynamicCollection.CreateFromNodeList(nodes);
        }

        #endregion

        #region Methods

        public bool WasError()
        {
            return (ErrorsCount == 0) ? false : true;
        }

        public string GetErrorCode(int index)
        {
            return _Container["error"]["num_" + index.ToString()]["code"].Value;
        }

        public string GetErrorDescription(int index)
        {
            return _Container["error"]["num_" + index.ToString()]["desc"].Value;
        }

        #endregion
    }
}
