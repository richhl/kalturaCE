Kaltura Community Edition (KalturaCE_alpha_1.0)
====================
Kaltura inc.
For proffesional support and added services contact us at:
Company:                http://corp.kaltura.com/
Community:              http://kaltura.org/
Career Opportunities:   jobs@kaltura.com 
Tech Support:           support@kaltura.com
Sales:                  +1 (949) 7133370

Table of Contents
--------------------
KalturaCE (Kaltura Community Edition)
0.1 Alpha release
Hardware and software requirements
Pre-Installation requirements 
Installation
Installation FAQ and known problems
Version history
Post-Installation
Working with Drupal
Working with WordPress
Reading logs and Investigating
Batch Watch
Additional resources


KalturaCE (Kaltura Community Edition)
====================
The Community Edition is a full featured video and rich-media application management server solution developed through the combined efforts of Kaltura and the Kaltura community hosted on Kaltura.org. Bug fixes and support are provided by the community.
Kaltura provides additional value-added services, including: consulting, expert support, hosting & streaming, CDN network, advertising and monetization, video SEO, etc.
Note that you can create a great combination of both by creating your own video solution, and leveraging some or all of Kaltura's services as well.
The Community Edition is deployed on a single server and is available under the GNU Affero General Public License v3.

0.1 Alpha release
====================
Server Components -
1. Content upload, bulk upload.
2. Search and import content from online repositories.
2. Content and application management.
4. Video encoding and Image manipulation.
5. Notifications.
6. System monitoring console.

Flash/Flex Clients -
1. Kaltura Management Console (KMC) - 
2. Kaltura Dynamic Player +Playlist (KDP) - Highly customizable rich media player and an MRSS playlist extension.
3. Kaltura Contribution Wizard - Customizable wizard, enabling end users to easily upload and import media from various sources using a single interface.
4. Kaltura Standard Editor (KSE) - This video editor that allows users to create remixes from images, audio and video files. Easy to use UI and customizable skin and locale.
5. Kaltura Advanced Editor (KAE) - Full featured video editor to create remixes from images, audio and video files based on timeline-based editing. Customizable skin and locale, extensions, dynamic features and statistics and JS hooks integration.

