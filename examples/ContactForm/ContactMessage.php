<?php

namespace Reform\Examples\ContactForm;

use Reform\Field\Textarea;
use Reform\Exception\ValidationFailedException;

class ContactMessage extends Textarea
{
	protected function _init()
	{
		$this->setAttributes(array(
			'name' => 'message',
			'id' => 'contact_message',
			'placeholder' => 'Say what you need to say.',
		));

		$this->setLabel('Your message:');

		$this->addRule('required');
	}
}