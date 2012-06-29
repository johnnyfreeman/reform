<?php

use Reform\FormBuilder;

// get a few variables
$name = $this->getAttribute('name');
$id = $this->getAttribute('id');
$label = $this->getLabel() == '' ? $name : $this->getLabel();

if (empty($id))
{
	$id = $name . '_field';
	$this->setAttribute('id', $id);
}

// build field's label
$output = FormBuilder::label($label)->setAttribute('for', $id);

// open tag
$output .= '<' . $this->getTagName();

// write in attributes
if (count($this->getAttributes()) > 0)
{
	$output .= ' ' . $this->attributesToString();
}

// self closing
if ($this->isSelfClosing())
{
	echo $output . ' />';
}

// not self closing
else
{
	$output .= '>';

	// print any child element this tag may have
	foreach ($this->getChildren() as $element)
	{
		$output .= $element;
	}

	// call her done
	$output .= '</' . $this->getTagName() . '>';

	echo $output;
}

// check for errors
if ($this->hasErrors())
{
	echo '<div class="error">' . $this->getError() . '</div>';
}