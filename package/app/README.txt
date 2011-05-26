Kaltura CE V3 Beta - Release Notes
***************************
General
=======
Kaltura CE V3 is based on the Cassiopea release of the Kaltura online video platform.  It provides  new features, infrastructure enhancements, and new API services.

Supported/Tested OS
====================
Kaltura CE has been tested on the following operating systems:
- Ubunto 10.04 - 32-bit/64-bit 
- CentOS 5.5 – 32-bit/64-bit
Please note that it is possible to install Kaltura CE on other Linux distributions as well, however it was not yet fully tested by Kaltura


New Features and Functionalities
================================
The following list includes the main new features that are available as part of the Kaltura CE V3.0, for more information, please refer to the KMC Quick Start Guide or to the Kaltura CE documentation pages at http://www.kaltura.org/kaltura-community-edition-kalturace
- Full support for PHP 5.3
- Full Support of any VAST ad server in player (Player Advertising tab in KMC studio)
- Custom Metadata Fields
- KMC passowrd security enhancments 
- Mobile support (trascoding flavors)
- Net Storage - enabling auto-export to and delivery from a remote storage.
- Sphinx - full text search engine (bundled within the Kaltura CE package)- All entries and playlists searches moved to sphinx search engine
- Server-side Plug-in infrastructure (documentation will be provided)



		
Features that require additional setup/3rd party licensing/CDN capabilities
===========================================================================
- RTMP delivery – requires FMS/CDN integration
- Adaptive bit-rate – requires FMS/CDN integration (already integrated with Akamai)
- Analytics – for capturing CDN bandwidth usage – CDN logs integration is needed (already integrated with CDN logs of Akamai, limelight, level3)
- Analytics – user geo-distribution analytics – requires ip2location DB license or integration with another ip to geo service
- Live streaming workflow – requires CDN integration for live channel provisioning (already integrated with Akamai live channel provisioning).
- Webcam recording – requires FMS integration – instructions to be provided.
- Access control – geo restriction - requires ip2location DB license for maintainable ip2location DB (current mapping relies on the IP to country database from http://software77.net/geo-ip
- Advertising – requires 3rd party account at Tremor/ Adap.tv
- Content syndication via Tubemogul – requires a tubemogul account
- Transcoding to the VP6 codec requires On2 transcoder – configuration instructions to be provided.
- Enabling Encoding.com cloud transcoding requires an account at Encoding.com and batch configuration adjustments - configuration instructions to be provided

Features that require add-on server components which are not provided for CE integration
========================================================================================
- Remix download - flattening server
- Doc conversion/PPT-Video widget 
- Silvelight player/smooth streaming


Known Issues
============
- Kaltura CE should run as a Virtual Host under Apache2
- Kaltura does not provide a complete migration path from CE 1.5 and older. Migration instruction from Kaltura CE 2.0.x to Kaltura CE 3.0 will be provided.
- The links within the KMC 'Quick Start Guide' PDF are pointing to the KMC hosted by Kaltura at www.kaltura.com and not to the local Kaltura CE
- Incomplete testing of Kaltura CMS/LMS extensions (WP,Drupal ,Joomla, Moodle ) with Kaltura CE v3.0 Beta version - to be finalized on official release 

-----------------------------------------------------------------------------------------------------------------
Get Assistance
**************
The KalturaCE is a community-supported open source project. The best place to get help is in our Community Forums at http://kaltura.org/forums/kaltura-server-community-edition-forums 


Get More Information
*********************
More information on installing and working with the Kaltura CE is available at the Kaltura CE documentation pages at: http://www.kaltura.org/kaltura-community-edition-kalturace