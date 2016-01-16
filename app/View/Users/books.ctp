<h2><?php echo $user['User']['username'];?>が登録した本一覧</h2>
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
<?php endforeach;?>
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
