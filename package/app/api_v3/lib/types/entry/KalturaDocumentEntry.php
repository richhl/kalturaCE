<?php

class KalturaDocumentEntry extends KalturaBaseEntry
{
	/**
	 * The type of the document
	 *
	 * @var KalturaDocumentType
	 * @insertonly
	 * @filter eq,in
	 */
	public $documentType;
	
	private static $map_between_objects = array
	(
		"documentType" => "mediaType",
	);
	
	public function __construct()
	{
		$this->type = KalturaEntryType::DOCUMENT;
	}
	
	public function getMapBetweenObjects()
	{
		return array_merge(parent::getMapBetweenObjects(), self::$map_between_objects);
	}
}