Integration Level - 
1. API Client library generator for php5 (upcoming .NET-C#, php4, python, ruby and more).

Hardware and software requirements
====================
Linux, Apache 2.2, Mysql 5 and PHP 5.2.2+.

Linux -
Any Debian based and 32Bit distribution.
Successfuly tested on the following:
Debian 2.6+
Ubuntu 8.04+

SMTP server should be installed on the system and configured to run on localhost:25.

It is highly recommended to run KalturaCE under XAMPP installation (http://www.apachefriends.org/en/xampp-linux.html), if your system is not configured yet - use XAMPP.

KalturaCE also requires the following to be installed:
php-cli, libcURL, memcache (optional, but recommended for better preformance) and mod-rewrite.

Pre-Installation requirements 
====================
In order to run and to enable pretty urls, KalturaCE utilizes .htaccess and Apache Mod_Rewrite.
The following shows how to configure a default XAMPP installation to enable .htaccess and Mod_Rewrite.
1. Open the /opt/lampp/etc/httpd.conf file.
2. Look for the following line: 
    ;Options Indexes FollowSymLinks ExecCGI Includes 
3. Uncomment this line by removing the ";" from the start, if this line .
3. Look for: 
    AllowOverride
4. To enable using .htaccess, make sure the line written as follow: 
    AllowOverride All
5. Enable Mod_Rewrite by adding the following line: 
    LoadModule rewrite_module modules/mod_rewrite.so

Installation 
====================
1. Download the latest release from http://kaltura.org/project/kalturaCE.
2. Unpack the tar file to your web root directory (e.g. tar xvfzp ./kalturaCE_{version}.tgz -C /opt/lampp/htdocs/).
3. Create a new database create a user and grant it the necessary privileges (All privileges, except "grant").
4. Browse to http://localhost/kalturaCE/index.php
5. Follow the instructions on the installation wizard.

Installation FAQ and known problems
====================
Q: Why am I getting an error about php-cli not found ?
A: Install php-cli (sudo apt-get install php5-cli). 
  (On XAMPP installation you should have php5-cli enabled by default).

Q: I get messages saying the permissions are not right, what should I do ?
A: Run kalturaCE/install/fixperms.sh with the user owner of the web root directory (or use sudo kalturaCE/install/fixperms.sh).

Q: How do I install memcache ?
A: Run the command: apt-get install memcached php5-memcache
   edit the file: /etc/php5/conf.d/memcache.ini
   uncomment the line: ;extension=memcache.so (By removing the ";" from the start).
   Restart apache (usualy by running the following command with root user: /etc/init.d/apache2 restart).
   
Q: How do I install libcURL ?
A: sudo apt-get install curl libcurl3 libcurl4-openssl-dev php5-curl
   Restart apache.
  (On XAMPP installation you should have libcURL enabled by default).
  
Q: How do I install and enable Mod_Rewrite ?
A: Run the following command with root user: a2enmod rewrite
   Restart apache.
  (On XAMPP installation you should have Mod_Rewrite enabled by default).
   
   
Version history
====================
First public alpha release.

Post-Installation
====================
Congratulations! You are now ready to experience the various parts of the system, to ease your start, browse to the root of your new KalturaCE installation (at http://localhost/kalturaCE) where you'll find the following:
* Sample Implementation - View and play with a sample website application that uses your newly installed KalturaCE services. 
In this basic Kaltura Application you can use the KCW to upload/import content, use the KSE to easily mash up and remix content images, video and audio create new videos.
* Kaltura Management Console - A partner management console that enables partners to view and manage all their content including moderation control, upload and bulk upload, create playlists as well as manage account information, view usage statistics and administer various integration settings.
* System Tools - Set of administration tools to monitor different aspects of the KalturaCE server including; monitoring of batch processes, view and manage the different content in the system (with root permissions, as oppose to KMC where the access is per partner only), investigate statuses of different aspects of the system such as pending jobs and notifications and change server specific settings such base url and CDN host.
* API Test Console - Interactive browser to view and test the different APIs (api_v3).

You may also want to check out the followings:
* We also recommend to read the API documentation at:
  http://localhost/kalturaCE/kaltura/api_v3/web/testmeDoc/
* Use the php5 client library located on /kalturaCE/kaltura/api_v3/generator/php5 to build applications of your own like the Sample Implementation.

Working with Drupal
====================
Kaltura provides a video module for Drupal (downloaded at http://drupal.org/project/kaltura).
Using Drupal you can start playing with KalturaCE without the need to implement or develop anything and easily experience some of the KalturaCE capabilities.
To work with Drupal follow these steps:
1. Install Drupal -
    In case KalturaCE was installed on a computer which is not publicly available, install Drupal on the same computer as KalturaCE or on any computer which can access the KalturaCE installation (i.e on the same LAN)
    In case KalturaCE was installed on a computer which is publicly available you can install Drupal wherever you want.
2. Download the Kaltura module for Drupal from http://drupal.org/project/kaltura and place it in the modules directory of Drupal
    The Kaltura module depends on the following modules for full functionality, you can download and add them as well:
    CCK - http://drupal.org/project/cck
    Views - http://drupal.org/project/views
    JQuery Update - http://drupal.org/project/jquery_update
3. Open the file (in the Kaltura module)
    kaltura_client/kaltura_settings.php
   Find the line:
    define('KalturaSettings_SERVER_URL', "http://www.kaltura.com");
   Replace the URL (http://www.kaltura.com) to the full URL of your KalturaCE installation.
   For example, if you installed KalturaCE to:
    http://localhost/kalturaCE
   The line would be:
    define('KalturaSettings_SERVER_URL', "http://localhost/kalturaCE");
4. continue with the normal flow of the Kaltura module activation . you can see that  described here: http://drupal.kaltura.org/node/147 , a video tutorial is also available here: http://drupal.kaltura.org/tutorial/
 
Note that if you install KalturaCE on a localhost (and that is the SERVER URL you provide during installation), only applications that run on the same server will behave as expected.


Working with WordPress
====================
Kaltura provides the "All in One Video Pack" plugin for WordPress (download at http://wordpress.org/extend/plugins/all-in-one-video-pack/).
Using the WordPress plugin you can start experiencing some basic capabilities of KalturaCE without the need to implement or develop anything.
To work with WordPress follow these steps:
1. Install WordPress from wordpress.org-
    In case KalturaCE was installed on a computer which is not publicly available, install WordPress on the same computer as KalturaCE or on any computer which can access the KalturaCE installation (i.e on the same LAN)
    In case KalturaCE was installed on a computer which is publicly available you can install WordPress wherever you want.
2. Download the Kaltura "All in One Video Pack" plugin for WordPress from http://wordpress.org/extend/plugins/all-in-one-video-pack/.
3. Install the plugin using the instructions provided with the plugin.
4. Open the plugin settings file from
    /wp-content/plugins/all-in-one-video-pack/settings.php
   Find the line:
    define("KALTURA_SERVER_URL", "http://www.kaltura.com");
   Replace the URL (http://www.kaltura.com) with the full URL of your KalturaCE installation.
   For example, if you installed KalturaCE to:
    http://localhost/kalturaCE
   The line would be:
    define("KALTURA_SERVER_URL", "http://localhost/kalturaCE");
 
   Do the same for the line:
    define("KALTURA_CDN_URL", "http://cdn.kaltura.com");
   That will make it look like this (according to the example above):
    define("KALTURA_CDN_URL", "http://localhost/kalturaCE");
 
Note that if you install KalturaCE on a localhost (and that is the SERVER URL you provide during installation), only applications that run on the same server will behave as expected.

Reading logs and Investigating
====================
KalturaCE provides as much logs as possible and investigation console to monitor and understand what have gone wrong in case of failures.
The logs in the system are located under the kalturaCE/logs/ folder and are divided as follows:
kaltura_api_v3.log - provides a log about the services of api_v3.
kaltura_prod.log - provides a log about the services of api_v2 (aka. partnerServices2).
kaltura_batch.log - provides general application logs about the batche processes in the system (batch connections to the database).
kaltura_install.log - the installation log (not in use after installation is over).
Additional logs are provided by each batch process individually - 
{machine_name}-batchBulkUpload.log - the bulk upload batch.
{machine_name}-batchDownloadVideoServer.log - addDownload service batch process log.
{machine_name}-batchEmailServer.log - email sending batch (according to mail_job table in the database).
{machine_name}-batchImportServer.log - importing process (imports files from other online sources).
{machine_name}-batchNotificationServer.log - notification batch log.
{machine_name}-batchRunner.log - logs the different batch processes execution.
{machine_name}-batchWatch.log - logs the different running batch statuses.
{machine_name}-newBatchConvertClient.log - batch that prepares files for conversion.
{machine_name}-newBatchConvertServer.log - batch that process the file conversion.

In order to investigate the status of processed entries, use the Investigate panel under the system console at /kalturaCE/api_v3/system/investigate.php

Batch Watch
====================
Inside the system console, the Batch Dashboard shows the status of the various batch processes in the system.
When the KalturaCE installation completes, all the batch processes are started automatically, However, if the system is restarted the batch processes should be started again manually.
We recommend creating a cron job or adding the script (kalturaCE/alpha/batch/runBatch.sh start) to the init.d in order to configure this operation to run automatically upon reboot.

Additional resources
====================
* For submitting bugs, feature requests and ideas use the project page and issue manager at: 
  http://kaltura.org/project/kalturaCE.
* For KalturaCE related discussions, look for help and socializing with other KalturaCE developers visit the project forums at: 
  http://kaltura.org/work/forums/kaltura-server-community-edition-forums.
