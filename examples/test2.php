<?php

/**
 * TURN ON ERROR REPORTING
 */
error_reporting(E_ALL);
ini_set('display_errors', '1');


/**
 * Register Reform's class loader
 */
require_once('../Reform/ClassLoader.php');
Reform\ClassLoader::register();


// load our contact form
use Reform\Examples\ContactForm\ContactForm;

?><style>
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

	.errors {
		list-style: none;
		margin-top: 0;
		padding: 0;
	}

	.error {
		background-color: #ffeded;
		color: #c80000;
		padding: 10px;
		margin-top: 5px;
	}

</style>

<?php echo new ContactForm(); ?> 