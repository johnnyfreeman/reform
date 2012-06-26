<?php

$name = $this->getAttribute('name');
$id = $this->getAttribute('name') . '_field';
$value = $this->getValue();

?>

<div class="row">
	<label for="<?php echo $id; ?>"><?php echo $name; ?></label>

	<br />

	<textarea id="<?php echo $id; ?>" name="<?php echo $name; ?>"><?php echo $value; ?></textarea>

	<?php if ($this->hasErrors()): ?>
	
		<ul class="errors">

			<?php foreach ($this->getErrors() as $error): ?>
				<li><?php echo $error; ?></li>
			<?php endforeach; ?>

		</ul>

	<?php endif; ?>
</div>