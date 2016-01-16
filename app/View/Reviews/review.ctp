<h2>レビュ投稿</h2>
<p>
<?php echo $this->Html->image($post['Post']['thumbnail'],array('width'=>'150','height'=>'150','align'=>"left"),array('url'=>'/posts/view/'.$post['Post']['id']));?>
<?php echo $post['Post']['title'];?>
<?php if(!empty($post['Post']['author'])):?>
	<br>
	<?php echo $post['Post']['author'];?>
<?php endif;?>
<?php if(!empty($post['Post']['salesdate'])):?>
	<br>
	<?php echo $post['Post']['salesdate'];?>
<?php endif;?>
</p>
<br clear="left">
<br>
<?php echo $this->Form->create('Review',array('action'=>'review'));?>
<?php echo $this->Form->input('id',array('type'=>'hidden'));?>
<?php echo $this->Form->input('post_id',array('type'=>'hidden'));?>
<?php echo $this->Form->input('body',array('label'=>'レビューを入力してください'));?>
<?php echo $this->Form->end('submit');?>
		   
		  
		
