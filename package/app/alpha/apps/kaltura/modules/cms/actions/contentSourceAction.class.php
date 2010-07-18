<?php

require_once ( "kalturaCmsAction.class.php" );

class contentSourceAction extends kalturaCmsAction
{
	public function executeImpl($partner_id) {
		$c = new Criteria();
		$c->addSelectColumn(entryPeer::SOURCE);
		$c->addSelectColumn("count(*)");
		$c->addGroupByColumn(entryPeer::SOURCE);
		$c->addAnd(entryPeer::PARTNER_ID, $partner_id); // just for caution
		entryPeer::getCriteriaFilter()->applyFilter($c);
		$rs = BasePeer::doSelect($c);
		
		$result = array();
		
		while ($rs->next()) 
		{
			$source = $rs->getInt(1);
			$num_of_entries = $rs->getInt(2);
			switch ($source)
			{
				case entry::ENTRY_MEDIA_SOURCE_FILE:
					$source_name = "File";
					break;
				case entry::ENTRY_MEDIA_SOURCE_WEBCAM:
					$source_name = "Webcam";
					break;
				case entry::ENTRY_MEDIA_SOURCE_FLICKR:
					$source_name = "Flickr";
					break;
				case entry::ENTRY_MEDIA_SOURCE_YOUTUBE:
					$source_name = "YouTube";
					break;
				case entry::ENTRY_MEDIA_SOURCE_URL:
					$source_name = "Url";
					break;
				case entry::ENTRY_MEDIA_SOURCE_TEXT:
					$source_name = "Text";
					break;
				case entry::ENTRY_MEDIA_SOURCE_MYSPACE:
					$source_name = "MySpace";
					break;
				case entry::ENTRY_MEDIA_SOURCE_PHOTOBUCKET:
					$source_name = "Photobucket";
					break;
				case entry::ENTRY_MEDIA_SOURCE_JAMENDO:
					$source_name = "Jamendo";
					break;
				case entry::ENTRY_MEDIA_SOURCE_CCMIXTER:
					$source_name = "CCMixter";
					break;
				case entry::ENTRY_MEDIA_SOURCE_NYPL:
					$source_name = "NYPL";
					break;
				case entry::ENTRY_MEDIA_SOURCE_CURRENT:
					$source_name = "Current";
					break;
				case entry::ENTRY_MEDIA_SOURCE_MEDIA_COMMONS:
					$source_name = "Commons";
					break;
				case entry::ENTRY_MEDIA_SOURCE_KALTURA:
					$source_name = "Kaltura";
					break;
				case entry::ENTRY_MEDIA_SOURCE_KALTURA_USER_CLIPS:
					$source_name = "Kaltura User Clips";
					break;	
				default:
					$source_name = "Unknown";
					break;
			}
			$obj["num_of_entries"] = $num_of_entries;
			$obj["source_name"] = $source_name;
			$result[] = $obj;
		}
		sfView::SUCCESS;
		
		$this->result = $result;
	}
}
?>