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
using System.Collections;
using System.Xml;

namespace Kaltura
{
    public class KalturaDynamicCollection
    {
        #region Private Fields

        protected string _Value;
        protected Hashtable _List; 

        #endregion

        #region Properties

        public KalturaDynamicCollection this[string key]
        {
            get
            {
                if (!this._List.ContainsKey(key))
                {
                    this._List.Add(key, new KalturaDynamicCollection());
                }
                return (KalturaDynamicCollection)this._List[key];
            }
            set
            {
                this._List.Add(key, value);
            }
        }

        public string Value
        {
            get
            {
                if (this._Value == null)
                {
                    return "";
                }
                return this._Value;
            }
            set
            {
                this._Value = value;
            }
        }

        public int Count
        {
            get { return this._List.Count; }
        }

        #endregion

        #region CTor

        public KalturaDynamicCollection()
        {
            this._List = new Hashtable();
        } 

        #endregion

        #region Methods

        #endregion

        #region Static Methods

        public static KalturaDynamicCollection CreateFromNodeList(XmlNodeList nodes)
        {
            KalturaDynamicCollection result = new KalturaDynamicCollection();
            foreach (XmlNode node in nodes)
            {
                if (node.ChildNodes.Count == 1 && node.ChildNodes[0].NodeType == XmlNodeType.Text)
                {
                    result[node.Name].Value = node.InnerText;
                    string s = result[node.Name].Value;
                }
                else
                {
                    result[node.Name] = KalturaDynamicCollection.CreateFromNodeList(node.ChildNodes);
                }
            }
            return result;
        }

        #endregion
    }
}
