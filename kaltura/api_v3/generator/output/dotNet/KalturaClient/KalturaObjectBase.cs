using System;
using System.Text;

namespace Kaltura
{
    public class KalturaObjectBase
    {
        #region Methods
        public KalturaParams ToParams()
        {
            return new KalturaParams();
        }

        protected int ParseInt(string s)
        {
            int i = int.MinValue;
            int.TryParse(s, out i);
            return i;
        }

        protected Single ParseFloat(string s)
        {
            Single i = Single.MinValue;
            Single.TryParse(s, out i);
            return i;
        }

        protected Enum ParseEnum(Type type, string s)
        {
            int i = this.ParseInt(s);
            return (Enum)Enum.Parse(type, i.ToString());
        }

        protected bool ParseBool(string s)
        {
            bool b = false;
            bool.TryParse(s, out b);
            return b;
        }

        #endregion
    }
}
