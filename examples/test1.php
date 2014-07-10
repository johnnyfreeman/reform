<?php

/**
 * TURN ON ERROR REPORTING
 */
error_reporting(E_ALL);
ini_set('display_errors', '1');

/**
 * Get Reform's class loader
 */
require_once('../reform/ClassLoader.php');
Reform\ClassLoader::register(); // faster than generic autoloaders

use Reform\Reform;
use Reform\ValidationRule\Required;
use Reform\ValidationRule\MatchesField;

/**
 * EXAMPLE FORM
 */

$form = Reform::form('')->append(array(
	Reform::input('name')->setAttribute('id', 'name')->addRule(new Required),
	Reform::email('email')->addRule(new Required),
	$password1 = Reform::password('password1')->addRule(new Required),
	Reform::password('password2')->addRule(new MatchesField($password1)),
	Reform::select('account_type')->append(array(
		Reform::option('foo'),
		Reform::option('foo1'),
		Reform::option('bar', 'foo'),
		Reform::option('foo2'),
	)),
	Reform::submit('', 'Sign up')
));

//$form = Reform::form(array('id'=>'my_form'));


//echo '<pre>'; print_r($form); echo '</pre>'; die();

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