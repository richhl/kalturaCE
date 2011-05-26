<?php


/**
 * Skeleton subclass for representing a row from the 'search_entry' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package plugins.contentDistribution
 * @subpackage model
 */
class SearchEntry extends BaseSearchEntry implements IMySqlSearchObject
{
	/* (non-PHPdoc)
	 * @see BaseSearchEntry::setCategories()
	 */
	public function setCategories($v)
	{
		if($v)
		{
			$arr = explode(',', $v);
			$v = '_' . implode('_,_', $arr) . '_';
		}
		parent::setCategories($v);
	}

	/* (non-PHPdoc)
	 * @see BaseSearchEntry::setFlavorParams()
	 */
	public function setFlavorParams($v)
	{
		if($v)
		{
			$arr = explode(',', $v);
			$v = '_' . implode('_,_', $arr) . '_';
		}
		parent::setFlavorParams($v);
	}

} // SearchEntry
