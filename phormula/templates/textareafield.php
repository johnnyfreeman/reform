<?php

$name = $this->get_attribute('name');
$id = $this->get_attribute('name') . '_field';
$value = $this->get_value();

?><div class="row">
	<label for="<?php echo $id; ?>"><?php echo $name; ?></label>

	<br />

	<textarea id="<?php echo $id; ?>" name="<?php echo $name; ?>"><?php echo $value; ?></textarea>
	
	<?php if ($this->has_errors()): ?>
	
		<ul class="errors">

			<?php foreach ($this->get_errors() as $error): ?>
				<li><?php echo $error; ?></li>
			<?php endforeach ?>

		</ul>

	<?php endif; ?>
</div>