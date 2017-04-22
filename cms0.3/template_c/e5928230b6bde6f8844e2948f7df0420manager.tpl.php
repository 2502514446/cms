<!DOCTYPE html>
<html>
<head>
	<title><?php echo $this->configVar['webname']; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../style/admin.css" />
</head>
<body>

<?php include('./admin_top.php'); ?>
<?php include('./admin_sidebar.php'); ?>
<div id="main">

<div class="map">
	管理首页&nbsp;&frasl;&nbsp;管理员管理&nbsp;&frasl;&nbsp;<?php echo $this->tplVar['title']; ?>
</div>

<div class="list">
	<table cellspacing="0">
		<tr>
			<th>用户名</th>
			<th>等级</th>
			<th>登陆次数</th>
			<th>最近登陆ip</th>
			<th>最近登陆时间</th>
			<th>注册时间</th>
			<th>操作</th>
		</tr>
		<?php foreach($this->tplVar['html'] as $key=>$value) { ?>
		<tr>
			<td><?php echo $value->user ?></td>
			<td><?php echo $value->level ?></td>
			<td><?php echo $value->login_count ?></td>
			<td><?php echo $value->last_ip ?></td>
			<td><?php echo $value->last_time ?></td>
			<td><?php echo $value->reg_time ?></td>
			<td>
				<a href="###">修改</a>&nbsp;&#124;&nbsp;<a href="###">删除</a>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>


</div>
</body>
</html>
