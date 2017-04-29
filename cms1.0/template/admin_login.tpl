<!DOCTYPE html>
<html>
<head>
	<title><!--{webname}--></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../style/admin_login.css" />
</head>
<body>
<div id="login">  
	<h1>Login</h1>  
	<form method="post" action="./manager.php?action=login">
		<input type="text" required="required" placeholder="用户名" name="user" />
		<input type="password" required="required" placeholder="密码" name="password" />
		<button type="submit" name="send" class="but">登录</button>  
	</form>  
	<div id="attach">
		<a href="../">返回首页</a>
		<a href="###">忘记密码</a>
	</div>
</div>  
</body>
</html>
