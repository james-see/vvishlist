--
-- Table structure for table `bookmark_app`
--

CREATE TABLE `bookmark_app` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `hash` varchar(32) collate utf8_unicode_ci NOT NULL default '',
  `userid` int(10) unsigned default 1,
  `url` text collate utf8_unicode_ci NOT NULL,
  `title` text collate utf8_unicode_ci NOT NULL,
  `dt` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `hash` (`hash`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `users` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`usr` varchar(64) collate utf8_unicode_ci,
	`secr` char(128) collate utf8_unicode_ci,
	`website` varchar(100) collate utf8_unicode_ci,
	`twitter` varchar(24) collate utf8_unicode_ci,
	`created` timestamp NOT NULL default CURRENT_TIMESTAMP,
	PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
