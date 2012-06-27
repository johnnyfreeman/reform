<?php

namespace Reform\Examples\ContactForm;

use Reform\Element\Form;
use Reform\Field\Input\Submit;

class ContactForm extends Form
{
	protected $_attributes = array(
		'action' => '',
		'id' => 'contact_form',
		'method' => 'post'
	);

	public function build()
	{
		return $this->append(array(
			new ContactName(),
			new ContactEmail(),
			new ContactMessage(),
			new Submit('', 'Send Message')
		));
	}
}