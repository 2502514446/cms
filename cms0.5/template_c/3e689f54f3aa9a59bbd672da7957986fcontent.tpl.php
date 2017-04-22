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
<?php include('./main_content.php'); ?>

</body>
</html>
