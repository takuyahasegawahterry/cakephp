<h1>登録</h1>
<?php $options = array('1'=>'未読','2'=>'読みたい','3'=>'今読んでる','4'=>'読み終えた','5'=>'積読');?>
<?php $recom = array('1'=>'大変よい','2'=>'よい','3'=>'普通','4'=>'よくない','5'=>'大変よくない');?>
<?php print(
	$this->Form->create('Review').
	$this->Form->input('reading',array(
		'legend' => false,
		'type' => 'radio',
		'options' => $options
	)).
	 $this->Form->input('value',array(
		'legend' => false,
		'type' => 'radio',
		'options' => $recom
	)).
	$this->Form->end('登録')
	);
?>
