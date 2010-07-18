<?php
/**
 * @package api
 * @subpackage enum
 */
class KalturaStatsEventType extends KalturaEnum
{
	const WIDGET_LOADED = 1;
	const MEDIA_LOADED = 2;
	const PLAY = 3;
	const PLAY_REACHED_25 = 4;
	const PLAY_REACHED_50 = 5;
	const PLAY_REACHED_75 = 6;
	const PLAY_REACHED_100 = 7;
	const OPEN_EDIT = 8;
	const OPEN_VIRAL = 9;
	const OPEN_DOWNLOAD = 10;
	const OPEN_REPORT = 11;
	const BUFFER_START = 12;
	const BUFFER_END = 13;
	const OPEN_FULL_SCREEN = 14;
	const CLOSE_FULL_SCREEN = 15;
	const REPLAY = 16;	
	const SEEK = 17;
	const OPEN_UPLOAD = 18;
	const SAVE_PUBLISH = 19;
	const CLOSE_EDITOR = 20;
	const PRE_BUMPER_PLAYED  = 21;
	const POST_BUMPER_PLAYED  = 22;
	const BUMPER_CLICKED = 23;
	
/**
 * Decide on how to use future use
 *
 */	
	const FUTURE_USE_1 = 24;
	const FUTURE_USE_2 = 25;
	const FUTURE_USE_3 = 26;
}
?>