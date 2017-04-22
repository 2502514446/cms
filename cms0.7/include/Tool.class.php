<?php
/* *************************************************************
*	 类名：工具类	Tool
*	 作用：公共的功能
***************************************************************/
class Tool {

////////////////////////////////////////////////////////////////
//函 数 名：alertLocation($info, $url);
//权    限：static public
//参    数：1、$info：提示信息
//			2、$url： 跳转的页面
//作    用：实现提示与页面的跳转
///////////////////////////////////////////////////////////////
static public function alertLocation($info, $url) {
	echo "<script type='text/javascript'>
			alert('$info');
			location.href = '$url';
		</script>";
	exit();
}
////////////////////////////////////////////////////////////////
//函 数 名：alertBack($info);
//权    限：static public
//参    数：1、$info：提示信息
//作    用：实现提示与页面的返回
///////////////////////////////////////////////////////////////
static public function alertBack($info) {
	echo "<script type='text/javascript'>
			alert('$info');
			history.back();
		</script>";
	exit();
}

}

