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
		管理首页&nbsp;&frasl;&nbsp;后台首页&nbsp;&frasl;&nbsp;<?php echo $this->tplVar['title']; ?>
	</div>
</div>

</body>
</html>
