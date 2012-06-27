<?php

namespace Reform\Examples\ContactForm;

use Reform\Field\Input\Email;

class ContactEmail extends Email
{
	protected $_attributes = array(
		'name' => 'email',
		'id' => 'contact_email_field',
		'placeholder' => 'Please enter your name.',
		'type' => 'text',
		'value' => ''
	);

	public function build()
	{
		return $this->addRule('required');
	}
}