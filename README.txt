Kaltura CE V4 
*****************
For release notes see: http://www.kaltura.org/kaltura-ce-v40-release-notes
For installation guide see: http://www.kaltura.org/kaltura-ce-v40-installation-guides
For VMWare based installation see: http://www.kaltura.org/kaltura-ce-v40-vmware-image-package


General
=======
Kaltura CE V4 is based on the Dragonfly release of the Kaltura online video platform.  
It provides  new features, infrastructure enhancements, and new API services.

Supported/Tested OS
====================
Kaltura CE v4 has been tested on the following operating systems:
- CentOS 5.6 64-bit
Please note that it is possible to install Kaltura CE on other Linux distributions as well, however it was not yet fully tested by Kaltura

Was NOT tested in this version
===============================
- CentOS 32bit
- Ubuntu


Features that require additional setup/3rd party licensing/CDN capabilities
============================================================================
- Akamai HD Network& Apple HTTP Streaming - requires content delivery through Akamai 
- RTMP delivery . requires CDN/FMS integration 
- Adaptive bit-rate . requires CDN/FMS integration (already integrated with Akamai) 
- Analytics . for capturing CDN bandwidth usage . CDN logs integration is needed (already integrated with CDN logs of Akamai, limelight, level3) 
- Analytics . user geo-distribution analytics . requires ip2location DB license 
- Live streaming workflow . requires CDN/FMS integration for live channel provisioning and for live streaming (already integrated with Akamai's live channel provisioning). 
- Webcam recording . requires FMS integration . instructions to be provided. 
- Access control . geo restriction - requires ip2location DB license for maintainable ip2location DB (current mapping relies on the IP to country database from http://software77.net/geo-ip 
- Advertising . requires 3rd party ad-server account 
- Content syndication via Tubemogul . requires a tubemogul account 
- Transcoding to VP6 format requires On2 transcoder . configuration instructions to be provided 

Features that require add-on server components which are not provided for CE integration
=========================================================================================
- Doc conversion server - required for enabling PPT-Video widget 
- Remix download - flattening server 

Known issues
============
- A Kaltura CE Amazon Machine Image (AMI) will be available in the coming weeks. 
- The Syndication Distribution Connector(included in admin console) was not certified. 
- Registration of new and existing partner from the Drupal Extension failed when connected to a Kaltura CE V4.0 server. A fix will be provided. 
- Registration of new and existing partner from the Moodle Extension failed when connected to a Kaltura CE V4.0 server. A fix will be provided. 
- The Kaltura Sakai Extension was not tested when connected to a Kaltura CE V4.0 server. 
- KS generation errors occurs when the server is not set to the correct time. Server must have correct time when converted to UTC or external applications that generate KS might fail. 
- At this point, Kaltura does not provide a complete migration path from older versions of the Kaltura CE the current one. 
- The links within the KMC to Kaltura contact pages are pointing to the KMC hosted by Kaltura at www.kaltura.com and not to the local Kaltura CE.



-----------------------------------------------------------------------------------------------------------------
Get Assistance
**************
The KalturaCE is a community-supported open source project. 
The best place to get help is in our Community Forums at http://kaltura.org/forums/kaltura-server-community-edition-forums 


Get More Information
*********************
More information on installing and working with the Kaltura CE is available at the Kaltura CE documentation pages at: 
http://www.kaltura.org/kaltura-community-edition-kalturace
