<h2>レビュー一覧</h2>
<?php for($i=0;$i<$count;$i++):?>
<?php echo $this->Html->image($posts[$i]['Post']['thumbnail'],array('width'=>'150','height'=>'150','align'=>"left",'url'=>'/posts/view/'.$posts[$i]['Post']['id']));?>
<?php echo $this->Html->link($posts[$i]['Post']['title'],'/posts/view/'.$posts[$i]['Post']['id']);?>
<?php if(!empty($posts[$i]['Post']['author'])):?>
	<br>
        <?php echo $this->Html->link($posts[$i]['Post']['author'],'/books/author/'.$posts[$i]['Post']['author']);?>
<?php endif;?>
<br>
<?php echo $this->Html->link($reviews[$i]['Review']['username'],'/users/mypage/'.$reviews[$i]['Review']['user_id']);?>

<?php if(!empty($reviews[$i]['Review']['value'])):?>
	<br>
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
<br>
<br>
<?php endfor;?>

<br>
<?php echo $this->Paginator->prev('前へ' .__(''),array(),null,array('class' =>'prev disabled'));?>
<?php echo $this->Paginator->counter(array(
        'format' =>__('{:page}/{:pages}ページを表示')
	        ));
		?>
		<?php echo $this->Paginator->next(__('') . '次へ',array(),null,array('class' =>'next disabled'));?>
		<br>
<?php echo $this->Paginator->numbers(array('separator' => ''));?>
<br>
<?php $start = 0;
if ($this->Paginator->params()["count"] >= 1) {
        $start = (($this->Paginator->params()["page"] - 1) * $this->Paginator->params()["limit"]) + 1;
}
	$end = $start + $this->Paginator->params()['limit'] - 1;
		if ($this->Paginator->params()["count"] < $end) {
			$end = $this->Paginator->params()["count"];
		}
echo "全".$this->Paginator->params()["count"]."件中".$start."件から".$end."件を表示";?>




