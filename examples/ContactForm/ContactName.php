<?php

namespace Reform\Examples\ContactForm;

use Reform\Field\Input\Input;

class ContactName extends Input
{
	protected $_attributes = array(
		'name' => 'name',
		'id' => 'contact_name',
		'placeholder' => 'Please enter your name.',
		'type' => 'text',
		'value' => ''
	);

	public function build()
	{
		return $this->addRule('required');
	}
}