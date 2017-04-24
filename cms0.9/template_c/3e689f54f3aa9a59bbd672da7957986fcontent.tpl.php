<!DOCTYPE html>
<html>
<head>
	<title><?php echo $this->configVar['webname']; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../style/admin.css" />
</head>
<body>
<input type="hidden" value="1" id="nav_selected"/>

<?php include('./admin_top.php'); ?>
<?php include('./sidebar_content.php'); ?>
<div id="main">
	<div class="map">
		内容管理&nbsp;&frasl;&nbsp;<?php echo $this->tplVar['title']; ?>
	</div>
</div>

</body>
</html>
