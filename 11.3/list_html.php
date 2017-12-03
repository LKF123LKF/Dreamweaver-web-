<?php if(!defined('APP')) die('error!');?>
<!doctype html>
<html>
 <head>
  <meta charset="utf-8">
  <title>员工信息列表</title>
  <style>
	.box{margin:20px;}
	.box .title{font-size:22px;font-weight:bold;text-align:center;}
	.box table{width:100%;margin-top:15px;border-collapse:collapse;font-size:12px;border:1px solid #B5D6E6;min-width:460px;}
	.box table th,.box table td{height:20px;border:1px solid #B5D6E6;}
	.box table th{background-color:#E8F6FC;font-weight:normal;}
	.box table td{text-align:center;}
	.search{float:right;font-size:12px;margin:20px;}
	.page{float:right;font-size:12px;margin:10px;}
	
	/*------------添加员工的样式-------------*/
	.add{float:right;font-size:12px;margin:10px;clear:both}
	
  </style>
</head>
<body>
	<div class="box">
		<div class="title">员工信息列表</div>
		<form id="form1" name="form1" method="get" action="./showList.php">
		<div class="search">
  			<label for="textfield">请输入查询内容</label>
  			<input type="text" name="keyword" id="keyword" />
  			<input type="submit" name="button" id="button" value="提交" />
  		</div>
		</form>
		<table border="1">
			<tr>
				<th width="5%">ID</th>
				<th>姓名</th>
				<th><a href="./showlist.php?order=date_of_entry&sort=<?php echo($order=='date_of_entry') ? $sort:'desc';?>">所属部门</a></th>
				</th><th>出生日期</th>
				<th><a href="./showlist.php?order=date_of_entry&sort=<?php echo($order=='date_of_entry') ? $sort:'desc';?>">入职时间</a></th>
				<th width="25%">相关操作</th>
			</tr>
			<?php  if(!empty($emp_info)) { ?>
			<?php foreach($emp_info as $row){ ?>
			<tr>
				 <td><?php echo $row[0]; ?></td>
				 <td><?php echo $row[1]; ?></td>
				 <td><?php echo $row[2]; ?></td>
				 <td><?php echo $row[3]; ?></td>
				 <td><?php echo $row[4]; ?></td>
				 <td><div align="center"><span><img src="images/edt.gif" width="16" height="16" /><a href="<?php echo './empUpdate.php?e_id='.$row[0]; ?>">编辑</a>&nbsp; 
				 &nbsp;<img src="images/del.gif" width="16" height="16" />删除</span></div></td>
			</tr>
			<?php } ?>
			<?php  }else{   ?>
					<tr><td colspan="6">暂无员工数据！</td></tr>
			<?php } ?>
		</table>
	<div class="page"><?php echo $page_html?></div>
	
	<div class="add"><a href='./empAdd.php' >添加员工</a></div> 
	</div>
</body>
</html>