<?php

use Reform\Reform;

// get a few variables
$name = $this->get_attribute('name');
$id = $this->get_attribute('id');

if (empty($id))
{
	$id = $name . '_field';
	$this->set_attribute('id', $id);
}

// build field's label
$output = Reform::label($name)->set_attribute('for', $id);

// open tag
$output .= '<' . $this->get_tag_name();

// write in attributes
if (count($this->get_attributes()) > 0)
{
	$output .= ' ' . $this->attributes_to_string();
}

// self closing
if ($this->is_self_closing())
{
	echo $output . ' />';
}

// not self closing
else
{
	$output .= '>';

	// print any child element this tag may have
	foreach ($this->get_children() as $element)
	{
		$output .= $element;
	}

	// call her done
	$output .= '</' . $this->get_tag_name() . '>';

	echo $output;
}

// check for errors
if ($this->has_errors())
{
	echo '<div class="error">' . $this->get_error() . '</div>';
}