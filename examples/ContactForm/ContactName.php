<?php

namespace Reform\Examples\ContactForm;

use Reform\Field\Input\Input;
use Reform\ValidationRule\MatchesValue;

class ContactName extends Input
{
	protected function _init()
	{
		$this->setAttributes(array(
			'name' => 'name',
			'id' => 'contact_name',
			'placeholder' => 'Please enter your name.',
		));

		$this->setLabel('Your Full Name:');

		// make sure it is Johnny
		$this->addRule(new MatchesValue('Johnny'));
	}
}