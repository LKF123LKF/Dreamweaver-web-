<?php
//声明文件解析的编码格式
header('content-type:text/html;charset=utf-8');
//var_dump($_GET);

require './public_function.php';
dbInit();

$where = '';

if(isset($_GET['keyword'])){

	$keyword =   $_GET['keyword'];

	$keyword = mysql_real_escape_string($keyword);

	$where = "where e_name like '%$keyword%'";
}
$fields=array('e_dept','date_of_entry');
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

//---------分页------------
//分页部分
$page=1;
$max_page=0;
$page_size=4;
//计算表中的记录数
$res=mysql_query('select count(*) from `emp_info`');
$counts=mysql_fetch_row($res);
$count=$counts[0];
var_dump($count);
//ceil向上取整
$max_page=ceil($count/$page_size);
$page=isset($_GET['page'])?intval($_GET['page']):1;
$page=$page>$max_page?$max_page:$page;
$page=$page<1?1:$page;
//组合html代码
$page_html="<a href='./showlist.php?page=1'>首页</a>&nbsp;";
$page_html.="<a href='./showlist.php?page=".(($page-1)>0?($page-1):1)."'>上一页</a>&nbsp;";
$page_html.="<a href='./showlist.php?page=".(($page+1)<$max_page?($page+1):$max_page)."'>下一页</a>&nbsp;";
$page_html.="<a href='./showlist.php?page=$max_page'>尾页</a>&nbsp;";

$lim=($page-1)*4;
$sql = "select * from emp_info {$where}{$sql_order} limit {$lim},{$page_size}";

var_dump($sql);
//---------------分页--------------

/*
//执行SQL语句，获取结果集
$res = mysql_query($sql);
if(!$res) die(mysql_error());

$emp_info = array();

while($row = mysql_fetch_array($res,MYSQL_NUM)){

	$emp_info[] = $row;
}
*/
$emp_info=fetchAll($sql);

//设置常量，用来判断视图页面是否由此页面加载
define('APP', 'itcast');
//加载视图页面，显示数据
require './list_html.php';