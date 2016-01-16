<h2>登録された本一覧</h2>
<?php for($i=0;$i<$count;$i++):?>
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
<?php echo $this->Html->link($users[$i]['Review']['username']."が登録しました",'/users/mypage/'.$users[$i]['Review']['user_id']);?>
<br clear="left">
</p>
<br>
<?php endfor;?>
<br>
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
