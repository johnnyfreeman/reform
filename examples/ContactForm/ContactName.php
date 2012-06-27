<?php

namespace Reform\Examples\ContactForm;

use Reform\Field\Input\Input;

class ContactName extends Input
{
	protected function _init()
	{
		$this->setAttributes(array(
			'name' => 'name',
			'id' => 'contact_name',
			'placeholder' => 'Please enter your name.',
		));

		$this->addRule('required');
	}
}