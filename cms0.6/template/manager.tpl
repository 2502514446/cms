<!DOCTYPE html>
<html>
<head>
	<title><!--{webname}--></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../style/admin.css" />
	<script type="text/javascript" src="../js/admin_manager_option.js"></script>
</head>
<body>
<input type="hidden" value="0" id="nav_selected"/>
{include "./admin_top.php"}
{include "./admin_sidebar.php"}
<div id="main">

<div class="nav">
	<ol>
		<li><a href="./manager.php?action=show" class="selected">管理员列表</a></li>
		<li><a href="./manager.php?action=add">新增管理员</a></li>
		{if $update}
			<li><a href="###">修改管理员</a></li>
		{/if}
		{if $delete}
			<li><a href="###">删除管理员</a></li>
		{/if}
	</ol>
</div>

<div class="map">
	管理首页&nbsp;&frasl;&nbsp;管理员管理&nbsp;&frasl;&nbsp;<strong id='title'>{$title}</strong>
</div>

{if $show}
<div class="show">
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
		{foreach $manager(key, value)}
		<tr>
			<td>{@value->user}</td>
			<td>{@value->level_name}</td>
			<td>{@value->login_count}</td>
			<td>{@value->last_ip}</td>
			<td>{@value->last_time}</td>
			<td>{@value->reg_time}</td>
			<td>
				<a href="./manager.php?action=update&id={@value->id}">修改</a>
				&nbsp;&#124;&nbsp;
				<a href="./manager.php?action=delete&id={@value->id}">删除</a>
			</td>
		</tr>
		{/foreach}
	</table>
</div>
{/if}

{if $add}
<div class="add">
	<form method="post">
	<table>
		<tr>
			<td>用户名：</td>
			<td><input type="text" name="user" class="text" /></td>
		</tr>
		<tr>
			<td>密码：</td>
			<td><input type="password" name="password" class="text" /></td>
		</tr>
		<tr>
			<td>确认密码：</td>
			<td><input type="password" name="yes_password" class="text" /></td>
		</tr>
		<tr>
			<td>等级：</td>
			<td><select name="level">
				{foreach $level(key, value)}
					<option value="{@value->id}">{@value->level_name}</option>
				{/foreach}
			</select></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="send" value="确认" class="submit" /></td>
		</tr>
	</table>
	</form>
</div>
{/if}

{if $update}
<div class="add">
	<form method="post">
	<table>
	{foreach $manager(key, value)}
		<tr>
			<td><!--ID--></td>
			<td><input type="hidden" name="id" value="{@value->id}" class="text" /></td>
		</tr>
		<tr>
			<td><!--等级--></td>
			<td><input type="hidden" id="level" value="{@value->level}" class="text" /></td>
		</tr>
		<tr>
			<td>用户名：</td>
			<td><input type="text" name="user" value="{@value->user}" class="text" /></td>
		</tr>
		<tr>
			<td>密码：</td>
			<td><input type="password" name="password" value="" class="text" /></td>
		</tr>
		<tr>
			<td>确认密码：</td>
			<td><input type="password" name="yes_password" class="text" /></td>
		</tr>
		<tr>
			<td>等级：</td>
			<td><select name="level">
				{foreach $level(key, value)}
					<option value="{@value->id}">{@value->level_name}</option>
				{/foreach}
			</select></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="send" value="确认" class="submit" /></td>
		</tr>
	{/foreach}
	</table>
	</form>
</div>
{/if}

{if $delete}
delete
{/if}

</div>
</body>
</html>
