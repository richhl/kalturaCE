
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `admin_kuser`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `admin_kuser` (
  `id` int(11) NOT NULL auto_increment,
  `screen_name` varchar(20) default NULL,
  `full_name` varchar(40) default NULL,
  `email` varchar(50) default NULL,
  `sha1_password` varchar(40) default NULL,
  `salt` varchar(32) default NULL,
  `picture` varchar(48) default NULL,
  `icon` tinyint(4) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `partner_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `screen_name_index` (`screen_name`),
  KEY `admin_kuser_FI_1` (`partner_id`),
  KEY `email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `admin_permission`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `admin_permission` (
  `id` int(11) NOT NULL auto_increment,
  `groups` varchar(512) default NULL,
  `admin_kuser_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `admin_permission_FI_1` (`admin_kuser_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `alert`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `alert` (
  `id` int(11) NOT NULL auto_increment,
  `kuser_id` int(11) default NULL,
  `alert_type` int(11) default NULL,
  `subject_id` int(11) default NULL,
  `rule_type` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `kuser_index` (`kuser_id`),
  KEY `subject_index` (`alert_type`,`subject_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `batch_job`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `batch_job` (
  `id` int(11) NOT NULL auto_increment,
  `job_type` smallint(6) default NULL,
  `job_sub_type` smallint(6) default NULL,
  `data` varchar(4096) default NULL,
  `status` int(11) default NULL,
  `abort` tinyint(4) default NULL,
  `check_again_timeout` int(11) default NULL,
  `progress` tinyint(4) default NULL,
  `message` varchar(1024) default NULL,
  `description` varchar(1024) default NULL,
  `updates_count` smallint(6) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `entry_id` varchar(10) default '',
  `partner_id` int(11) default NULL,
  `subp_id` int(11) default NULL,
  `processor_name` varchar(64) default NULL,
  `processor_expiration` datetime default NULL,
  `parent_job_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `entry_id_index_id` (`entry_id`,`id`),
  KEY `status_job_type_index` (`status`,`job_type`),
  KEY `created_at_job_type_status_index` (`created_at`,`job_type`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `bb_forum`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `bb_forum` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `description` text,
  `post_count` int(11) default '0',
  `thread_count` int(11) default '0',
  `last_post` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `is_live` int(11) default '1',
  PRIMARY KEY  (`id`),
  KEY `bb_forum_FI_1` (`last_post`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `bb_post`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `bb_post` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) default NULL,
  `content` text,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `kuser_id` int(11) default NULL,
  `forum_id` int(11) default NULL,
  `parent_id` int(11) default NULL,
  `node_level` int(11) default NULL,
  `node_id` varchar(64) default NULL,
  `num_childern` int(11) default '0',
  `last_child` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `bb_post_FI_1` (`kuser_id`),
  KEY `bb_post_FI_2` (`forum_id`),
  KEY `bb_post_FI_3` (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `blocked_email`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `blocked_email` (
  `email` varchar(40) NOT NULL,
  PRIMARY KEY  (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `collect_stats`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `collect_stats` (
  `ip` int(11) default NULL,
  `date` datetime default NULL,
  `partner_id` int(11) default NULL,
  `entry_id` varchar(10) default NULL,
  `widget_id` varchar(32) default NULL,
  `command` varchar(10) default NULL,
  `uv_id` varchar(32) default NULL,
  KEY `partner_command` (`partner_id`,`command`),
  KEY `entry_command` (`partner_id`,`command`),
  KEY `widget_command` (`widget_id`,`command`),
  KEY `date` (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `comment`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL auto_increment,
  `kuser_id` int(11) default NULL,
  `comment_type` int(11) default NULL,
  `subject_id` int(11) default NULL,
  `base_date` date default NULL,
  `reply_to` int(11) default NULL,
  `comment` varchar(256) default NULL,
  `created_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `subject_created_index` (`comment_type`,`subject_id`,`base_date`,`reply_to`,`created_at`),
  KEY `comment_FI_1` (`kuser_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `conversion`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `conversion` (
  `id` int(11) NOT NULL auto_increment,
  `entry_id` varchar(10) default NULL,
  `in_file_name` varchar(128) default NULL,
  `in_file_ext` varchar(16) default NULL,
  `in_file_size` int(11) default NULL,
  `source` int(11) default NULL,
  `status` int(11) default NULL,
  `conversion_params` varchar(512) default NULL,
  `out_file_name` varchar(128) default NULL,
  `out_file_size` int(11) default NULL,
  `out_file_name_2` varchar(128) default NULL,
  `out_file_size_2` int(11) default NULL,
  `conversion_time` int(11) default NULL,
  `total_process_time` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `entry_id_index` (`entry_id`),
  KEY `id_status_index` (`id`,`status`),
  KEY `created_at_status_index` (`created_at`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `conversion_params`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `conversion_params` (
  `id` int(11) NOT NULL auto_increment,
  `partner_id` int(11) default NULL,
  `enabled` tinyint(4) default '1',
  `name` varchar(128) default NULL,
  `profile_type` varchar(128) default NULL,
  `profile_type_index` int(11) default NULL,
  `width` int(11) default NULL,
  `height` int(11) default NULL,
  `aspect_ratio` varchar(6) default NULL,
  `gop_size` int(11) default NULL,
  `bitrate` int(11) default NULL,
  `qscale` int(11) default NULL,
  `file_suffix` varchar(64) default NULL,
  `custom_data` varchar(4096) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `partner_id_index` (`partner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=100030 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `conversion_profile`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `conversion_profile` (
  `id` int(11) NOT NULL auto_increment,
  `partner_id` int(11) default '0',
  `enabled` tinyint(4) default '1',
  `name` varchar(128) default NULL,
  `profile_type` varchar(128) default NULL,
  `commercial_transcoder` tinyint(4) default NULL,
  `width` int(11) default NULL,
  `height` int(11) default NULL,
  `aspect_ratio` varchar(6) default NULL,
  `bypass_flv` tinyint(4) default NULL,
  `use_with_bulk` tinyint(4) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `profile_type_suffix` varchar(32) default NULL,
  PRIMARY KEY  (`id`),
  KEY `partner_id_index` (`partner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=100098 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `email_campaign`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `email_campaign` (
  `id` int(11) NOT NULL auto_increment,
  `criteria_id` smallint(6) default NULL,
  `criteria_str` varchar(1024) default NULL,
  `criteria_params` varchar(1024) default NULL,
  `template_path` varchar(256) default NULL,
  `campaign_mgr_kuser_id` int(11) default NULL,
  `send_count` int(11) default NULL,
  `open_count` int(11) default NULL,
  `click_count` int(11) default NULL,
  `status` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `campaign_mgr_kuser_id_index` (`campaign_mgr_kuser_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `entry`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `entry` (
  `id` varchar(10) NOT NULL,
  `kshow_id` varchar(10) default NULL,
  `kuser_id` int(11) default NULL,
  `name` varchar(60) default NULL,
  `type` smallint(6) default NULL,
  `media_type` smallint(6) default NULL,
  `data` varchar(48) default NULL,
  `thumbnail` varchar(48) default NULL,
  `views` int(11) default '0',
  `votes` int(11) default '0',
  `comments` int(11) default '0',
  `favorites` int(11) default '0',
  `total_rank` int(11) default '0',
  `rank` int(11) default '0',
  `tags` text,
  `anonymous` tinyint(4) default NULL,
  `status` int(11) default NULL,
  `source` smallint(6) default NULL,
  `source_id` int(11) default NULL,
  `source_link` varchar(1024) default NULL,
  `license_type` smallint(6) default NULL,
  `credit` varchar(1024) default NULL,
  `length_in_msecs` int(11) default '0',
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `partner_id` int(11) default '0',
  `display_in_search` tinyint(4) default '1',
  `subp_id` int(11) default '0',
  `custom_data` text,
  `search_text` varchar(4096) default NULL,
  `screen_name` varchar(20) default NULL,
  `site_url` varchar(256) default NULL,
  `permissions` int(11) default NULL,
  `group_id` varchar(64) default NULL,
  `plays` int(11) default '0',
  `partner_data` varchar(4096) default NULL,
  `int_id` int(11) NOT NULL auto_increment,
  `indexed_custom_data_1` int(11) default NULL,
  `description` text,
  `media_date` datetime default NULL,
  `admin_tags` text,
  `moderation_status` int(11) default '2',
  `moderation_count` int(11) default '0',
  `modified_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `kshow_rank_index` (`kshow_id`,`rank`),
  KEY `kshow_views_index` (`kshow_id`,`views`),
  KEY `kshow_votes_index` (`kshow_id`,`votes`),
  KEY `kshow_created_index` (`kshow_id`,`created_at`),
  KEY `views_index` (`views`),
  KEY `votes_index` (`votes`),
  KEY `entry_FI_2` (`kuser_id`),
  KEY `partner_id_index` (`partner_id`,`id`),
  KEY `kshow_index` (`partner_id`,`kshow_id`,`subp_id`),
  KEY `kshow_index_2` (`partner_id`,`kshow_id`,`status`,`subp_id`),
  KEY `partner_created_at_index` (`partner_id`,`created_at`),
  KEY `partner_created_at_status_type_index` (`partner_id`,`created_at`,`status`,`type`),
  KEY `type_kuser_id_index` (`type`,`kuser_id`),
  KEY `created_index` (`created_at`),
  KEY `status_created_index` (`status`,`created_at`),
  KEY `type_status_created_index` (`type`,`status`,`created_at`),
  KEY `created_at_index` (`created_at`),
  KEY `partner_group_index` (`partner_id`,`group_id`),
  KEY `int_id_index` (`int_id`),
  KEY `partner_kuser_indexed_custom_data_index` (`partner_id`,`kuser_id`,`indexed_custom_data_1`),
  KEY `partner_status_index` (`partner_id`,`status`),
  KEY `partner_moderation_status` (`partner_id`,`moderation_status`),
  KEY `partner_modified_at_index` (`partner_id`,`modified_at`),
  KEY `partner_status_media_type_index` (`partner_id`,`status`,`media_type`),
  FULLTEXT KEY `search_text_index` (`search_text`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `facebook_invite`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `facebook_invite` (
  `id` int(11) NOT NULL auto_increment,
  `puser_id` varchar(64) default NULL,
  `invited_puser_id` varchar(64) default NULL,
  `status` smallint(6) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `puser_id_index` (`puser_id`),
  KEY `invited_puser_id_index` (`invited_puser_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `favorite`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `favorite` (
  `kuser_id` int(11) default NULL,
  `subject_type` int(11) default NULL,
  `subject_id` int(11) default NULL,
  `privacy` int(11) default NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`),
  KEY `kuser_index` (`kuser_id`),
  KEY `subject_index` (`subject_type`,`subject_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `flag`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `flag` (
  `id` int(11) NOT NULL auto_increment,
  `kuser_id` int(11) default NULL,
  `subject_type` int(11) default NULL,
  `subject_id` int(11) default NULL,
  `flag_type` int(11) default NULL,
  `other` varchar(60) default NULL,
  `comment` varchar(2048) default NULL,
  `created_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `subject_created_index` (`subject_type`,`subject_id`,`created_at`),
  KEY `flag_FI_1` (`kuser_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `flickr_token`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `flickr_token` (
  `kalt_token` varchar(256) NOT NULL,
  `frob` varchar(64) default NULL,
  `token` varchar(64) default NULL,
  `nsid` varchar(64) default NULL,
  `response` varchar(512) default NULL,
  `is_valid` int(11) default '0',
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`kalt_token`),
  KEY `is_valid_index` (`is_valid`,`kalt_token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `keyword`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `keyword` (
  `word` varchar(30) NOT NULL,
  `entity_id` int(11) default NULL,
  `entity_type` int(11) default NULL,
  `entity_columns` varchar(30) default NULL,
  PRIMARY KEY  (`word`),
  KEY `word_index` (`word`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `kshow`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `kshow` (
  `id` varchar(10) NOT NULL,
  `producer_id` int(11) default NULL,
  `episode_id` varchar(10) default NULL,
  `name` varchar(60) default NULL,
  `subdomain` varchar(30) default NULL,
  `description` text,
  `status` int(11) default '0',
  `type` int(11) default NULL,
  `media_type` int(11) default NULL,
  `format_type` int(11) default NULL,
  `language` int(11) default NULL,
  `start_date` date default NULL,
  `end_date` date default NULL,
  `skin` text,
  `thumbnail` varchar(48) default NULL,
  `show_entry_id` varchar(10) default NULL,
  `intro_id` varchar(10) default NULL,
  `views` int(11) default '0',
  `votes` int(11) default '0',
  `comments` int(11) default '0',
  `favorites` int(11) default '0',
  `rank` int(11) default '0',
  `entries` int(11) default '0',
  `contributors` int(11) default '0',
  `subscribers` int(11) default '0',
  `number_of_updates` int(11) default '0',
  `tags` text,
  `custom_data` text,
  `indexed_custom_data_1` int(11) default NULL,
  `indexed_custom_data_2` int(11) default NULL,
  `indexed_custom_data_3` varchar(256) default NULL,
  `reoccurence` int(11) default NULL,
  `license_type` int(11) default NULL,
  `length_in_msecs` int(11) default '0',
  `view_permissions` int(11) default NULL,
  `view_password` varchar(40) default NULL,
  `contrib_permissions` int(11) default NULL,
  `contrib_password` varchar(40) default NULL,
  `edit_permissions` int(11) default NULL,
  `edit_password` varchar(40) default NULL,
  `salt` varchar(32) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `partner_id` int(11) default '0',
  `display_in_search` tinyint(4) default '1',
  `subp_id` int(11) default '0',
  `search_text` varchar(4096) default NULL,
  `permissions` varchar(1024) default NULL,
  `group_id` varchar(64) default NULL,
  `plays` int(11) default '0',
  `partner_data` varchar(4096) default NULL,
  `int_id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`),
  KEY `views_index` (`views`),
  KEY `votes_index` (`votes`),
  KEY `created_at_index` (`created_at`),
  KEY `type_index` (`type`),
  KEY `kshow_FI_1` (`producer_id`),
  KEY `indexed_custom_data_1_index` (`indexed_custom_data_1`),
  KEY `indexed_custom_data_2_index` (`indexed_custom_data_2`),
  KEY `indexed_custom_data_3_index` (`indexed_custom_data_3`),
  KEY `partner_id_subp_index` (`partner_id`,`id`,`subp_id`),
  KEY `partner_created_at_indes` (`partner_id`,`created_at`),
  KEY `created_index` (`created_at`),
  KEY `producer_updated_index` (`producer_id`,`updated_at`),
  KEY `producer_updated_id_index` (`producer_id`,`updated_at`,`id`),
  KEY `partner_subp_entries_index` (`partner_id`,`subp_id`,`entries`),
  KEY `partner_group_index` (`partner_id`,`group_id`),
  KEY `int_id_index` (`int_id`),
  FULLTEXT KEY `search_text_index` (`search_text`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `kshow_kuser`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `kshow_kuser` (
  `kshow_id` varchar(10) default NULL,
  `kuser_id` int(11) default NULL,
  `subscription_type` int(11) default NULL,
  `alert_type` int(11) default NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`),
  KEY `kshow_index` (`kshow_id`),
  KEY `kuser_index` (`kuser_id`),
  KEY `subscription_index` (`kshow_id`,`subscription_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `kuser`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `kuser` (
  `id` int(11) NOT NULL auto_increment,
  `screen_name` varchar(20) default NULL,
  `full_name` varchar(40) default NULL,
  `email` varchar(50) default NULL,
  `sha1_password` varchar(40) default NULL,
  `salt` varchar(32) default NULL,
  `date_of_birth` date default NULL,
  `country` varchar(2) default NULL,
  `state` varchar(16) default NULL,
  `city` varchar(30) default NULL,
  `zip` varchar(10) default NULL,
  `url_list` varchar(256) default NULL,
  `picture` varchar(48) default NULL,
  `icon` tinyint(4) default NULL,
  `about_me` varchar(4096) default NULL,
  `tags` text,
  `tagline` varchar(256) default NULL,
  `network_highschool` varchar(30) default NULL,
  `network_college` varchar(30) default NULL,
  `network_other` varchar(30) default NULL,
  `mobile_num` varchar(16) default NULL,
  `mature_content` tinyint(4) default NULL,
  `gender` tinyint(4) default NULL,
  `registration_ip` int(11) default NULL,
  `registration_cookie` varchar(256) default NULL,
  `im_list` varchar(256) default NULL,
  `views` int(11) default '0',
  `fans` int(11) default '0',
  `entries` int(11) default '0',
  `produced_kshows` int(11) default '0',
  `status` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `partner_id` int(11) default '0',
  `display_in_search` tinyint(4) default '1',
  `search_text` varchar(4096) default NULL,
  `partner_data` varchar(4096) default NULL,
  PRIMARY KEY  (`id`),
  KEY `screen_name_index` (`screen_name`),
  KEY `full_name_index` (`full_name`),
  KEY `network_college_index` (`network_college`),
  KEY `network_highschool_index` (`network_highschool`),
  KEY `entries_index` (`entries`),
  KEY `views_index` (`views`),
  KEY `partner_id_index` (`partner_id`,`id`),
  KEY `partner_created_at_indes` (`partner_id`,`created_at`),
  KEY `created_index` (`created_at`),
  FULLTEXT KEY `search_text_index` (`search_text`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `kvote`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `kvote` (
  `id` int(11) NOT NULL auto_increment,
  `kshow_id` varchar(10) default NULL,
  `entry_id` varchar(10) default NULL,
  `kuser_id` int(11) default NULL,
  `rank` int(11) default NULL,
  `created_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `kshow_index` (`kshow_id`),
  KEY `entry_user_index` (`entry_id`),
  KEY `kvote_FI_3` (`kuser_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `kwidget_log`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `kwidget_log` (
  `id` int(11) NOT NULL auto_increment,
  `widget_id` varchar(24) default NULL,
  `source_widget_id` varchar(24) default NULL,
  `root_widget_id` varchar(24) default NULL,
  `kshow_id` varchar(10) default NULL,
  `entry_id` varchar(10) default NULL,
  `ui_conf_id` int(11) default NULL,
  `referer` varchar(1024) default NULL,
  `views` int(11) default '0',
  `ip1` int(11) default NULL,
  `ip1_count` int(11) default '0',
  `ip2` int(11) default NULL,
  `ip2_count` int(11) default '0',
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `plays` int(11) default '0',
  `partner_id` int(11) default '0',
  `subp_id` int(11) default '0',
  PRIMARY KEY  (`id`),
  KEY `referer_index` (`referer`(333)),
  KEY `entry_id_kshow_id_index` (`entry_id`,`kshow_id`),
  KEY `partner_id_subp_id_index` (`partner_id`,`subp_id`),
  KEY `kwidget_log_FI_1` (`widget_id`),
  KEY `kwidget_log_FI_2` (`kshow_id`),
  KEY `kwidget_log_FI_4` (`ui_conf_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `mail_job`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `mail_job` (
  `id` int(11) NOT NULL auto_increment,
  `mail_type` smallint(6) default NULL,
  `mail_priority` smallint(6) default NULL,
  `recipient_name` varchar(64) default NULL,
  `recipient_email` varchar(64) default NULL,
  `recipient_id` int(11) default NULL,
  `from_name` varchar(64) default NULL,
  `from_email` varchar(64) default NULL,
  `body_params` varchar(2048) default NULL,
  `subject_params` varchar(512) default NULL,
  `template_path` varchar(512) default NULL,
  `culture` tinyint(4) default NULL,
  `status` tinyint(4) default NULL,
  `created_at` datetime default NULL,
  `campaign_id` int(11) default NULL,
  `min_send_date` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `campaign_id_index` (`campaign_id`),
  KEY `STATUS_PRIORITY_INDEX` (`status`,`mail_priority`),
  KEY `recipient_id_index` (`recipient_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `moderation`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `moderation` (
  `id` int(11) NOT NULL auto_increment,
  `partner_id` int(11) default NULL,
  `subp_id` int(11) default NULL,
  `object_id` varchar(10) default NULL,
  `object_type` smallint(6) default NULL,
  `kuser_id` int(11) default NULL,
  `puser_id` varchar(64) default NULL,
  `status` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `comments` varchar(1024) default NULL,
  `group_id` varchar(64) default NULL,
  `report_code` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `partner_id_status_index` (`partner_id`,`status`),
  KEY `partner_id_group_id_status_index` (`partner_id`,`group_id`,`status`),
  KEY `object_index` (`partner_id`,`status`,`object_id`,`object_type`),
  KEY `moderation_FI_1` (`kuser_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `notification`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `notification` (
  `id` int(11) NOT NULL auto_increment,
  `partner_id` int(11) default NULL,
  `puser_id` varchar(64) default NULL,
  `type` smallint(6) default NULL,
  `object_id` varchar(10) default NULL,
  `status` int(11) default NULL,
  `notification_data` varchar(4096) default NULL,
  `number_of_attempts` smallint(6) default '0',
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `notification_result` varchar(256) default NULL,
  `object_type` smallint(6) default NULL,
  PRIMARY KEY  (`id`),
  KEY `status_partner_id_index` (`status`,`partner_id`),
  KEY `object_type_object_id` (`object_type`,`object_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `partner`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `partner` (
  `id` int(11) NOT NULL auto_increment,
  `partner_name` varchar(256) default NULL,
  `url1` varchar(1024) default NULL,
  `url2` varchar(1024) default NULL,
  `secret` varchar(50) default NULL,
  `admin_secret` varchar(50) default NULL,
  `max_number_of_hits_per_day` int(11) default '-1',
  `appear_in_search` int(11) default '2',
  `debug_level` int(11) default '0',
  `invalid_login_count` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `partner_alias` varchar(64) default NULL,
  `ANONYMOUS_KUSER_ID` int(11) default NULL,
  `ks_max_expiry_in_seconds` int(11) default NULL,
  `create_user_on_demand` tinyint(4) default '1',
  `prefix` varchar(32) default NULL,
  `admin_name` varchar(50) character set latin1 collate latin1_general_ci default NULL,
  `admin_email` varchar(50) character set latin1 collate latin1_general_ci default NULL,
  `description` varchar(1024) character set latin1 collate latin1_general_ci default NULL,
  `commercial_use` tinyint(4) default '0',
  `moderate_content` tinyint(4) default '0',
  `notify` tinyint(4) default '0',
  `custom_data` text,
  `service_config_id` varchar(64) default NULL,
  `status` tinyint(4) default '1',
  `content_categories` varchar(1024) default NULL,
  `type` tinyint(4) default '1',
  `phone` varchar(64) default NULL,
  `describe_yourself` varchar(64) default NULL,
  `adult_content` tinyint(4) default '0',
  `partner_package` tinyint(4) default '1',
  `usage_percent` int(11) default '0',
  `storage_usage` int(11) default '0',
  `eighty_percent_warning` int(11) default NULL,
  `usage_limit_warning` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `partner_alias_index` (`partner_alias`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `partner_activity`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `partner_activity` (
  `id` int(11) NOT NULL auto_increment,
  `partner_id` int(11) default NULL,
  `activity_date` date default NULL,
  `activity` int(11) default NULL,
  `sub_activity` int(11) default NULL,
  `amount` int(11) default NULL,
  `amount1` int(11) default '0',
  `amount2` int(11) default '0',
  `amount3` int(11) default '0',
  `amount4` int(11) default '0',
  `amount5` int(11) default '0',
  `amount6` int(11) default '0',
  `amount7` int(11) default '0',
  `amount8` int(11) default '0',
  `amount9` int(11) default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `partner_id` (`partner_id`,`activity_date`,`activity`,`sub_activity`),
  KEY `partner_id_index` (`partner_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `partner_stats`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `partner_stats` (
  `partner_id` int(11) NOT NULL,
  `views` int(11) default NULL,
  `plays` int(11) default NULL,
  `videos` int(11) default NULL,
  `audios` int(11) default NULL,
  `images` int(11) default NULL,
  `entries` int(11) default NULL,
  `users_1` int(11) default NULL,
  `users_2` int(11) default NULL,
  `rc_1` int(11) default NULL,
  `rc_2` int(11) default NULL,
  `kshows_1` int(11) default NULL,
  `kshows_2` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `custom_data` text,
  `widgets` int(11) default NULL,
  PRIMARY KEY  (`partner_id`),
  KEY `partner_id_index` (`partner_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `partner_transactions`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `partner_transactions` (
  `id` int(11) NOT NULL auto_increment,
  `partner_id` int(11) default NULL,
  `created_at` datetime default NULL,
  `amount` float default NULL,
  `currency` varchar(6) default NULL,
  `transaction_id` varchar(17) default NULL,
  `timestamp` datetime default NULL,
  `correlation_id` varchar(12) default NULL,
  `ack` varchar(20) default NULL,
  `transaction_data` text,
  PRIMARY KEY  (`id`),
  KEY `partner_id_index` (`partner_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `partnership`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `partnership` (
  `id` int(11) NOT NULL auto_increment,
  `partnership_order` int(11) default NULL,
  `image_path` varchar(256) default NULL,
  `href` varchar(1024) default NULL,
  `text` varchar(1024) default NULL,
  `alt` varchar(256) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `partnership_date` varchar(128) default NULL,
  PRIMARY KEY  (`id`),
  KEY `partnership_order_index` (`partnership_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `pr_news`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pr_news` (
  `id` int(11) NOT NULL auto_increment,
  `pr_order` int(11) default NULL,
  `image_path` varchar(256) default NULL,
  `href` varchar(1024) default NULL,
  `text` varchar(1024) default NULL,
  `alt` varchar(256) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `press_date` varchar(128) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `puser_kuser`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `puser_kuser` (
  `id` int(11) NOT NULL auto_increment,
  `partner_id` int(11) default NULL,
  `puser_id` varchar(64) default NULL,
  `kuser_id` int(11) default NULL,
  `puser_name` varchar(64) default NULL,
  `custom_data` varchar(1024) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `context` varchar(1024) default '',
  `subp_id` int(11) default '0',
  PRIMARY KEY  (`id`),
  KEY `partner_puser_index` (`partner_id`,`puser_id`),
  KEY `kuser_id_index` (`kuser_id`),
  KEY `I_referenced_puser_role_FK_3_1` (`puser_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `puser_role`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `puser_role` (
  `id` int(11) NOT NULL auto_increment,
  `kshow_id` varchar(10) default NULL,
  `partner_id` int(11) default NULL,
  `puser_id` varchar(64) default NULL,
  `role` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `subp_id` int(11) default '0',
  PRIMARY KEY  (`id`),
  KEY `partner_puser_index` (`partner_id`,`puser_id`),
  KEY `kshow_id_index` (`kshow_id`),
  KEY `puser_role_FI_3` (`puser_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `roughcut_entry`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `roughcut_entry` (
  `id` int(11) NOT NULL auto_increment,
  `roughcut_id` varchar(10) default NULL,
  `roughcut_version` int(11) default NULL,
  `roughcut_kshow_id` varchar(10) default NULL,
  `entry_id` varchar(10) default NULL,
  `partner_id` int(11) default NULL,
  `op_type` smallint(6) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `partner_id_index` (`partner_id`),
  KEY `entry_id_index` (`entry_id`),
  KEY `roughcut_id_index` (`roughcut_id`),
  KEY `roughcut_kshow_id_index` (`roughcut_kshow_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `tagword_count`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `tagword_count` (
  `tag` varchar(30) NOT NULL,
  `tag_count` int(11) default NULL,
  PRIMARY KEY  (`tag`),
  KEY `count_index` (`tag_count`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `tmp`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `tmp` (
  `id` int(11) NOT NULL default '0',
  `kshow_id` int(11) default NULL,
  `kuser_id` int(11) default NULL,
  `name` varchar(60) default NULL,
  `type` smallint(6) default NULL,
  `media_type` smallint(6) default NULL,
  `data` varchar(48) default NULL,
  `thumbnail` varchar(48) default NULL,
  `views` int(11) default '0',
  `votes` int(11) default '0',
  `comments` int(11) default '0',
  `favorites` int(11) default '0',
  `total_rank` int(11) default '0',
  `rank` int(11) default '0',
  `tags` text,
  `anonymous` tinyint(4) default NULL,
  `status` int(11) default NULL,
  `source` smallint(6) default NULL,
  `source_id` int(11) default NULL,
  `source_link` varchar(1024) default NULL,
  `license_type` smallint(6) default NULL,
  `credit` varchar(1024) default NULL,
  `length_in_msecs` int(11) default '0',
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `partner_id` int(11) default '0',
  `display_in_search` tinyint(4) default '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `ui_conf`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `ui_conf` (
  `id` int(11) NOT NULL auto_increment,
  `obj_type` smallint(6) default NULL,
  `partner_id` int(11) default NULL,
  `subp_id` int(11) default '0',
  `conf_file_path` varchar(128) default NULL,
  `name` varchar(128) default NULL,
  `width` varchar(10) default NULL,
  `height` varchar(10) default NULL,
  `html_params` varchar(256) default NULL,
  `swf_url` varchar(256) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `conf_vars` varchar(4096) default NULL,
  `use_cdn` tinyint(4) default '0',
  `tags` text,
  `custom_data` text,
  `status` int(11) default '2',
  `description` varchar(4096) default NULL,
  `display_in_search` tinyint(4) default '2',
  `creation_mode` tinyint(4) default '1',
  PRIMARY KEY  (`id`),
  KEY `partner_id_index` (`partner_id`),
  KEY `partner_id_creation_mode_index` (`partner_id`,`creation_mode`)
) ENGINE=MyISAM AUTO_INCREMENT=48212 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `unique_visitors_cookie`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `unique_visitors_cookie` (
  `uv_id` varchar(32) default NULL,
  `date` date default NULL,
  UNIQUE KEY `date_uv_id` (`date`,`uv_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `unique_visitors_ip`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `unique_visitors_ip` (
  `ip` int(11) default NULL,
  `date` date default NULL,
  UNIQUE KEY `date_ip` (`date`,`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `widget`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `widget` (
  `id` varchar(32) NOT NULL,
  `int_id` int(11) NOT NULL auto_increment,
  `source_widget_id` varchar(32) default NULL,
  `root_widget_id` varchar(32) default NULL,
  `partner_id` int(11) default NULL,
  `subp_id` int(11) default NULL,
  `kshow_id` varchar(10) default NULL,
  `entry_id` varchar(10) default NULL,
  `ui_conf_id` int(11) default NULL,
  `custom_data` varchar(1024) default NULL,
  `security_type` smallint(6) default NULL,
  `security_policy` smallint(6) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `partner_data` varchar(4096) default NULL,
  PRIMARY KEY  (`id`),
  KEY `int_id_index` (`int_id`),
  KEY `widget_FI_1` (`kshow_id`),
  KEY `widget_FI_2` (`entry_id`),
  KEY `widget_FI_3` (`ui_conf_id`),
  KEY `partner_id_index` (`partner_id`),
  KEY `created_at_index` (`created_at`)
) ENGINE=MyISAM AUTO_INCREMENT=526 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `widget_log`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `widget_log` (
  `id` int(11) NOT NULL auto_increment,
  `kshow_id` varchar(10) default NULL,
  `entry_id` varchar(10) default NULL,
  `kmedia_type` int(11) default NULL,
  `widget_type` varchar(32) default NULL,
  `referer` varchar(1024) default NULL,
  `views` int(11) default '0',
  `ip1` int(11) default NULL,
  `ip1_count` int(11) default '0',
  `ip2` int(11) default NULL,
  `ip2_count` int(11) default '0',
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `plays` int(11) default '0',
  `partner_id` int(11) default '0',
  `subp_id` int(11) default '0',
  PRIMARY KEY  (`id`),
  KEY `referer_index` (`referer`(333)),
  KEY `entry_id_kshow_id_index` (`entry_id`,`kshow_id`),
  KEY `views_index` (`views`),
  KEY `plays_index` (`plays`),
  KEY `partner_id_subp_id_index` (`partner_id`,`subp_id`),
  KEY `created_at` (`created_at`),
  KEY `widget_index` (`widget_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- MySQL dump 10.11
--
-- Host: localhost    Database: kaltura
-- ------------------------------------------------------
-- Server version	5.0.51a-3ubuntu5

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ui_conf`
--

DROP TABLE IF EXISTS `ui_conf`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `ui_conf` (
  `id` int(11) NOT NULL auto_increment,
  `obj_type` smallint(6) default NULL,
  `partner_id` int(11) default NULL,
  `subp_id` int(11) default '0',
  `conf_file_path` varchar(128) default NULL,
  `name` varchar(128) default NULL,
  `width` varchar(10) default NULL,
  `height` varchar(10) default NULL,
  `html_params` varchar(256) default NULL,
  `swf_url` varchar(256) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `conf_vars` varchar(4096) default NULL,
  `use_cdn` tinyint(4) default '0',
  `tags` text,
  `custom_data` text,
  `status` int(11) default '2',
  `description` varchar(4096) default NULL,
  `display_in_search` tinyint(4) default '2',
  `creation_mode` tinyint(4) default '1',
  PRIMARY KEY  (`id`),
  KEY `partner_id_index` (`partner_id`),
  KEY `partner_id_creation_mode_index` (`partner_id`,`creation_mode`)
) ENGINE=MyISAM AUTO_INCREMENT=48212 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `ui_conf`
--

LOCK TABLES `ui_conf` WRITE;
/*!40000 ALTER TABLE `ui_conf` DISABLE KEYS */;
INSERT INTO `ui_conf` VALUES (380,2,0,0,'/web/content/uiconf/kaltura/corp_new/kcw_2.6.4/kcw.xml','corp cw','680','480',NULL,'/flash/kcw/v1.6.5CE/ContributionWizard.swf','2008-06-10 15:30:00','2008-06-10 15:30:00',NULL,1,NULL,NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (600,1,0,0,'/web/content/uiconf/kaltura/drupal/kdp_drupal.xml','drupal kdp','','',NULL,'/flash/kdp/v1.2.3CE/kdp.swf','2008-06-10 15:30:00','2008-06-10 15:30:00','',1,NULL,NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (601,2,0,0,'/web/content/uiconf/kaltura/drupal/cw_drupal.xml','drupal cw','680','480',NULL,'/flash/kcw/v1.5.4CE/ContributionWizard.swf','2008-06-10 15:30:00','2008-06-10 15:30:00',NULL,1,NULL,NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (602,2,0,0,'/web/content/uiconf/kaltura/drupal/cw_drupal_in_se.xml','drupal cw','680','480',NULL,'/flash/kcw/v1.5.4CE/ContributionWizard.swf','2008-06-10 15:30:00','2008-06-10 15:30:00',NULL,1,NULL,NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (603,3,0,0,'/web/content/uiconf/kaltura/drupal/se_drupal.xml','drupal simple editor','890','546','','/flash/kse/v2.1.3CE/simpleeditor.swf','2008-05-19 15:30:00','2008-05-19 15:30:00',NULL,1,NULL,NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (604,1,0,0,'/web/content/uiconf/kaltura/drupal/kdp_1.1.11/kdp_drupal_v2.1_dark_remix.xml','drupal dark kdp (remix)','','',NULL,'/flash/kdp/v1.2.3CE/kdp.swf','2008-06-10 15:30:00','2008-06-10 15:30:00','',1,NULL,NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (605,1,0,0,'/web/content/uiconf/kaltura/drupal/kdp_1.1.11/kdp_drupal_v2.1_dark_view.xml','drupal dark kdp (view)','','',NULL,'/flash/kdp/v1.2.3CE/kdp.swf','2008-06-10 15:30:00','2008-06-10 15:30:00','',1,NULL,NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (606,1,0,0,'/web/content/uiconf/kaltura/drupal/kdp_1.1.11/kdp_drupal_v2.1_gray_remix.xml','drupal gray kdp (remix)','','',NULL,'/flash/kdp/v1.2.3CE/kdp.swf','2008-06-10 15:30:00','2008-06-10 15:30:00','',1,NULL,NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (607,1,0,0,'/web/content/uiconf/kaltura/drupal/kdp_1.1.11/kdp_drupal_v2.1_gray_view.xml','drupal gray kdp (view)','','',NULL,'/flash/kdp/v1.2.3CE/kdp.swf','2008-06-10 15:30:00','2008-06-10 15:30:00','',1,NULL,NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (608,1,0,0,'/web/content/uiconf/kaltura/drupal/kdp_1.1.11/kdp_drupal_v2.1_whiteblue_remix.xml','drupal white-blue kdp (remix)','','',NULL,'/flash/kdp/v1.2.3CE/kdp.swf','2008-06-10 15:30:00','2008-06-10 15:30:00','',1,NULL,NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (609,1,0,0,'/web/content/uiconf/kaltura/drupal/kdp_1.1.11/kdp_drupal_v2.1_whiteblue_view.xml','drupal white-blue kdp (view)','','',NULL,'/flash/kdp/v1.2.3CE/kdp.swf','2008-06-10 15:30:00','2008-06-10 15:30:00','',1,NULL,NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (520,1,0,0,'/web/content/uiconf/kaltura/wordpress/kdp_1.1.11/kdp_wordpress_v2.1_whiteblue.xml','wordpress v2.1','410','364',NULL,'/flash/kdp/v1.2.3CE/kdp.swf','2008-11-30 15:30:00','2008-11-30 15:30:00',NULL,1,NULL,NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (521,1,0,0,'/web/content/uiconf/kaltura/wordpress/kdp_1.1.11/kdp_wordpress_v2.1_dark.xml','wordpress v2.1','410','364',NULL,'/flash/kdp/v1.2.3CE/kdp.swf','2008-11-30 15:30:00','2008-11-30 15:30:00',NULL,1,NULL,NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (522,1,0,0,'/web/content/uiconf/kaltura/wordpress/kdp_1.1.11/kdp_wordpress_v2.1_gray.xml','wordpress v2.1','410','364',NULL,'/flash/kdp/v1.2.3CE/kdp.swf','2008-11-30 15:30:00','2008-11-30 15:30:00',NULL,1,NULL,NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (523,1,0,0,'/web/content//uiconf/kaltura/wordpress/kdp_1.1.11/kdp_wordpress_thumb_v2.1_gray.xml','wordpress v2.2 thumbnails','410','364',NULL,'/flash/kdp/v1.2.3CE/kdp.swf','2008-11-30 15:30:00','2008-11-30 15:30:00',NULL,1,NULL,NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (501,2,0,0,'/web/content/uiconf/kaltura/wordpress/cw_wordpress.xml','wordpress cw','680','480',NULL,'/flash/kcw/v1.5.4CE/ContributionWizard.swf','2008-05-19 15:30:00','2008-05-19 15:30:00',NULL,1,NULL,NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (502,3,0,0,'/web/content/uiconf/kaltura/wordpress/se_wordpress.xml','wordpress simple editor','890','546','','/flash/kse/v2.1.3CE/simpleeditor.swf','2008-05-19 15:30:00','2008-05-19 15:30:00',NULL,1,NULL,NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (503,2,0,0,'/web/content/uiconf/kaltura/wordpress/cw_wordpress_comments.xml','wordpress cw','680','480',NULL,'/flash/kcw/v1.5.4CE/ContributionWizard.swf','2008-05-19 15:30:00','2008-05-19 15:30:00',NULL,1,NULL,NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (504,2,0,0,'/web/content/uiconf/kaltura/wordpress/cw_wordpress_in_se.xml','wordpress cw','680','480',NULL,'/flash/kcw/v1.5.4CE/ContributionWizard.swf','2008-05-19 15:30:00','2008-05-19 15:30:00',NULL,1,NULL,NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (36200,2,0,0,'/web/content/uiconf/kaltura/samplekit/kcw_2.6.4/kcw_samplekit.xml','samplekit cw','680','480',NULL,'/flash/kcw/v1.6.5CE/ContributionWizard.swf','2009-03-25 12:09:22','2009-03-25 12:09:22',NULL,1,NULL,NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (48110,1,0,0,'/web/content/uiconf/kaltura/default_player/kdp_2.0.0/kdp_default_dark.xml','Dark player skin','400','332','','/flash/kdp/v2.0.2CE/kdp.swf','2009-03-30 06:33:10','2009-03-30 06:33:10',NULL,1,'player',NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (48111,1,0,0,'/web/content/uiconf/kaltura/default_player/kdp_2.0.0/kdp_default_light.xml','Light player skin','400','332','','/flash/kdp/v2.0.2CE/kdp.swf','2009-03-30 06:33:16','2009-03-30 06:33:16',NULL,1,'player',NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (48204,1,0,0,'/web/content/uiconf/kaltura/default_player/kdp_2.0.0/pl_vertical_compactIr_noTitle_noTabs.xml','Vertical Compact','400','600','','/flash/kdp/v2.0.2CE/kdp.swf','2009-03-30 06:32:50','2009-03-30 06:32:50',NULL,1,'playlist',NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (48205,1,0,0,'/web/content/uiconf/kaltura/default_player/kdp_2.0.0/pl_vertical_defaultIr_noTitle_noTabs.xml','Vertical','400','600','','/flash/kdp/v2.0.2CE/kdp.swf','2009-03-30 06:32:56','2009-03-30 06:32:56',NULL,1,'playlist',NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (48206,1,0,0,'/web/content/uiconf/kaltura/default_player/kdp_2.0.0/pl_horizontal_defaultIr_noTabs_noTitle.xml','Horizontal','660','272','','/flash/kdp/v2.0.2CE/kdp.swf','2009-03-30 06:33:01','2009-03-30 06:33:01',NULL,1,'playlist',NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (48207,1,0,0,'/web/content/uiconf/kaltura/default_player/kdp_2.0.0/pl_horizontal_compactlIr_noTitle_noTabs.xml','Horizontal Compact','724','322','','/flash/kdp/v2.0.2CE/kdp.swf','2009-03-30 06:33:06','2009-03-30 06:33:06',NULL,1,'playlist',NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (48210,1,0,0,'/web/content/uiconf/kaltura/default_player/kdp_2.0.0/pl_horizontal_defaultIr_light.xml','playlist playlist no tabs bright','655','300','','/flash/kdp/v2.0.2CE/kdp.swf','2009-03-29 09:48:42','2009-03-29 09:48:42','',1,NULL,NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (48211,1,0,0,'/web/content/uiconf/kaltura/default_player/kdp_2.0.0/pl_horizontal_defaultIr.xml','playlist playlist no tabs ','655','300','','/flash/kdp/v2.0.2CE/kdp.swf','2009-03-29 09:48:42','2009-03-29 09:48:42','',1,NULL,NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (199,1,0,0,'/web/content/uiconf/kaltura/default_player/kdp_2.0.0/kdp_default_dark.xml','kdp kaltura default dark','400','332','','/flash/kdp/v2.0.2CE/kdp.swf','2009-03-30 06:32:42','2009-03-30 06:32:42',NULL,1,NULL,NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (47400,4,0,0,'/web/content/uiconf/kaltura/generic/kae_1.0.10/kae_generic_generic.xml','ae','750','640','','/flash/kae/v1.0.10CE/KalturaAdvancedVideoEditor.swf','2009-03-30 06:48:07','2009-03-30 06:48:07',NULL,1,NULL,NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (47401,4,0,0,'/web/content/uiconf/kaltura/generic/kae_1.0.10/kae_generic_generic_no_thumbnail.xml','ae','750','640','','/flash/kae/v1.0.10CE/KalturaAdvancedVideoEditor.swf','2009-03-30 06:48:07','2009-03-30 06:48:07',NULL,1,NULL,NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (36300,3,0,0,'/web/content/uiconf/kaltura/samplekit/kse_2.1.1/kse_samplekit.xml','samplekit simple editor','890','546','','/flash/kse/v2.1.3CE/simpleeditor.swf','2009-04-06 09:25:39','2009-04-06 09:25:39',NULL,1,NULL,NULL,2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (31001,1,0,0,'/web/content/uiconf/kaltura/kmc/appstudio/playlist_ui.xml','playlist ui','0','0','','','2009-04-07 12:13:49','2009-04-07 12:13:49','',1,NULL,'a:1:{s:12:\"creationMode\";i:2;}',2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (31002,1,0,0,'/web/content/uiconf/kaltura/kmc/appstudio/player_ui.xml','player ui','0','0','','','2009-04-07 12:13:50','2009-04-07 12:13:50','',1,NULL,'a:1:{s:12:\"creationMode\";i:2;}',2,NULL,2,1);
INSERT INTO `ui_conf` VALUES (36202,2,0,0,'/web/content/uiconf/kaltura/kmc/kcw/kcw_kmc.xml','cw for KMC','680','480',NULL,'/flash/kcw/v1.6.5CE/ContributionWizard.swf','2009-05-05 04:46:40','2009-05-05 04:46:40',NULL,1,NULL,NULL,2,NULL,2,1);
/*!40000 ALTER TABLE `ui_conf` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2009-05-05 10:23:27
-- MySQL dump 10.11
--
-- Host: localhost    Database: kaltura
-- ------------------------------------------------------
-- Server version	5.0.51a-3ubuntu5

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `widget`
--

DROP TABLE IF EXISTS `widget`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `widget` (
  `id` varchar(32) NOT NULL,
  `int_id` int(11) NOT NULL auto_increment,
  `source_widget_id` varchar(32) default NULL,
  `root_widget_id` varchar(32) default NULL,
  `partner_id` int(11) default NULL,
  `subp_id` int(11) default NULL,
  `kshow_id` varchar(10) default NULL,
  `entry_id` varchar(10) default NULL,
  `ui_conf_id` int(11) default NULL,
  `custom_data` varchar(1024) default NULL,
  `security_type` smallint(6) default NULL,
  `security_policy` smallint(6) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `partner_data` varchar(4096) default NULL,
  PRIMARY KEY  (`id`),
  KEY `int_id_index` (`int_id`),
  KEY `widget_FI_1` (`kshow_id`),
  KEY `widget_FI_2` (`entry_id`),
  KEY `widget_FI_3` (`ui_conf_id`),
  KEY `partner_id_index` (`partner_id`),
  KEY `created_at_index` (`created_at`)
) ENGINE=MyISAM AUTO_INCREMENT=526 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `widget`
--

LOCK TABLES `widget` WRITE;
/*!40000 ALTER TABLE `widget` DISABLE KEYS */;
INSERT INTO `widget` VALUES ('520',520,'','520',0,0,'0','0',520,'',0,1,'2008-09-01 15:30:00','2008-09-01 15:30:00','');
INSERT INTO `widget` VALUES ('521',521,'','521',0,0,'0','0',521,'',0,1,'2008-09-01 15:30:00','2008-09-01 15:30:00','');
INSERT INTO `widget` VALUES ('522',522,'','522',0,0,'0','0',522,'',0,1,'2008-09-01 15:30:00','2008-09-01 15:30:00','');
INSERT INTO `widget` VALUES ('523',523,'','523',0,0,'0','0',523,'',0,1,'2009-03-26 10:44:04','2009-03-26 10:44:04','');
INSERT INTO `widget` VALUES ('_1_520',520,'','520',1,100,'0','0',520,'',0,1,'2008-09-01 15:30:00','2008-09-01 15:30:00','');
INSERT INTO `widget` VALUES ('_1_521',521,'','521',1,100,'0','0',521,'',0,1,'2008-09-01 15:30:00','2008-09-01 15:30:00','');
INSERT INTO `widget` VALUES ('_1_522',522,'','522',1,100,'0','0',522,'',0,1,'2008-09-01 15:30:00','2008-09-01 15:30:00','');
INSERT INTO `widget` VALUES ('48110',524,'','',0,0,'0','0',48110,'',0,1,NULL,NULL,'');
INSERT INTO `widget` VALUES ('48111',525,'','',0,0,'0','0',48111,'',0,1,NULL,NULL,'');
/*!40000 ALTER TABLE `widget` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2009-05-05 10:23:27
-- MySQL dump 10.11
--
-- Host: localhost    Database: kaltura
-- ------------------------------------------------------
-- Server version	5.0.51a-3ubuntu5

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `conversion_params`
--

DROP TABLE IF EXISTS `conversion_params`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `conversion_params` (
  `id` int(11) NOT NULL auto_increment,
  `partner_id` int(11) default NULL,
  `enabled` tinyint(4) default '1',
  `name` varchar(128) default NULL,
  `profile_type` varchar(128) default NULL,
  `profile_type_index` int(11) default NULL,
  `width` int(11) default NULL,
  `height` int(11) default NULL,
  `aspect_ratio` varchar(6) default NULL,
  `gop_size` int(11) default NULL,
  `bitrate` int(11) default NULL,
  `qscale` int(11) default NULL,
  `file_suffix` varchar(64) default NULL,
  `custom_data` varchar(4096) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `partner_id_index` (`partner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=100030 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `conversion_params`
--

LOCK TABLES `conversion_params` WRITE;
/*!40000 ALTER TABLE `conversion_params` DISABLE KEYS */;
INSERT INTO `conversion_params` VALUES (1,0,1,'low_play','low',1,0,0,'2',100,400,0,'','a:4:{s:20:\"commercialTranscoder\";s:1:\"0\";s:12:\"ffmpegParams\";s:0:\"\";s:14:\"mencoderParams\";s:0:\"\";s:10:\"flixParams\";s:0:\"\";}','2008-11-24 11:54:15','2009-02-05 15:06:16');
INSERT INTO `conversion_params` VALUES (2,0,1,'low_play','lowedit',1,0,0,'2',100,400,0,'','a:4:{s:20:\"commercialTranscoder\";s:1:\"0\";s:12:\"ffmpegParams\";s:0:\"\";s:14:\"mencoderParams\";s:0:\"\";s:10:\"flixParams\";s:0:\"\";}','2009-02-05 15:30:04','2009-02-05 15:30:04');
INSERT INTO `conversion_params` VALUES (3,0,1,'low_edit','lowedit',2,0,0,'2',5,400,0,'_edit','a:4:{s:20:\"commercialTranscoder\";s:1:\"0\";s:12:\"ffmpegParams\";s:0:\"\";s:14:\"mencoderParams\";s:0:\"\";s:10:\"flixParams\";s:0:\"\";}','2009-02-05 15:17:40','2009-02-05 15:30:28');
INSERT INTO `conversion_params` VALUES (4,0,1,'med_play','med',1,0,0,'2',100,800,0,'','a:4:{s:20:\"commercialTranscoder\";s:1:\"0\";s:12:\"ffmpegParams\";s:0:\"\";s:14:\"mencoderParams\";s:0:\"\";s:10:\"flixParams\";s:0:\"\";}','2009-02-05 15:32:47','2009-02-05 15:34:31');
INSERT INTO `conversion_params` VALUES (5,0,1,'med_play','mededit',1,0,0,'2',100,800,0,'','a:4:{s:20:\"commercialTranscoder\";s:1:\"0\";s:12:\"ffmpegParams\";s:0:\"\";s:14:\"mencoderParams\";s:0:\"\";s:10:\"flixParams\";s:0:\"\";}','2009-02-05 15:34:41','2009-02-05 15:34:41');
INSERT INTO `conversion_params` VALUES (6,0,1,'med_edit','mededit',2,0,0,'2',5,800,0,'_edit','a:4:{s:20:\"commercialTranscoder\";s:1:\"0\";s:12:\"ffmpegParams\";s:0:\"\";s:14:\"mencoderParams\";s:0:\"\";s:10:\"flixParams\";s:0:\"\";}','2009-02-05 15:34:57','2009-02-05 15:34:57');
INSERT INTO `conversion_params` VALUES (7,0,1,'high_play','high',1,0,0,'2',100,1200,0,'','a:4:{s:20:\"commercialTranscoder\";s:1:\"0\";s:12:\"ffmpegParams\";s:0:\"\";s:14:\"mencoderParams\";s:0:\"\";s:10:\"flixParams\";s:0:\"\";}','2009-02-05 15:41:33','2009-02-05 15:41:33');
INSERT INTO `conversion_params` VALUES (8,0,1,'high_play','highedit',1,0,0,'2',100,1200,0,'','a:4:{s:20:\"commercialTranscoder\";s:1:\"0\";s:12:\"ffmpegParams\";s:0:\"\";s:14:\"mencoderParams\";s:0:\"\";s:10:\"flixParams\";s:0:\"\";}','2009-02-05 15:41:48','2009-02-05 15:41:48');
INSERT INTO `conversion_params` VALUES (9,0,1,'high_edit','highedit',2,0,0,'2',5,1200,0,'_edit','a:4:{s:20:\"commercialTranscoder\";s:1:\"0\";s:12:\"ffmpegParams\";s:0:\"\";s:14:\"mencoderParams\";s:0:\"\";s:10:\"flixParams\";s:0:\"\";}','2009-02-05 15:41:59','2009-02-05 15:41:59');
INSERT INTO `conversion_params` VALUES (10,0,1,'hd','hd',1,0,0,'2',300,40000,0,'','a:4:{s:20:\"commercialTranscoder\";s:1:\"1\";s:12:\"ffmpegParams\";s:0:\"\";s:14:\"mencoderParams\";s:0:\"\";s:10:\"flixParams\";s:0:\"\";}','2009-02-05 15:43:35','2009-02-05 15:43:35');
INSERT INTO `conversion_params` VALUES (11,0,1,'download','download',1,0,0,'2',300,0,0,'','a:4:{s:20:\"commercialTranscoder\";s:1:\"0\";s:12:\"ffmpegParams\";s:0:\"\";s:14:\"mencoderParams\";s:0:\"\";s:10:\"flixParams\";s:0:\"\";}','2009-02-05 15:44:51','2009-02-05 15:44:51');
INSERT INTO `conversion_params` VALUES (100027,0,1,'wp_default','wp_default',1,0,0,'2',100,800,0,'','a:4:{s:20:\"commercialTranscoder\";s:1:\"0\";s:12:\"ffmpegParams\";s:0:\"\";s:14:\"mencoderParams\";s:0:\"\";s:10:\"flixParams\";s:0:\"\";}','2009-02-05 15:32:47','2009-02-05 15:34:31');
INSERT INTO `conversion_params` VALUES (100028,0,1,'wp_default','wp_defaultedit',1,0,0,'2',100,800,0,'','a:4:{s:20:\"commercialTranscoder\";s:1:\"0\";s:12:\"ffmpegParams\";s:0:\"\";s:14:\"mencoderParams\";s:0:\"\";s:10:\"flixParams\";s:0:\"\";}','2009-02-05 15:34:41','2009-02-05 15:34:41');
INSERT INTO `conversion_params` VALUES (100029,0,1,'wp_default','wp_defaultedit',2,0,0,'2',5,800,0,'_edit','a:4:{s:20:\"commercialTranscoder\";s:1:\"0\";s:12:\"ffmpegParams\";s:0:\"\";s:14:\"mencoderParams\";s:0:\"\";s:10:\"flixParams\";s:0:\"\";}','2009-02-05 15:34:57','2009-02-05 15:34:57');
INSERT INTO `conversion_params` VALUES (99999,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `conversion_params` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2009-05-05 10:23:27
-- MySQL dump 10.11
--
-- Host: localhost    Database: kaltura
-- ------------------------------------------------------
-- Server version	5.0.51a-3ubuntu5

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `conversion_profile`
--

DROP TABLE IF EXISTS `conversion_profile`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `conversion_profile` (
  `id` int(11) NOT NULL auto_increment,
  `partner_id` int(11) default '0',
  `enabled` tinyint(4) default '1',
  `name` varchar(128) default NULL,
  `profile_type` varchar(128) default NULL,
  `commercial_transcoder` tinyint(4) default NULL,
  `width` int(11) default NULL,
  `height` int(11) default NULL,
  `aspect_ratio` varchar(6) default NULL,
  `bypass_flv` tinyint(4) default NULL,
  `use_with_bulk` tinyint(4) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `profile_type_suffix` varchar(32) default NULL,
  PRIMARY KEY  (`id`),
  KEY `partner_id_index` (`partner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=100098 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `conversion_profile`
--

LOCK TABLES `conversion_profile` WRITE;
/*!40000 ALTER TABLE `conversion_profile` DISABLE KEYS */;
INSERT INTO `conversion_profile` VALUES (1,0,1,'low','low',0,0,0,'2',0,1,'2008-11-24 13:40:45','2009-02-05 15:30:10','edit');
INSERT INTO `conversion_profile` VALUES (2,0,1,'med','med',0,0,0,'2',0,NULL,'2009-02-05 15:23:07','2009-02-05 15:24:55','edit');
INSERT INTO `conversion_profile` VALUES (3,0,1,'high','high',0,0,0,'2',0,NULL,'2009-02-05 15:40:27','2009-02-05 15:40:27','edit');
INSERT INTO `conversion_profile` VALUES (4,0,1,'hd','hd',1,0,0,'2',0,NULL,'2009-02-05 15:43:01','2009-02-05 15:43:01','');
INSERT INTO `conversion_profile` VALUES (5,0,1,'download','download',0,0,0,'2',1,NULL,'2009-02-05 15:44:20','2009-02-05 15:44:20','');
INSERT INTO `conversion_profile` VALUES (100097,0,1,'wp_default','wp_default',0,0,0,'2',1,NULL,'2009-02-05 15:44:20','2009-02-05 15:44:20','');
INSERT INTO `conversion_profile` VALUES (99999,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `conversion_profile` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2009-05-05 10:23:27
-- MySQL dump 10.11
--
-- Host: localhost    Database: kaltura
-- ------------------------------------------------------
-- Server version	5.0.51a-3ubuntu5

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `entry`
--

DROP TABLE IF EXISTS `entry`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `entry` (
  `id` varchar(10) NOT NULL,
  `kshow_id` varchar(10) default NULL,
  `kuser_id` int(11) default NULL,
  `name` varchar(60) default NULL,
  `type` smallint(6) default NULL,
  `media_type` smallint(6) default NULL,
  `data` varchar(48) default NULL,
  `thumbnail` varchar(48) default NULL,
  `views` int(11) default '0',
  `votes` int(11) default '0',
  `comments` int(11) default '0',
  `favorites` int(11) default '0',
  `total_rank` int(11) default '0',
  `rank` int(11) default '0',
  `tags` text,
  `anonymous` tinyint(4) default NULL,
  `status` int(11) default NULL,
  `source` smallint(6) default NULL,
  `source_id` int(11) default NULL,
  `source_link` varchar(1024) default NULL,
  `license_type` smallint(6) default NULL,
  `credit` varchar(1024) default NULL,
  `length_in_msecs` int(11) default '0',
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `partner_id` int(11) default '0',
  `display_in_search` tinyint(4) default '1',
  `subp_id` int(11) default '0',
  `custom_data` text,
  `search_text` varchar(4096) default NULL,
  `screen_name` varchar(20) default NULL,
  `site_url` varchar(256) default NULL,
  `permissions` int(11) default NULL,
  `group_id` varchar(64) default NULL,
  `plays` int(11) default '0',
  `partner_data` varchar(4096) default NULL,
  `int_id` int(11) NOT NULL auto_increment,
  `indexed_custom_data_1` int(11) default NULL,
  `description` text,
  `media_date` datetime default NULL,
  `admin_tags` text,
  `moderation_status` int(11) default '2',
  `moderation_count` int(11) default '0',
  `modified_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `kshow_rank_index` (`kshow_id`,`rank`),
  KEY `kshow_views_index` (`kshow_id`,`views`),
  KEY `kshow_votes_index` (`kshow_id`,`votes`),
  KEY `kshow_created_index` (`kshow_id`,`created_at`),
  KEY `views_index` (`views`),
  KEY `votes_index` (`votes`),
  KEY `entry_FI_2` (`kuser_id`),
  KEY `partner_id_index` (`partner_id`,`id`),
  KEY `kshow_index` (`partner_id`,`kshow_id`,`subp_id`),
  KEY `kshow_index_2` (`partner_id`,`kshow_id`,`status`,`subp_id`),
  KEY `partner_created_at_index` (`partner_id`,`created_at`),
  KEY `partner_created_at_status_type_index` (`partner_id`,`created_at`,`status`,`type`),
  KEY `type_kuser_id_index` (`type`,`kuser_id`),
  KEY `created_index` (`created_at`),
  KEY `status_created_index` (`status`,`created_at`),
  KEY `type_status_created_index` (`type`,`status`,`created_at`),
  KEY `created_at_index` (`created_at`),
  KEY `partner_group_index` (`partner_id`,`group_id`),
  KEY `int_id_index` (`int_id`),
  KEY `partner_kuser_indexed_custom_data_index` (`partner_id`,`kuser_id`,`indexed_custom_data_1`),
  KEY `partner_status_index` (`partner_id`,`status`),
  KEY `partner_moderation_status` (`partner_id`,`moderation_status`),
  KEY `partner_modified_at_index` (`partner_id`,`modified_at`),
  KEY `partner_status_media_type_index` (`partner_id`,`status`,`media_type`),
  FULLTEXT KEY `search_text_index` (`search_text`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `entry`
--

LOCK TABLES `entry` WRITE;
/*!40000 ALTER TABLE `entry` DISABLE KEYS */;
INSERT INTO `entry` VALUES ('iiwkp77qfk','6w8769dx1e',3,'Demo Mix',2,6,'100004.xml','100000.jpg',0,0,0,0,0,0,'',NULL,2,NULL,NULL,NULL,NULL,NULL,27873,'2009-04-27 11:04:24','2009-04-27 19:04:34',1,0,100,'a:2:{s:11:\"editor_type\";s:21:\"kalturaAdvancedEditor\";s:7:\"puserId\";s:10:\"__ADMIN__1\";}',NULL,NULL,NULL,1,NULL,0,NULL,29,NULL,'Demo Description',NULL,'demo',2,0,'2009-04-27 19:04:34');
INSERT INTO `entry` VALUES ('vcnp8h76m8','6w8769dx1e',3,'Demo Movie 1',1,1,'100000.flv','100001.jpg',0,0,0,0,0,0,'',NULL,2,1,NULL,NULL,NULL,NULL,4780,'2009-04-27 11:04:24','2009-04-27 11:13:58',1,2,100,'a:4:{s:18:\"conversion_quality\";s:1:\"2\";s:7:\"puserId\";s:10:\"__ADMIN__1\";s:6:\"height\";s:3:\"480\";s:5:\"width\";s:3:\"640\";}','_KAL_NET_ _1_ |  Demo Movie 1 demo',NULL,NULL,1,NULL,0,'conversionQuality:2;',30,NULL,'Demo Description',NULL,'demo',6,0,'2009-04-27 11:04:24');
INSERT INTO `entry` VALUES ('1i5ojrn9ts','6w8769dx1e',3,'Demo Movie 2',1,1,'100000.flv','100001.jpg',0,0,0,0,0,0,'',NULL,2,1,NULL,NULL,NULL,NULL,4598,'2009-04-27 11:06:02','2009-04-27 11:13:55',1,2,100,'a:4:{s:18:\"conversion_quality\";s:1:\"2\";s:7:\"puserId\";s:10:\"__ADMIN__1\";s:6:\"height\";s:3:\"480\";s:5:\"width\";s:3:\"640\";}','_KAL_NET_ _1_ |  Demo Movie 2 demo',NULL,NULL,1,NULL,0,'conversionQuality:2;',31,NULL,'Demo Description',NULL,'demo',6,0,'2009-04-27 11:06:02');
INSERT INTO `entry` VALUES ('s8wuba1g1k','6w8769dx1e',3,'Demo Movie 3',1,1,'100000.flv','100001.jpg',0,0,0,0,0,0,'',NULL,2,1,NULL,NULL,NULL,NULL,6322,'2009-04-27 11:06:02','2009-04-27 11:13:51',1,2,100,'a:4:{s:18:\"conversion_quality\";s:1:\"2\";s:7:\"puserId\";s:10:\"__ADMIN__1\";s:6:\"height\";s:3:\"480\";s:5:\"width\";s:3:\"640\";}','_KAL_NET_ _1_ |  Demo Movie 3 demo',NULL,NULL,1,NULL,0,'conversionQuality:2;',32,NULL,'Demo Description',NULL,'demo',6,0,'2009-04-27 11:06:02');
INSERT INTO `entry` VALUES ('0hase81rrs','6w8769dx1e',3,'Demo Movie 4',1,1,'100000.flv','100001.jpg',0,0,0,0,0,0,'',NULL,2,1,NULL,NULL,NULL,NULL,5721,'2009-04-27 11:06:03','2009-04-27 11:13:48',1,2,100,'a:4:{s:18:\"conversion_quality\";s:1:\"2\";s:7:\"puserId\";s:10:\"__ADMIN__1\";s:6:\"height\";s:3:\"480\";s:5:\"width\";s:3:\"640\";}','_KAL_NET_ _1_ |  Demo Movie 4 demo',NULL,NULL,1,NULL,0,'conversionQuality:2;',33,NULL,'Demo Description',NULL,'demo',6,0,'2009-04-27 11:06:03');
INSERT INTO `entry` VALUES ('8pn4jk92bc','6w8769dx1e',3,'Demo Movie 5',1,1,'100000.flv','100001.jpg',0,0,0,0,0,0,'',NULL,2,1,NULL,NULL,NULL,NULL,6452,'2009-04-27 11:06:04','2009-04-27 11:13:45',1,2,100,'a:4:{s:18:\"conversion_quality\";s:1:\"2\";s:7:\"puserId\";s:10:\"__ADMIN__1\";s:6:\"height\";s:3:\"480\";s:5:\"width\";s:3:\"640\";}','_KAL_NET_ _1_ |  Demo Movie 5 demo',NULL,NULL,1,NULL,0,'conversionQuality:2;',34,NULL,'Demo Description',NULL,'demo',6,0,'2009-04-27 11:06:04');
INSERT INTO `entry` VALUES ('644igevrzs','-1',3,'Demo Playlist 1',5,10,'100001.xml',NULL,0,0,0,0,0,0,'',NULL,2,NULL,NULL,NULL,NULL,NULL,0,'2009-04-27 11:07:03','2009-04-27 11:13:15',1,2,100,'a:1:{s:7:\"puserId\";s:10:\"__ADMIN__1\";}','_KAL_NET_ _1_ |  Demo Playlist 1 ',NULL,NULL,1,NULL,0,NULL,35,NULL,'',NULL,'',2,0,'2009-04-27 11:07:03');
INSERT INTO `entry` VALUES ('8j12w5m41s','-1',3,'Demo Playlist 2',5,10,'100000.xml',NULL,0,0,0,0,0,0,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,0,'2009-04-27 11:13:06','2009-04-27 11:13:06',1,2,100,'a:1:{s:7:\"puserId\";s:10:\"__ADMIN__1\";}',NULL,NULL,NULL,NULL,NULL,0,NULL,36,NULL,NULL,NULL,NULL,2,0,'2009-04-27 11:13:06');
INSERT INTO `entry` VALUES ('xe7qqoj0gg','3djwiy65go',4,'Simple Editor Demo Mix',2,6,NULL,'100000.jpg',NULL,NULL,0,0,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,-1,NULL,27873,'2009-04-28 04:21:00','2009-04-28 04:21:48',1,0,100,'a:2:{s:11:\"editor_type\";i:1;s:7:\"puserId\";s:0:\"\";}',NULL,NULL,NULL,NULL,NULL,NULL,NULL,39,NULL,'Demo Description',NULL,'',2,0,'2009-04-28 04:21:48');
/*!40000 ALTER TABLE `entry` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2009-05-05 10:23:27
-- MySQL dump 10.11
--
-- Host: localhost    Database: kaltura
-- ------------------------------------------------------
-- Server version	5.0.51a-3ubuntu5

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `kshow`
--

DROP TABLE IF EXISTS `kshow`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `kshow` (
  `id` varchar(10) NOT NULL,
  `producer_id` int(11) default NULL,
  `episode_id` varchar(10) default NULL,
  `name` varchar(60) default NULL,
  `subdomain` varchar(30) default NULL,
  `description` text,
  `status` int(11) default '0',
  `type` int(11) default NULL,
  `media_type` int(11) default NULL,
  `format_type` int(11) default NULL,
  `language` int(11) default NULL,
  `start_date` date default NULL,
  `end_date` date default NULL,
  `skin` text,
  `thumbnail` varchar(48) default NULL,
  `show_entry_id` varchar(10) default NULL,
  `intro_id` varchar(10) default NULL,
  `views` int(11) default '0',
  `votes` int(11) default '0',
  `comments` int(11) default '0',
  `favorites` int(11) default '0',
  `rank` int(11) default '0',
  `entries` int(11) default '0',
  `contributors` int(11) default '0',
  `subscribers` int(11) default '0',
  `number_of_updates` int(11) default '0',
  `tags` text,
  `custom_data` text,
  `indexed_custom_data_1` int(11) default NULL,
  `indexed_custom_data_2` int(11) default NULL,
  `indexed_custom_data_3` varchar(256) default NULL,
  `reoccurence` int(11) default NULL,
  `license_type` int(11) default NULL,
  `length_in_msecs` int(11) default '0',
  `view_permissions` int(11) default NULL,
  `view_password` varchar(40) default NULL,
  `contrib_permissions` int(11) default NULL,
  `contrib_password` varchar(40) default NULL,
  `edit_permissions` int(11) default NULL,
  `edit_password` varchar(40) default NULL,
  `salt` varchar(32) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `partner_id` int(11) default '0',
  `display_in_search` tinyint(4) default '1',
  `subp_id` int(11) default '0',
  `search_text` varchar(4096) default NULL,
  `permissions` varchar(1024) default NULL,
  `group_id` varchar(64) default NULL,
  `plays` int(11) default '0',
  `partner_data` varchar(4096) default NULL,
  `int_id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`),
  KEY `views_index` (`views`),
  KEY `votes_index` (`votes`),
  KEY `created_at_index` (`created_at`),
  KEY `type_index` (`type`),
  KEY `kshow_FI_1` (`producer_id`),
  KEY `indexed_custom_data_1_index` (`indexed_custom_data_1`),
  KEY `indexed_custom_data_2_index` (`indexed_custom_data_2`),
  KEY `indexed_custom_data_3_index` (`indexed_custom_data_3`),
  KEY `partner_id_subp_index` (`partner_id`,`id`,`subp_id`),
  KEY `partner_created_at_indes` (`partner_id`,`created_at`),
  KEY `created_index` (`created_at`),
  KEY `producer_updated_index` (`producer_id`,`updated_at`),
  KEY `producer_updated_id_index` (`producer_id`,`updated_at`,`id`),
  KEY `partner_subp_entries_index` (`partner_id`,`subp_id`,`entries`),
  KEY `partner_group_index` (`partner_id`,`group_id`),
  KEY `int_id_index` (`int_id`),
  FULLTEXT KEY `search_text_index` (`search_text`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `kshow`
--

LOCK TABLES `kshow` WRITE;
/*!40000 ALTER TABLE `kshow` DISABLE KEYS */;
INSERT INTO `kshow` VALUES ('6w8769dx1e',3,NULL,'Movie 1',NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'iiwkp77qfk',NULL,0,0,0,0,0,5,0,0,4,NULL,'a:1:{s:14:\"allowQuickEdit\";b:1;}',NULL,NULL,NULL,NULL,NULL,27873,1,NULL,NULL,NULL,NULL,NULL,NULL,'2009-04-27 11:04:24','2009-04-27 19:04:34',1,2,100,'_KAL_NET_ _1_ |  Movie 1 CAT 0','1','3',0,NULL,5);
INSERT INTO `kshow` VALUES ('3djwiy65go',4,NULL,'DUMMY KSHOW FOR API V3',NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'xe7qqoj0gg',NULL,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,27873,1,NULL,NULL,NULL,NULL,NULL,NULL,'2009-04-28 04:21:00','2009-04-28 04:21:48',1,2,100,'_KAL_NET_ _1_ |  DUMMY KSHOW FOR API V3 CAT 0','1',NULL,0,NULL,6);
/*!40000 ALTER TABLE `kshow` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2009-05-05 10:23:27
-- MySQL dump 10.11
--
-- Host: localhost    Database: kaltura
-- ------------------------------------------------------
-- Server version	5.0.51a-3ubuntu5

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `kuser`
--

DROP TABLE IF EXISTS `kuser`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `kuser` (
  `id` int(11) NOT NULL auto_increment,
  `screen_name` varchar(20) default NULL,
  `full_name` varchar(40) default NULL,
  `email` varchar(50) default NULL,
  `sha1_password` varchar(40) default NULL,
  `salt` varchar(32) default NULL,
  `date_of_birth` date default NULL,
  `country` varchar(2) default NULL,
  `state` varchar(16) default NULL,
  `city` varchar(30) default NULL,
  `zip` varchar(10) default NULL,
  `url_list` varchar(256) default NULL,
  `picture` varchar(48) default NULL,
  `icon` tinyint(4) default NULL,
  `about_me` varchar(4096) default NULL,
  `tags` text,
  `tagline` varchar(256) default NULL,
  `network_highschool` varchar(30) default NULL,
  `network_college` varchar(30) default NULL,
  `network_other` varchar(30) default NULL,
  `mobile_num` varchar(16) default NULL,
  `mature_content` tinyint(4) default NULL,
  `gender` tinyint(4) default NULL,
  `registration_ip` int(11) default NULL,
  `registration_cookie` varchar(256) default NULL,
  `im_list` varchar(256) default NULL,
  `views` int(11) default '0',
  `fans` int(11) default '0',
  `entries` int(11) default '0',
  `produced_kshows` int(11) default '0',
  `status` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `partner_id` int(11) default '0',
  `display_in_search` tinyint(4) default '1',
  `search_text` varchar(4096) default NULL,
  `partner_data` varchar(4096) default NULL,
  PRIMARY KEY  (`id`),
  KEY `screen_name_index` (`screen_name`),
  KEY `full_name_index` (`full_name`),
  KEY `network_college_index` (`network_college`),
  KEY `network_highschool_index` (`network_highschool`),
  KEY `entries_index` (`entries`),
  KEY `views_index` (`views`),
  KEY `partner_id_index` (`partner_id`,`id`),
  KEY `partner_created_at_indes` (`partner_id`,`created_at`),
  KEY `created_index` (`created_at`),
  FULLTEXT KEY `search_text_index` (`search_text`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `kuser`
--

LOCK TABLES `kuser` WRITE;
/*!40000 ALTER TABLE `kuser` DISABLE KEYS */;
INSERT INTO `kuser` VALUES (1,'_1_USERID','_1_USERID',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,5,1,0,'2009-04-26 17:35:51','2009-04-26 17:38:25',1,0,NULL,NULL);
INSERT INTO `kuser` VALUES (2,'_1_','_1_',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,2,1,0,'2009-04-26 17:37:07','2009-04-26 17:37:09',1,0,NULL,NULL);
INSERT INTO `kuser` VALUES (3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,20,3,0,'2009-04-27 10:03:07','2009-04-27 11:06:04',1,0,NULL,NULL);
INSERT INTO `kuser` VALUES (4,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,0,'2009-04-28 04:20:59','2009-04-28 04:21:00',1,0,NULL,NULL);
/*!40000 ALTER TABLE `kuser` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2009-05-05 10:23:27
-- MySQL dump 10.11
--
-- Host: localhost    Database: kaltura
-- ------------------------------------------------------
-- Server version	5.0.51a-3ubuntu5

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `puser_kuser`
--

DROP TABLE IF EXISTS `puser_kuser`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `puser_kuser` (
  `id` int(11) NOT NULL auto_increment,
  `partner_id` int(11) default NULL,
  `puser_id` varchar(64) default NULL,
  `kuser_id` int(11) default NULL,
  `puser_name` varchar(64) default NULL,
  `custom_data` varchar(1024) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `context` varchar(1024) default '',
  `subp_id` int(11) default '0',
  PRIMARY KEY  (`id`),
  KEY `partner_puser_index` (`partner_id`,`puser_id`),
  KEY `kuser_id_index` (`kuser_id`),
  KEY `I_referenced_puser_role_FK_3_1` (`puser_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `puser_kuser`
--

LOCK TABLES `puser_kuser` WRITE;
/*!40000 ALTER TABLE `puser_kuser` DISABLE KEYS */;
INSERT INTO `puser_kuser` VALUES (1,1,'USERID',1,'_1_USERID',NULL,'2009-04-26 17:35:51','2009-04-26 17:35:51','',100);
INSERT INTO `puser_kuser` VALUES (2,1,NULL,2,'_1_',NULL,'2009-04-26 17:37:07','2009-04-26 17:37:07','',0);
INSERT INTO `puser_kuser` VALUES (3,1,'__ADMIN__1',3,NULL,NULL,'2009-04-27 10:03:07','2009-04-27 10:03:07','',100);
INSERT INTO `puser_kuser` VALUES (4,1,'',4,'',NULL,'2009-04-28 04:20:59','2009-04-28 04:20:59','',100);
/*!40000 ALTER TABLE `puser_kuser` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2009-05-05 10:23:27
