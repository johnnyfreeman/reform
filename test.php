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

use Reform\Reform;
Reform::registerAutoloader(); // faster than generic autoloaders


/**
 * EXAMPLE FORM
 */

$form = Reform::form(array('id'=>'my_form'));

Reform::input('name')->addRule('required')->appendTo($form)->setAttribute('id', 'name');
Reform::email('email')->addRule('required')->appendTo($form);
$password1 = Reform::password('password1')->addRule('required')->appendTo($form);
Reform::password('password2')->addRule('matches_field', $password1)->appendTo($form);
$account_type = Reform::select('account_type')->appendTo($form);
Reform::option('foo')->appendTo($account_type);
Reform::option('foo1')->appendTo($account_type);
Reform::option('bar', 'foo')->appendTo($account_type);
Reform::option('foo2')->appendTo($account_type);
Reform::submit('', 'Sign up')->appendTo($form);

//echo '<pre>'; print_r($form); echo '</pre>'; die();

if (!empty($_POST))
{
	if ($form->isValid())
	{
		// do something
		echo 'email sent!';
	}
	else
	{
		echo 'not valid!!!';
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