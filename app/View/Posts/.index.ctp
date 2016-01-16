<h2>トップページ</h2>
<br>
<h2>登録した本一覧:１０件</h2>
<?php foreach ($posts as $post):?>
<p>
<?php echo $this->Html->image($post['Post']['thumbnail'],array('width'=>'150','height'=>'150','align'=>"left",'url'=>'/posts/view/'.$post['Post']['id']));?>
<br>
<?php echo $this->Html->link($post['Post']['title'],'/posts/view/'.$post['Post']['id']);?>
<?php if(!empty($post['Post']['author'])):?>
	<br>
	<?php echo $this->Html->link($post['Post']['author'],'/books/author/'.$post['Post']['author']);?>
<?php endif;?>
<?php if(!empty($post['Post']['salesdate'])):?>
	<br>
	<?php echo $post['Post']['salesdate'];?>
<?php endif;?>
<br clear ="left">
</p>
<br>
<br>
<?php endforeach;?>
<?php echo $this->Html->link('もっと見る:登録された本一覧ページ','/posts/allbooks');?>
<br>
<h2>レビュ一覧:１０件</h2>
<?php foreach($reviews as $review):?>
<?php debug($review);?>
<?php if(!empty($review['Review']['0']['body'])):?>
<br>
<p>
<?php echo $this->Html->image($review['Post']['thumbnail'],array('width'=>'150','height'=>'150','align'=>"left",'url'=>'/posts/view/'.$review['Post']['id']));?>
<?php echo $this->Html->link($review['Post']['title'],'/posts/view/'.$review['Post']['id']);?>
<br>
<?php echo $this->Html->link($review['Review']['0']['username'],'/users/mypage/'.$review['Review']['0']['user_id']);?>
<br>
<?php if(!empty($review['Review']['0']['value'])):?>
	<?php switch ($review['Review']['0']['value']):case 1:?>
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
<br>
<?php echo $review['Review']['0']['body'];?>
<br clear="left">
</p>
<?php endif;?>
<?php endforeach;?>
<br>
<?php echo  $this->Html->link('もっと見る:レビュー一覧','/reviews/allreviews');?>
