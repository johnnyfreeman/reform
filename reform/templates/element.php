<?php

// open tag
$output = '<' . $this->getTagName();

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