<?php
/**
 * @package api
 * @subpackage objects
 */
class KalturaBaseEntryArray extends KalturaTypedArray
{
	public static function fromEntryArray ( $arr )
	{
		$newArr = new KalturaBaseEntryArray();
		if ($arr == null)
			return $newArr;

		// FIXME - Object type check should not be here 
		foreach ($arr as $obj)
		{
    		switch($obj->getType())
    	    {
    	        case KalturaEntryType::MEDIA_CLIP:
    	            $nObj = new KalturaMediaEntry();
    	            break;
                case KalturaEntryType::MIX:
                    $nObj = new KalturaMixEntry();
    	            break;
                case KalturaEntryType::PLAYLIST:
                    $nObj = new KalturaPlaylist();
    	            break;
                default:
                    $nObj = new KalturaBaseEntry();
                    break;
    	    }
			$nObj->fromObject($obj);
			$newArr[] = $nObj;
		}
		
		return $newArr;
	}
		
	public function __construct()
	{
		parent::__construct("KalturaBaseEntry");	
	}
}