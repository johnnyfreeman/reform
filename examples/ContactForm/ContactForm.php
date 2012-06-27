<?php

namespace Reform\Examples\ContactForm;

use Reform\Element\Form;
use Reform\Examples\ContactForm\ContactName;
use Reform\Examples\ContactForm\ContactEmail;
use Reform\Examples\ContactForm\ContactMessage;
use Reform\Field\Input\Submit;

class ContactForm extends Form
{
	protected function _init()
	{
		$this->append(array(
			new ContactName(), 
			new ContactEmail(), 
			new ContactMessage(), 
			new Submit('', 'Send Message')
		));

		if (!empty($_POST) && $this->isValid())
		{
			echo '<div class="success">email sent!</div>';
		}
	}
}