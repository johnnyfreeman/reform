<?php

namespace Reform\Examples\ContactForm;

use Reform\Field\Input\Email;
use Reform\ValidationRule\Required;

class ContactEmail extends Email
{
	protected function _init()
	{
		$this->setAttributes(array(
			'name' => 'email',
			'id' => 'contact_email',
			'placeholder' => 'Please enter your email address.',
		));

		$this->setLabel('Your Email Address:');

		$this->addRule(new Required());
	}
}