<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once('phormula/phormula.php');

$form = new Form('');

$txt = TextAreaField::create('comment')->append_to($form);

$submit = SubmitField::create('submit')->append_to($form);

// $form->append(array($txt, $submit));

$txt->add_rule('matches_value', 'something')->add_rule('required');

if (!empty($_POST))
{
	$form->validate();
}

echo $form;