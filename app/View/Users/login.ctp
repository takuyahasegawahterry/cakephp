<h1>ログイン</h1>
<?php 	echo $this->Form->create('User');?>
<?php	echo $this->Form->input('email');
	echo $this->Form->input('password');?>
<?php	echo $this->Form->end('login');	?>

