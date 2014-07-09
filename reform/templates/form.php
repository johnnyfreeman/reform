<?php if (!empty($_POST) && !$this->isValid()): ?>
<!-- error messages -->
<ul class="messeges">
	<?php foreach ($this->getErrors() as $error): ?>
		<li class="error message"><? echo $error; ?></li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>

<!-- form -->
<?php include('element.php'); ?>