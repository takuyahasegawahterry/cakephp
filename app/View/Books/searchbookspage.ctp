<h2>本検索</h2>
<?php foreach ($items as $item):?>
<br>
<?php if(!empty($item)):?>
<?php echo $this->Html->image($item['LARGEIMAGEURL'],array('width'=>'150','height'=>'150','align'=>"left",'url'=>'/books/view/'.$item['ISBN']));?>
<?php echo $this->Html->link($item['TITLE'],'/books/view/'.$item['ISBN']);?>
<br>
<?php if(!empty($item['AUTHOR'])):?>
	<?php echo $this->Html->link($item['AUTHOR'],'/books/author/'.$item['AUTHOR']);?>
<?php endif;?>
<?php if(!empty($item['SALESDATE'])):?>
	<br>
	<?php echo $item['SALESDATE'];?>
<?php endif;?>
<?php endif;?>
<br clear="left">
<?php endforeach;?>
<?php echo "全".$count."件中/".$first."件から".$hits."件を表示" ;?>
<br>
<?php echo "現在".$page."ページ:全".$tmppage."ページ";?>
<br>
<?php $this->log($data['page'],'debug');?>
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
<br>
<?php 
$page = $page -2; 
if($page > 0){
	echo $this->Html->link($page,array('controller'=>'Books','action'=>'searchbookspage','title'=>$title,'author'=>$author,'page'=>$page));
	$page = $page +1;
	if($page > 0){
		echo $this->Html->link($page,array('controller'=>'Books','action'=>'searchbookspage','title'=>$title,'author'=>$author,'page'=>$page));
}
}else{
	$page = $data['page'];
	$page = $page -1 ;
	if($page > 0){
		echo $this->Html->link($page,array('controller'=>'Books','action'=>'searchbookspage','title'=>$title,'author'=>$author,'page'=>$page));
	}
}
?>
<?php $page = $data['page'];
	echo $page;
	if($tmppage >$page){
        	$page = $page +1;
		echo $this->Html->link($page,array('controller' =>'Books','action'=>'searchbookspage','title'=>$title,'author'=>$author,'page'=>$page));
		$page = $page + 1;
		if($tmppage >= $page){
	        echo $this->Html->link($page,array('controller' =>'Books','action'=>'searchbookspage','title'=>$title,'author'=>$author,'page'=>$page));
	}
	}
?>
