<?php $items['count'] = null;?>
<?php $items['page'] = null;?>
<h2>本検索</h2>
<?php foreach ($items as $item):?> 
<?php if(!empty($item)):?>
<p>
<?php echo $this->Html->image($item['LARGEIMAGEURL'],array('width'=>'150','height'=>'150','align'=>"left",'url'=>'/books/view/'.$item['ISBN']));?>
<?php echo $this->Html->link($item['TITLE'],'/books/view/'.$item['ISBN']);?>
<?php if(!empty($item['SALESDATE'])):?>
	<br>
	<?php echo $item['SALESDATE'];?>
<?php endif;?>
<?php endif;?>
<br clear="left">
<?php endforeach;?>
<?php  echo "全".$count."件中/".$first."件から".$hits."件を表示" ;?>
<br>
<?php echo "現在".$page."ページ:全".$tmppage."ページ";?>
<br>
<?php if($data['page'] > 1){
$tmpback = $data['page'] -1;
if(!empty($data['title'])){
	 $title = $data['title'];
}else {
	$title = null;
}
if(!empty($data['author'])){
	$author = $data['author'];
}else{
	$author = null;
}
echo $this->Html->link("前のページへ",
	array('controller' => 'Books','action' =>'searchbookspage','title'=>$title,'author'=>$author,'page'=>$tmpback));
}
?>
<?php $res = $count-$page*25;
if($res > 0){
	$tmpnext = $data['page'] +1;
if(!empty($data['title'])){
	$title = $data['title'];
}else {
	$title = null;
}
if(!empty($data['author'])){
	$author = $data['author'];
}else{
	$author = null;
}
echo $this->Html->link("次のページへ",
	array('controller' => 'Books','action' =>'searchbookspage','title'=>$title,'author'=>$author,'page'=>$tmpnext));
}?>
<?php
if($tmppage > $page){
        $tmp = $page + 1;
	if(!empty($data['title'])){
		$title = $data['title'];
	}else {
		$title = null;
	}
	if(!empty($data['author'])){
		$author = $data['author'];
	}else{
		$author = null;
	}
	echo $this->Html->link("次へ",
		array('controller' => 'Books','action' =>'searchbookspage','title'=>$title,'author'=>$author,'page'=>$tmp));
	}
	?>
	<br>
	<?php echo $page;
	if($tmppage > $page){
		$tmp = $page ;
		$tmp +=1;
		echo $this->Html->link($tmp,array('controller' =>'Books','action'=>'searchbookspage','title'=>$title,'author'=>$author,'page'=>$tmp));
	if($tmppage > $tmp){
		$tmp = $tmp +1;
		echo $this->Html->link($tmp,array('controller' =>'Books','action'=>'searchbookspage','title'=>$title,'author'=>$author,'page'=>$tmp));
	}
	}
	?>
