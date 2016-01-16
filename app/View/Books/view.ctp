<?php $items['count'] = null;?>
<?php $items['page']  = null;?>
<?php $items['first'] = null;?>
<?php $items['hits'] = null;?>
<h2>本詳細</h2>
<?php foreach ($items as $item):?>
<?php if(!empty($item)):?>
<?php echo $this->Html->image($item['LARGEIMAGEURL'],array('width'=>'150','height'=>'150','align'=>"left"));?>
<?php echo $item['TITLE'];?>
<br>
<?php if(!empty($item['AUTHOR'])):?>
	<?php echo $this->Html->link($item['AUTHOR'],'/books/author/'.$item['AUTHOR']);?>
<?php endif;?>	
<br>
<?php echo $item['PUBLISHERNAME'];?>
<br>
<?php if(!empty($item['ITEMCAPTION'])):?>
	 <?php echo $item['ITEMCAPTION'];?>
<?php endif;?>
<br>
<?php if(!empty($item['SALESDATE'])):?>
	<?php echo $item['SALESDATE'];?>
<?php endif;?>
<?php echo $item['ITEMPRICE']."円";?>
</p>
<br clear ="left">
<?php endif;?>
<?php endforeach;?>
<br>
<?php if($auth->loggedIn()){
	if(!empty($tmpReview)){
		if(empty($tmpReview['Review']['body'])){
			echo $this->Html->link('レビュー','/posts/review/'.$tmpPost['Post']['id']);
		} 
	}else{
		echo $this->Html->link('登録','/books/register/'.$isbn);
	}
}
?>
