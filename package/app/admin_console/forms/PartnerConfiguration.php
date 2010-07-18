<?php 
class Form_PartnerConfiguration extends Kaltura_Form
{
	public function init()
	{
		// Set the method for the display form to POST
		$this->setMethod('post');

		$this->setDescription('partner-configure intro text');
		$this->loadDefaultDecorators();
		$this->addDecorator('Description', array('placement' => 'prepend'));

		$this->addElement('text', 'account_name', array(
			'label' => 'Publisher Name:',
			'decorators' 	=> array('Label', 'Description')
		));
		 
		$this->addElement('text', 'host', array(
			'label'			=> 'Publisher Specific Host:',
			'filters'		=> array('StringTrim'),
		));
		
		$this->addElement('text', 'cdn_host', array(
			'label'			=> 'Publisher Specific CDN Host:',
			'filters'		=> array('StringTrim'),
		));
		
		$this->addElement('text', 'max_bulk_size', array(
			'label'			=> 'Limit number of files in a single bulk upload action to:',
			'filters'		=> array('StringTrim'),
		));
		
		$this->addElement('select', 'partner_package', array(
			'label'			=> 'Usage Package:',
			'filters'		=> array('StringTrim'),
		));
	}
}