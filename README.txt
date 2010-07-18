Kaltura CE V2 Release Notes
***************************
General
=======
Kaltura CE V2.0 is based on the Butterfly release of the Kaltura online video platform. It provides many new features, an enhanced architecture of server batch processing , a robust set of administration tools and many new API services.

Supported/Tested OS
====================
Kaltura CE has been tested on the following operating systems:
- Ubunto 10.04 - 32-bit/64-bit
- CentOS 5.5 – 32-bit/64-bit
Please note that it is possible to install Kaltura CE on other Linux distributions as well, however it was not yet fully tested by Kaltura


New Features and Functionalities
================================
The following list includes the main new features that are available as part of the Kaltura CE V2.0, for more information, please refer to the KMC Quick Start Guide or to the Kaltura CE documentation pages at http://www.kaltura.org/kaltura-community-edition-kalturace
- Video Analytics
- Access Control & Scheduling
- External Syndication & SEO
- Adaptive Bandwidth & Transcoding Profiles
- Kaltura Online Video Editors Integrated in KMC
- Content categories tree Integrated in KMC
- Kaltura Player: KDP3 Integrated in KMC
- The new generation of Kaltura’s batch processing module
- Live streaming workflow
- Kaltura admin console functionalities
		-Multi-publisher support
		-Multi system admin user support (for admin console users only)
		-Batch processing control
		-Monitoring
		
Features that require additional setup/3rd party licensing/CDN capabilities
===========================================================================
- RTMP delivery – requires FMS integration
- Adaptive bit-rate – requires CDN integration (already integrated with Akamai)
- Analytics – for capturing CDN bandwidth usage – CDN logs integration is needed (already integrated with CDN logs of Akamai, limelight, level3)
- Analytics – user geo-distribution analytics – requires ip2location DB license or integration with another ip to geo service
- Live streaming workflow – requires CDN integration for live channel provisioning (already integrated with Akamai live channel provisioning).
- Webcam recording – requires FMS integration – instructions to be provided.
- Access control – geo restriction - requires ip2location DB license for maintainable ip2location DB (current mapping relies on the IP to country database from http://software77.net/geo-ip
- Advertising – requires 3rd party account at Tremor/ Adap.tv
- Content syndication via Tubemogul – requires a tubemogul account
- Transcoding to the VP6 codec requires On2 transcoder – configuration instructions to be provided.
- Enabling Encoding.com cloud transcoding requires an account at Encoding.com and batch configuration adjustments - configuration instructions to be provided


Known Issues
============
- Kaltura CE does not support PHP 5.3 – Kaltura recommends the use of XAMPP 1.7.1
- Kaltura CE should run as a Virtual Host under Apache2
- Kaltura does not provide a complete migration path from older versions of the Kaltura CE to the current one
- The following batch services are not fully operable and should be kept at a Disabled state:  E-Mail Ingestion, Storage Delete,Storage Export,Convert Collection, Expression Encoder 3
- The KMC live streaming workflow UI is disabled by default. A script for activating it per publisher account will be provided
- Kaltura CMS/LMS Extensions - Kaltura CE V2.x is working with the latest versions of the Kaltura CMS/LMS extensions (Drupal, Wordpress,Joomla, Moodle).These latest extensions versions are available for download from each extension download page. 
- The links within the KMC 'Quick Start Guide' PDF are pointing to the KMC hosted by Kaltura at www.kaltura.com and not to the local Kaltura CE

-----------------------------------------------------------------------------------------------------------------
Get Assistance
**************
The KalturaCE is a community-supported open source project. The best place to get help is in our Community Forums at http://kaltura.org/forums/kaltura-server-community-edition-forums 


Get More Information
*********************
More information on installing and working with the Kaltura CE is available at the Kaltura CE documentation pages at: http://www.kaltura.org/kaltura-community-edition-kalturace