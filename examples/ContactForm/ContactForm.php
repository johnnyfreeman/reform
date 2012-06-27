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

	public function build()
	{
		$name = new ContactName('name');
		$name->build();

		$email = new ContactEmail('email');
		$email->build();

		$message = new ContactMessage('message');
		$message->build();

		return $this->append(array($name, $email, $message, new Submit('', 'Send Message')));
	}
}