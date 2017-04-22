<!DOCTYPE html>
<html>
<head>
	<title><!--{webname}--></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../style/admin.css" />
</head>
<body>
<input type="hidden" value="0" id="nav_selected"/>
{include "./admin_top.php"}
{include "./admin_sidebar.php"}
<div id="main">

<div class="nav">
	<ol>
		<li><a href="./level.php?action=show" class="selected">等级列表</a></li>
		<li><a href="./level.php?action=add">新增等级</a></li>
		{if $update}
			<li><a href="###">修改等级</a></li>
		{/if}
		{if $delete}
			<li><a href="###">删除等级</a></li>
		{/if}
	</ol>
</div>

<div class="map">
	管理首页&nbsp;&frasl;&nbsp;等级管理&nbsp;&frasl;&nbsp;<strong id='title'>{$title}</strong>
</div>

{if $show}
<div class="show">
	<table cellspacing="0">
		<tr>
			<th>ID</th>
			<th>等级名称</th>
			<th>等级说明</th>
			<th>操作</th>
		</tr>
		{foreach $level(key, value)}
		<tr>
			<td>{@value->id}</td>
			<td>{@value->level_name}</td>
			<td>{@value->level_info}</td>
			<td>
				<a href="./level.php?action=update&id={@value->id}">修改</a>
				&nbsp;&#124;&nbsp;
				<a href="./level.php?action=delete&id={@value->id}">删除</a>
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
			<td>等级名称：</td>
			<td><input type="text" name="level_name" class="text" /></td>
		</tr>
		<tr>
			<td>等级说明：</td>
			<td><input type="text" name="level_info" class="text" /></td>
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
	{foreach $level(key, value)}
		<tr>
			<td><!--ID--></td>
			<td><input type="hidden" name="id" value="{@value->id}" class="text" /></td>
		</tr>
		<tr>
			<td>等级名称：</td>
			<td><input type="text" name="level_name" value="{@value->level_name}" class="text" /></td>
		</tr>
		<tr>
			<td>等级说明：</td>
			<td><input type="text" name="level_info" value="{@value->level_info}" class="text" /></td>
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
