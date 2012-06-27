<?php

namespace Reform\Examples\ContactForm;

use Reform\Field\Textarea;
use Reform\Exception\ValidationFailedException;

class ContactMessage extends Textarea
{
	protected $_attributes = array(
		'name' => '',
		'style' => 'width: 400px;height: 150px;'
	);

	public function init()
	{
		$this->addRule('required');

		// if form is submitted and this field isn't valid...
		if (!empty($_POST) && !$this->isValid())
		{
			$this->addClass('error');
		}
		
		return $this;
	}
}