<?php $items['first'] = null;?>
<?php $items['hits'] = null;?>
<?php $items['count'] = null;?>
<?php $items['page']  = null;?>
<h2>本詳細ページ</h2>
<?php foreach ($items as $item):?>
<?php if(!empty($item)):?>
<p>
<?php echo $this->Html->image($item['LARGEIMAGEURL'],array('width'=>'150','height'=>'150','align'=>"left"));?>
<?php echo $item['TITLE']?>
<?php if(!empty($item['AUTHOR'])):?>
	<br>
	<?php echo $this->Html->link($item['AUTHOR'],'/books/author/'.$item['AUTHOR'])?>
<?php endif;?>
<?php if(!empty($item['PUBLISHERNAME'])):?>
	<br>
	<?php echo $item['PUBLISHERNAME'];?>
<?php endif;?>
<?php if(!empty($item['ITEMCAPTION'])):?>
         <br>
	 <?php echo $item['ITEMCAPTION'];?>
<?php endif;?>
<?php if(!empty($item['SALESDATE'])):?>
       <br>
       <?php echo $item['SALESDATE'];?>
<?php endif;?>
<?php if(!empty($item['ITEMPRICE'])):?>
	<?php echo " :".$item['ITEMPRICE']."円";?>
<?php endif;?>
</p>
<br clear ="left">
<?php endif;?>
<?php endforeach;?>
<?php if(!empty($tmpReviews)):?>
<?php foreach ($tmpReviews as $tmpReview):?>
<?php if(!empty($tmpReview['Review']['body'])):?>
<p>
<?php echo $this->Html->link($tmpReview['Review']['username'],'/users/mypage/'.$tmpReview['Review']['user_id']);?>
<?php if(!empty($tmpReview['Review']['value'])):?>
	<br>
	<?php switch ($tmpReview['Review']['value']):case 1:?>
		
			<?php echo "5:大変よい";?>
			<?php break;?>

		<?php case 2:?>
			<?php echo "4:良い";?>
			<?php break;?>
		<?php case 3:?>
			<?php echo "3:普通";?>
			<?php break;?>
		<?php case 4:?>
			<?php echo "2:良くない";?>
			<?php break;?>
		<?php case 5:?>
			<?php echo "1:大変良くない";?>
			<?php break;?>
	<?php endswitch;?>
<?php else:?>
	<?php echo "評価していません";?>
<?php endif;?>
<?php if(!empty($tmpReview['Review']['body'])):?>
	<br>
	<?php echo $tmpReview['Review']['body'];?>
<?php endif;?>
<?php endif;?>
</p>
<?php endforeach;?>
<?php endif;?>
<?php if($auth->loggedIn()):?>
	<?php if(!empty($tmp)):?>
		<?php if(empty($tmp['0']['Review']['body'])):?>
			<?php echo $this->Html->link('レビュー','/reviews/review/'.$tmpPost['Post']['id']);?>
		<?php endif;?>
	<?php else:?>
		<?php echo $this->Html->link('登録','/books/register/'.$tmpPost['Post']['isbn']);?>
	<?php endif;?>
<?php endif;?>
<br>
<?php echo  $this->Html->link('もっと見る:レビュー一覧','/reviews/allreviews');?>
