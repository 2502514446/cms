<!DOCTYPE html>
<html>
<head>
	<title><!--{webname}--></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../style/admin.css" />
	<script type="text/javascript" src="../js/admin_top_nav.js"></script>
</head>
<body>
<input type="hidden" value="1" id="nav_selected"/>
{include "./admin_top.php"}
{include "./sidebar_content.php"}
<div id="main">

<div class="nav">
	<ol>
		<li><a href="./navigation.php?action=show" class="selected">导航列表</a></li>
		<li><a href="./navigation.php?action=add">新增导航</a></li>
		{if $update}
			<li><a href="###">修改导航</a></li>
		{/if}
		{if $delete}
			<li><a href="###">删除导航</a></li>
		{/if}
	</ol>
</div>

<div class="map">
	管理首页&nbsp;&frasl;&nbsp;<strong id='title'>{$title}</strong>
</div>

{if $show}
<div class="show">
	<table cellspacing="0">
		<tr>
			<th>ID</th>
			<th>导航名称</th>
			<th>导航说明</th>
			<th>父导航</th>
			<th>排序</th>
			<th>操作</th>
		</tr>
		{if $navigation}
		{foreach $navigation(key, value)}
		<tr>
			<td>{@value->id}</td>
			<td>{@value->nav_name}</td>
			<td>{@value->nav_info}</td>
			<td>{@value->nav_pid}</td>
			<td>{@value->nav_sort}</td>
			<td>
				<a href="./navigation.php?action=update&id={@value->id}">修改</a>
				&nbsp;&#124;&nbsp;
				<a href="./navigation.php?action=delete&id={@value->id}">删除</a>
			</td>
		</tr>
		{/foreach}
	<table>
	<div id="page">{$page}</div>
	{else}
	</table>
	<div id="none">没有任何数据！</div>
	{/if}
</div>
{/if}

{if $add}
<div class="add">
	<form method="post">
	<table>
		<tr>
			<td>导航名称：</td>
			<td><input type="text" name="nav_name" class="text" /></td>
		</tr>
		<tr>
			<td>导航说明：</td>
			<td><input type="text" name="nav_info" class="text" /></td>
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
	{foreach $navigation(key, value)}
		<tr>
			<td><!--ID--></td>
			<td><input type="hidden" name="id" value="{@value->id}" class="text" /></td>
		</tr>
		<tr>
			<td><!--父导航id--></td>
			<td><input type="hidden" name="nav_pid" value="{@value->nav_pid}" class="text" /></td>
		</tr>
		<tr>
			<td>导航名称：</td>
			<td><input type="text" name="nav_name" value="{@value->nav_name}" class="text" /></td>
		</tr>
		<tr>
			<td>导航说明：</td>
			<td><input type="text" name="nav_info" value="{@value->nav_info}" class="text" /></td>
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
