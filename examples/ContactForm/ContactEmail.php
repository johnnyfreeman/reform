<?php

namespace Reform\Examples\ContactForm;

use Reform\Field\Input\Email;

class ContactEmail extends Email
{
	protected function _init()
	{
		$this->setAttributes(array(
			'name' => 'email',
			'id' => 'contact_email_field',
			'placeholder' => 'Please enter your name.',
		));

		$this->addRule('required');

		if (!empty($_POST) && !$this->isValid())
		{
			$this->addClass('error');
		}

		return $this;
	}
}