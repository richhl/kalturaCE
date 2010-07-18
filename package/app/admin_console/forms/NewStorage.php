<?php 
class Form_NewStorage extends Zend_Form
{
	public function init()
	{
		$this->setDecorators(array(
			'FormElements', 
			array('HtmlTag', array('tag' => 'fieldset')),
			array('Form', array('class' => 'simple')),
		));
		
		// search input
		$this->addElement('text', 'newPartnerId', array(
			'required' 		=> true,
			'label' 		=> 'Publisher ID:',
			'filters'		=> array('StringTrim'),
		));
		
		// submit button
		$this->addElement('button', 'newStorage', array(
			'label'		=> 'new storage',
			'onclick'		=> "doAction('newStorage', $('#newPartnerId').val())"
		));
	}
}