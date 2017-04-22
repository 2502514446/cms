<?php
/* *************************************************************
*	 类名：数据库操作 DataBase
*	 作用：对数据库的连接和关闭操作
***************************************************************/
class DataBase {

////////////////////////////////////////////////////////////////
//函 数 名：DataBaseConnect();
//权    限：static public
//参    数：void
//作    用：连接数据库
///////////////////////////////////////////////////////////////
static public function DataBaseConnect() {
	$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if(!$db) {
		exit('error：数据库连接错误！' . mysqli_error($db));
	}
	if(!mysqli_set_charset($db, 'utf8')) {
		exit ('error：数据库字符设置错误！' . mysqli_error($db));
	}
	return $db;
}
////////////////////////////////////////////////////////////////
//函 数 名：DataBaseClose(&$db, &$result);
//权    限：static public
//参    数：1、&$db：数据库的地址
//			2、&$result：结果集
//作    用：关闭数据库
///////////////////////////////////////////////////////////////
static public function DataBaseClose(&$db, &$result) {
	mysqli_free_result($result);
	if(!mysqli_close($db)) {
		exit('error：数据库关闭错误！' . mysqli_error($db));
	}
	$result = null;
	$db = null;
}

}
