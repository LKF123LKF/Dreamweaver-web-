<?php
	header('Content-type:text/html;charset=utf-8');
	require './pubilc_function.php';
	dbInit();
	$sql='select * from `lkf`';
	$emp_info=fetchAll($sql);
	$link=mysql_connect('localhost','root','');
	if(!$link){
		die('连接数据库失败'.mysql_error());
	}
	mysql_query('set names utf8');
	mysql_query('use `itcast`');
	$fields=array('name','class');
	$sql_order='';
	$order=isset($_GET['order'])?$_GET['order']:'';
	$sort=isset($_GET['sort'])?$_GET['sort']:'';
	if(in_array($order,$fields)){
	    if($sort=='desc'){
	        $sql_order="order by $order desc";
	        $sort='asc';
	    }else{
	        $sql_order="order by $order asc";
	        $sort='desc';
	    }
	}
	$where='';
	if (isset($_GET['keyword'])) {
	    $keyword = $_GET['keyword'];
	    $keyword = mysql_real_escape_string($keyword);
	    $where = "where name like '%$keyword%'";
	}
	$page=1;
	$page_size=2;
	$res=mysql_query('select count(*) from `lkf`');
	$count=mysql_fetch_row($res);
	$count=$count[0];
	$max_page=ceil($count/$page_size);
	$page=isset($_GET['page'])?intval($_GET['page']):1;
	$page=$page>$max_page?$max_page:$page;
	$page=$page<1?1:$page;
	$page_html="<a href='./showList.php?page=1'>首页</a>&nbsp;";
	$page_html.="<a href='./showList.php?page=".(($page-1)>0?($page-1):1)."'>上一页</a>&nbsp;";
	$page_html.="<a href='./showList.php?page=".(($page+1)>$max_page?($page+1):$max_page)."'>下一页</a>&nbsp;";
	$page_html.="<a href='./showList.php?page=$max_page'>尾页</a>&nbsp;";
	$lim=($page-1)*2;
	$sql = "select * from `lkf` {$sql_order}{$where} limit {$lim},{$page_size}";
	var_dump($sql);
	$res = mysql_query($sql,$link);
	if(!$res)die(mysql_error());
	$lkf=array();
	while($row=mysql_fetch_assoc($res)){
		$lkf[]=$row;
	}
	define ('APP','itcast');
	require './list_html.php';

