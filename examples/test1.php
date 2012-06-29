<?php

/**
 * TURN ON ERROR REPORTING
 */
error_reporting(E_ALL);
ini_set('display_errors', '1');

/**
 * Get Reform's class loader
 */
require_once('../Reform/ClassLoader.php');
Reform\ClassLoader::register(); // faster than generic autoloaders

use Reform\FormBuilder;
use Reform\ValidationRule\Required;
use Reform\ValidationRule\MatchesField;

/**
 * EXAMPLE FORM
 */

$form = FormBuilder::form('');

$form->append(array(
	FormBuilder::input('name'),
	FormBuilder::email('email'),
));

//$form = FormBuilder::form(array('id'=>'my_form'));

FormBuilder::input('name')->addRule(new Required)->appendTo($form)->setAttribute('id', 'name');
FormBuilder::email('email')->addRule(new Required)->appendTo($form);
$password1 = FormBuilder::password('password1')->addRule(new Required)->appendTo($form);
FormBuilder::password('password2')->addRule(new MatchesField($password1))->appendTo($form);
$account_type = FormBuilder::select('account_type')->appendTo($form);
FormBuilder::option('foo')->appendTo($account_type);
FormBuilder::option('foo1')->appendTo($account_type);
FormBuilder::option('bar', 'foo')->appendTo($account_type);
FormBuilder::option('foo2')->appendTo($account_type);
FormBuilder::submit('', 'Sign up')->appendTo($form);

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