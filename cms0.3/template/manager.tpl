<!DOCTYPE html>
<html>
<head>
	<title><!--{webname}--></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../style/admin.css" />
</head>
<body>

{include "./admin_top.php"}
{include "./admin_sidebar.php"}
<div id="main">

<div class="map">
	管理首页&nbsp;&frasl;&nbsp;管理员管理&nbsp;&frasl;&nbsp;{$title}
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
		{foreach $html(key, value)}
		<tr>
			<td>{@value->user}</td>
			<td>{@value->level}</td>
			<td>{@value->login_count}</td>
			<td>{@value->last_ip}</td>
			<td>{@value->last_time}</td>
			<td>{@value->reg_time}</td>
			<td>
				<a href="###">修改</a>&nbsp;&#124;&nbsp;<a href="###">删除</a>
			</td>
		</tr>
		{/foreach}
	</table>
</div>


</div>
</body>
</html>
