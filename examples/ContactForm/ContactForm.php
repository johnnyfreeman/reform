<?php

namespace Reform\Examples\ContactForm;

use Reform\Element\Form;
use Reform\Examples\ContactForm\ContactName;
use Reform\Examples\ContactForm\ContactEmail;
use Reform\Examples\ContactForm\ContactMessage;
use Reform\Field\Input\Submit;

class ContactForm extends Form
{
	protected $_attributes = array(
		'action' => '',
		'id' => 'contact_form',
		'method' => 'post'
	);

	protected function _init()
	{
		return $this->append(array(
			new ContactName(), 
			new ContactEmail(), 
			new ContactMessage(), 
			new Submit('', 'Send Message')
		));
	}
}