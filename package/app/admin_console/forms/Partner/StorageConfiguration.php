<?php 
class Form_Partner_StorageConfiguration extends Kaltura_Form
{
	public function init()
	{
		// Set the method for the display form to POST
		$this->setMethod('post');
		$this->setAttrib('id', 'frmStorageConfig');

		$this->addElement('text', 'name', array(
			'label' => 'Name:',
			'filters'		=> array('StringTrim'),
		));
		 
		$this->addElement('text', 'desciption', array(
			'label'			=> 'Desciption:',
			'filters'		=> array('StringTrim'),
		));
		 
		$this->addElement('select', 'protocol', array(
			'label'			=> 'Protocol:',
			'filters'		=> array('StringTrim'),
		));
		 
		$this->addElement('text', 'storageUrl', array(
			'label'			=> 'Storage URL:',
			'filters'		=> array('StringTrim'),
		));
		 
		$this->addElement('text', 'storageBaseDir', array(
			'label'			=> 'Storage Base Directory:',
			'filters'		=> array('StringTrim'),
		));
		 
		$this->addElement('text', 'storageUsername', array(
			'label'			=> 'Storage Username:',
			'filters'		=> array('StringTrim'),
		));
		 
		$this->addElement('text', 'storagePassword', array(
			'label'			=> 'Storage Password:',
			'filters'		=> array('StringTrim'),
		));
		 
		$this->addElement('checkbox', 'storageFtpPassiveMode', array(
			'label'			=> 'Storage FTP Passive Mode:',
			'filters'		=> array('StringTrim'),
		));
		 
		$this->addElement('text', 'deliveryHttpBaseUrl', array(
			'label'			=> 'Delivery HTTP Base URL:',
			'filters'		=> array('StringTrim'),
		));
		 
		$this->addElement('text', 'deliveryRmpBaseUrl', array(
			'label'			=> 'Delivery RTMP Base URL:',
			'filters'		=> array('StringTrim'),
		));
		 
		$this->addElement('text', 'deliveryIisBaseUrl', array(
			'label'			=> 'Delivery IIS Base URL:',
			'filters'		=> array('StringTrim'),
		));
		 
		$this->addElement('text', 'minFileSize', array(
			'label'			=> 'Minimum File Size:',
			'filters'		=> array('Digits'),
		));
		 
		$this->addElement('text', 'maxFileSize', array(
			'label'			=> 'Maximum File Size:',
			'filters'		=> array('Digits'),
		));
		 
		$this->addElement('select', 'pathManagerClass', array(
			'label'			=> 'Path Manager:',
			'filters'		=> array('StringTrim'),
		));
		 
		$this->addElement('select', 'urlManagerClass', array(
			'label'			=> 'URL Manager:',
			'filters'		=> array('StringTrim'),
		));
		 
		$this->addElement('select', 'trigger', array(
			'label'			=> 'Trigger:',
			'filters'		=> array('StringTrim'),
		));
	}
	
	public function setPartnerId($partnerId)
	{
		$this->addElement('hidden', 'partnerId', array(
			'value' => $partnerId
		));
	}
	
	public function addFlavorParamsFields(KalturaFlavorParamsListResponse $flavorParams, array $selectedFlavorParams = array())
	{
		foreach($flavorParams->objects as $index => $flavorParamsItem)
		{
			$checked = in_array($flavorParamsItem->id, $selectedFlavorParams);
			$this->addElement('checkbox', 'flavorParamsId_' . $flavorParamsItem->id, array(
				'label'			=> "Flavor Params $flavorParamsItem->name:",
				'checked'		=> $checked,
			));
		}
	}
}