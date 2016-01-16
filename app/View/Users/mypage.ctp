<h2><?php echo $user['User']['username'];?>さんのページ</h2>
<br>
<?php if(!empty($posts)):?>
<h2><?php echo $user['User']['username'];?>さんが登録した本</h2>
<?php foreach ($posts as $post):?>
<p>
<?php echo $this->Html->image($post['Post']['thumbnail'],array('width'=>'150','height'=>'150','align'=>"left",'url'=>'/posts/view/'.$post['Post']['id']));?>
<?php echo $this->Html->link($post['Post']['title'],'/posts/view/'.$post['Post']['id']);?>
<?php if(!empty($post['Post']['author'])):?>
	<br>
	<?php echo $this->Html->link($post['Post']['author'],'/books/author/'.$post['Post']['author']);?>
<?php endif;?>
<?php if(!empty($post['Post']['salesdate'])):?>
	<br>
	<?php echo $post['Post']['salesdate'];?>
<?php endif;?>
<br clear="left">
</p>
<br>
<?php endforeach;?>
<br>
<?php echo $this->Html->link('もっと見る:'.$user['User']['username'].'さんが登録した本一覧ページ','/users/books/'.$user['User']['id']);?>
<?php else:?>
<h2><?php echo $user['User']['username'];?>さんはまだ本を登録していません</h2>
<?php endif;?>
<br>
<br>
<?php if(!empty($reviews)):?>
	<h2><?php echo $user['User']['username'];?>さんのレビュー</h2>
	<?php for($i=0;$i<$count;$i++):?>
		<br>
		<?php echo $this->Html->image($posts[$i]['Post']['thumbnail'],array('width'=>'150','height'=>'150','align'=>"left",'url'=>'/posts/view/'.$posts[$i]['Post']['id']));?>
		<?php echo $this->Html->link($posts[$i]['Post']['title'],'/posts/view/'.$posts[$i]['Post']['id']);?>
		<?php if(!empty($posts[$i]['Post']['author'])):?>
		<br>
			<?php echo $this->Html->link($posts[$i]['Post']['author'],'/books/author/'.$posts[$i]['Post']['author']);?>
		<?php endif;?>
		<br>
		<?php if(!empty($reviews[$i]['Review']['value'])):?>
			<?php switch ($reviews[$i]['Review']['value']):case 1:?>
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
		<?php echo $reviews[$i]['Review']['body'];?>
		<br>
		<br clear="left">
		</p>
	<?php endfor;?>
<?php else:?>
<h2><?php echo $user['User']['username'];?>はまだレビューを書いていません</h2>
<?php endif;?>
<br>
<?php if(!empty($reviews)):?>
	<?php echo  $this->Html->link('もっと見る:'.$user['User']['username'].'さんのレビュー一覧','/users/reviews/'.$user['User']['id']);?>
<?php endif;?>
