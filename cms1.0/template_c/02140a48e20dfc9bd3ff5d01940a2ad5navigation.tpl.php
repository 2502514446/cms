<!DOCTYPE html>
<html>
<head>
	<title><?php echo $this->configVar['webname']; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../style/admin.css" />
	<script type="text/javascript" src="../js/admin_top_nav.js"></script>
</head>
<body>
<input type="hidden" value="1" id="nav_selected"/>
<?php include('./admin_top.php'); ?>
<?php include('./sidebar_content.php'); ?>
<div id="main">

<div class="nav">
	<ol>
		<li><a href="./navigation.php?action=show" class="selected">导航列表</a></li>
		<li><a href="./navigation.php?action=add">新增导航</a></li>
		<?php if($this->tplVar['update']) {  ?>
			<li><a href="###">修改导航</a></li>
		<?php }  ?>
		<?php if($this->tplVar['delete']) {  ?>
			<li><a href="###">删除导航</a></li>
		<?php }  ?>
	</ol>
</div>

<div class="map">
	管理首页&nbsp;&frasl;&nbsp;<strong id='title'><?php echo $this->tplVar['title']; ?></strong>
</div>

<?php if($this->tplVar['show']) {  ?>
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
		<?php if($this->tplVar['navigation']) {  ?>
		<?php foreach($this->tplVar['navigation'] as $key=>$value) { ?>
		<tr>
			<td><?php echo $value->id ?></td>
			<td><?php echo $value->nav_name ?></td>
			<td><?php echo $value->nav_info ?></td>
			<td><?php echo $value->nav_pid ?></td>
			<td><?php echo $value->nav_sort ?></td>
			<td>
				<a href="./navigation.php?action=update&id=<?php echo $value->id ?>">修改</a>
				&nbsp;&#124;&nbsp;
				<a href="./navigation.php?action=delete&id=<?php echo $value->id ?>">删除</a>
			</td>
		</tr>
		<?php } ?>
	<table>
	<div id="page"><?php echo $this->tplVar['page']; ?></div>
	<?php } else {  ?>
	</table>
	<div id="none">没有任何数据！</div>
	<?php }  ?>
</div>
<?php }  ?>

<?php if($this->tplVar['add']) {  ?>
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
<?php }  ?>

<?php if($this->tplVar['update']) {  ?>
<div class="add">
	<form method="post">
	<table>
	<?php foreach($this->tplVar['navigation'] as $key=>$value) { ?>
		<tr>
			<td><!--ID--></td>
			<td><input type="hidden" name="id" value="<?php echo $value->id ?>" class="text" /></td>
		</tr>
		<tr>
			<td><!--父导航id--></td>
			<td><input type="hidden" name="nav_pid" value="<?php echo $value->nav_pid ?>" class="text" /></td>
		</tr>
		<tr>
			<td>导航名称：</td>
			<td><input type="text" name="nav_name" value="<?php echo $value->nav_name ?>" class="text" /></td>
		</tr>
		<tr>
			<td>导航说明：</td>
			<td><input type="text" name="nav_info" value="<?php echo $value->nav_info ?>" class="text" /></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="send" value="确认" class="submit" /></td>
		</tr>
	<?php } ?>
	</table>
	</form>
</div>
<?php }  ?>

<?php if($this->tplVar['delete']) {  ?>
delete
<?php }  ?>

</div>
</body>
</html>
