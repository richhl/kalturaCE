using System;
using System.Collections.Generic;
using System.Text;

namespace Kaltura
{
    class KalturaClientTester
    {
        static void Main(string[] args)
        {
            KalturaConfiguration config = new KalturaConfiguration(3);
            config.ServiceUrl = "http://localhost/";
            KalturaClient client = new KalturaClient(config);
            string ks = client.SessionService.Start("4d1cb874ef9b7469f5bb1ca1ef5fb49c", "", KalturaSessionType.ADMIN.GetHashCode(), 3, 86400, "");


            client.KS = ks;

            KalturaMediaListResponse result = client.MediaService.List(new KalturaMediaEntryFilter(), new KalturaFilterPager());

            Console.ReadKey();
        }
    }
}
