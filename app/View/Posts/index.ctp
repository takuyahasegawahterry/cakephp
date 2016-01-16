<h2>トップページ</h2>
<br>
<h2>登録した本一覧:１０件</h2>
<?php for ($i =0;$i<10;$i++):?>
<p>
<?php echo $this->Html->image($posts[$i]['Post']['thumbnail'],array('width'=>'150','height'=>'150','align'=>"left",'url'=>'/posts/view/'.$posts[$i]['Post']['id']));?>
<br>
<?php echo $this->Html->link($posts[$i]['Post']['title'],'/posts/view/'.$posts[$i]['Post']['id']);?>
<?php if(!empty($posts[$i]['Post']['author'])):?>
	<br>
	<?php echo $this->Html->link($posts[$i]['Post']['author'],'/books/author/'.$posts[$i]['Post']['author']);?>
<?php endif;?>
<?php if(!empty($posts[$i]['Post']['salesdate'])):?>
	<br>
	<?php echo $posts[$i]['Post']['salesdate'];?>
<?php endif;?>
<br>
<?php echo $this->Html->link($users[$i]['Review']['username']."が登録しました",'/users/mypage/'.$users[$i]['Review']['user_id']);?>
<br clear ="left">
</p>
<br>
<br>
<?php endfor;?>
<?php echo $this->Html->link('もっと見る:登録された本一覧ページ','/posts/allbooks');?>
<br>
<h2>レビュ一覧:１０件</h2>
<?php for($i=0;$i<10;$i++):?>
<p>
<?php echo $this->Html->image($tmpposts[$i]['Post']['thumbnail'],array('width'=>'150','height'=>'150','align'=>"left",'url'=>'/posts/view/'.$tmpposts[$i]['Post']['id']));?>
<?php echo $this->Html->link($tmpposts[$i]['Post']['title'],'/posts/view/'.$tmpposts[$i]['Post']['id']);?>
<br>
<?php echo $this->Html->link($reviews[$i]['Review']['username'],'/users/mypage/'.$reviews[$i]['Review']['user_id']);?>
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
<br clear="left">
</p>
<?php endfor;?>
<br>
<?php echo  $this->Html->link('もっと見る:レビュー一覧','/reviews/allreviews');?>
