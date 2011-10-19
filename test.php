<?php

/**
 * TURN ON ERROR REPORTING
 */
error_reporting(E_ALL);
ini_set('display_errors', '1');

/**
 * STRAP ON REFORM
 */
require_once('reform/reform.php');


/**
 * EXAMPLE FORM
 */
$form = Form::create('')->set_attribute('id', 'my_form');

Input::create('name')->add_rule('required')->append_to($form)->set_attribute('id', 'name');

Email::create('email')->add_rule('required')->append_to($form);

$password = Password::create('password')->append_to($form);

Password::create('password_conf')->add_rule('matches_field', $password)->append_to($form);

Select::create('account_type')->append_to($form)->append(new Option('foo'))->append(new Option('foo1'))->append(new Option('foo2'))->append($option = Option::create('bar', 'foo')->set_attribute('id','my_option'))->set_attribute('id','my_select')->append(new Option('foo'));

Submit::create('', 'Sign up')->append_to($form);

if (!empty($_POST))
{
	if ($form->validate())
	{
		// do something
		echo 'email sent!';
	}
}

?>
<style>
	body {
		color: #444;
		font: 14px Arial;
	}
	form {
		width: 250px;
	}

	label {
		display: block;
	    margin-top: 10px;
	}

	label: first-child {
	    margin-top: 0;
	}

	input[type=text], input[type=email], input[type=password], textarea {
		border-color: #999999 #AAAAAA #BBBBBB;
	    border-style: solid;
	    border-width: 1px;
	    box-shadow: 0 0 3px rgba(0, 0, 0, 0.05) inset, 0 2px 3px -3px rgba(0, 0, 0, 0.2) inset;
	    padding: 6px 8px;
	    width: 100%;
	}

	.error {
		background-color: #ffeded;
		color: #c80000;
		padding: 5px;
		margin-top: 5px;
	}

</style>

<?php echo $form; ?> 