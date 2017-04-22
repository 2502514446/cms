<!DOCTYPE html>
<html>
<head>
	<title><?php echo $this->configVar['webname']; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../style/admin.css" />
	<script type="text/javascript" src="../js/admin_manager_option.js"></script>
</head>
<body>
<input type="hidden" value="0" id="nav_selected"/>
<?php include('./admin_top.php'); ?>
<?php include('./admin_sidebar.php'); ?>
<div id="main">

<div class="nav">
	<ol>
		<li><a href="./manager.php?action=show" class="selected">管理员列表</a></li>
		<li><a href="./manager.php?action=add">新增管理员</a></li>
		<?php if($this->tplVar['update']) {  ?>
			<li><a href="###">修改管理员</a></li>
		<?php }  ?>
		<?php if($this->tplVar['delete']) {  ?>
			<li><a href="###">删除管理员</a></li>
		<?php }  ?>
	</ol>
</div>

<div class="map">
	管理首页&nbsp;&frasl;&nbsp;管理员管理&nbsp;&frasl;&nbsp;<strong id='title'><?php echo $this->tplVar['title']; ?></strong>
</div>

<?php if($this->tplVar['show']) {  ?>
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
		<?php foreach($this->tplVar['manager'] as $key=>$value) { ?>
		<tr>
			<td><?php echo $value->user ?></td>
			<td><?php echo $value->level_name ?></td>
			<td><?php echo $value->login_count ?></td>
			<td><?php echo $value->last_ip ?></td>
			<td><?php echo $value->last_time ?></td>
			<td><?php echo $value->reg_time ?></td>
			<td>
				<a href="./manager.php?action=update&id=<?php echo $value->id ?>">修改</a>
				&nbsp;&#124;&nbsp;
				<a href="./manager.php?action=delete&id=<?php echo $value->id ?>">删除</a>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>
<?php }  ?>

<?php if($this->tplVar['add']) {  ?>
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
				<?php foreach($this->tplVar['level'] as $key=>$value) { ?>
					<option value="<?php echo $value->id ?>"><?php echo $value->level_name ?></option>
				<?php } ?>
			</select></td>
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
	<?php foreach($this->tplVar['manager'] as $key=>$value) { ?>
		<tr>
			<td><!--ID--></td>
			<td><input type="hidden" name="id" value="<?php echo $value->id ?>" class="text" /></td>
		</tr>
		<tr>
			<td><!--等级--></td>
			<td><input type="hidden" id="level" value="<?php echo $value->level ?>" class="text" /></td>
		</tr>
		<tr>
			<td>用户名：</td>
			<td><input type="text" name="user" value="<?php echo $value->user ?>" class="text" /></td>
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
				<?php foreach($this->tplVar['level'] as $key=>$value) { ?>
					<option value="<?php echo $value->id ?>"><?php echo $value->level_name ?></option>
				<?php } ?>
			</select></td>
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
