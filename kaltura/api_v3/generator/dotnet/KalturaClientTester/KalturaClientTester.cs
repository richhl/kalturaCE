using System;
using System.Collections.Generic;
using System.Text;

namespace Kaltura
{
    class KalturaClientTester
    {
        static void Main(string[] args)
        {
            int partnerId = 13;
            int subPartnerId = 13000;
            string secret = "e88f03256750b96f3e4eb2d19fa9f8a7";
            KalturaConfiguration config = new KalturaConfiguration(partnerId, subPartnerId);
            //config.ServiceUrl = "http://sandbox.kaltura.com"; // uncomment to work on sandbox (default is http://www.kaltura.com)

            // KalturaSessionUser represent partners user who is 
            KalturaSessionUser user = new KalturaSessionUser();
            user.UserId = "DOT_NET_CLIENT";
            user.ScreenName = ".NET Client";

            // create new client
            KalturaClient client = new KalturaClient(config);

            // start new session 
            KalturaResult result = client.StartSession(user, secret);

            // check for errors
            if (result.WasError())
            {
                Console.WriteLine(result.GetErrorCode(0) + " [" + result.GetErrorDescription(0) + "]");
                Console.ReadKey();
                return;
            }

            // we've got kaltura session, lets set it to the client for next requests
            client.KS = result["result"]["ks"].Value;
            Console.WriteLine("Session created successfully [" + client.KS + "]");


            //
            // kshow add/get example
            //
            Console.WriteLine("Trying to create new kshow");

            // contruct new kaltura kshow object
            KalturaKShow kshow = new KalturaKShow();
            kshow.Name = "Testing .NET Client";

            // add the kshow
            KalturaResult kshowResult = client.AddKShow(user, kshow);

            // check for errors
            if (kshowResult.WasError())
            {
                Console.WriteLine("Failed to create new kshow [" + kshowResult.GetErrorDescription(0) + "]");
                Console.ReadKey();
                return;
            }

            // find the new kshow id
            string kshowId = kshowResult["result"]["kshow"]["id"].Value;
            Console.WriteLine("KShow created successfully with id (" + kshowId + ")");

            Console.WriteLine("Getting the new kshow");

            // get the kshow
            kshowResult = client.GetKShow(user, kshowId);
            Console.WriteLine("Got kshow with name [" + kshowResult["result"]["kshow"]["name"].Value + "]");


            
            //
            // add entry example
            //
            
            // create new entry with some random url from youtube, video will be downloaded and converted
            KalturaEntry entry = new KalturaEntry();
            entry.Name = "Smart Car";
            entry.Url = "http://akvideos.metacafe.com/ItemFiles/%5BFrom%20www.metacafe.com%5D%201399591.7202120.11.flv";
            entry.Source = KalturaEntryMediaSource.URL;
            entry.MediaType = KalturaEntryMediaType.VIDEO;

            KalturaResult entryResult = client.AddEntry(user, kshowId, entry);
            if (entryResult.WasError())
            {
                Console.WriteLine("Failed to add entry [" + entryResult.GetErrorDescription(0) + "]");
                Console.ReadKey();
                return;
            }
            string entryId = entryResult["result"]["entries"]["entry_"]["id"].Value;

            Console.WriteLine("Entry created succesfully [" + entryId + "]");


            // test the search
            KalturaResult res = client.Search(user, KalturaEntryMediaType.VIDEO, KalturaEntryMediaSource.PHOTOBUCKET, "dogs");

            Console.ReadKey();
        }
    }
}
