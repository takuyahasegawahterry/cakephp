<h1>ログイン</h1>
<?php print(
	$this->Form->create('User').
	$this->Form->input('mail').
	$this->Form->input('password').
	$this->Form->end('ログイン')
	);
?>
