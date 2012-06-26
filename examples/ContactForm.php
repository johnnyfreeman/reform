<?php

use Reform\Element\Form;
use Reform\Field\Input\Input;
use Reform\Field\Input\Email;
use Reform\Field\Input\Submit;
use Reform\Field\Textarea;
use Reform\Field\Select;
use Reform\Reform;

class AccountType extends Select
{
	protected $_attributes = array(
			'name' => 'account_type',
			'id' => 'account_type'
		);

	public function __construct()
	{
		$options[] = Reform::option('New');
		$options[] = Reform::option('Existing');

		parent::__construct(array(), $options);
	}
}

class ContactForm extends Form
{
	protected $_attributes = array(
			'action' => '',
			'id' 	 => 'contact_form',
			'method' => 'post'
		);

	public function build()
	{
		$name = new Input('name');
		$name->id = 'name';
		$name->appendTo($this);

		$email = new Email('email');
		$email->addRule('required');
		$email->appendTo($this);

		$accttype = new AccountType();
		$accttype->addRule('required');
		$accttype->appendTo($this);

		$message = new Textarea('message');
		$message->addRule('required');
		$message->appendTo($this);

		$this->append(new Submit('', 'Send Message'));

		return $this;
	}
}