<script type="text/javascript" src="../js/admin_top_nav.js"></script>
<div id="top">
	<h1 id="logo">CMS管理系统</h1>
	<ul>
		<li><a href="./admin.php" class="selected">首页</a></li>
		<li><a href="./navigation.php">内容</a></li>
		<li><a href="###">会员</a></li>
		<li><a href="###">系统</a></li>
	</ul>
	<p>您好, <strong><?php echo $this->tplVar['user']; ?></strong> [<?php echo $this->tplVar['level_name']; ?>] [<a href="../">去首页</a>] [<a href="manager.php?action=logout">退出</a>]</p>
</div>
