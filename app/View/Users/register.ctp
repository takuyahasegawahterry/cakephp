<h1>登録</h1>
<?php print(
	$this->Form->create('User').
        $this->Form->input('username').
        $this->Form->input('password').
        $this->Form->input('mail').
        $this->Form->end('登録')
        );
?>
