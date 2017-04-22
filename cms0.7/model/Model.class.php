<?php
/* *************************************************************
*	 类名：实体基类 Model
*	 作用：对表的通用操作
***************************************************************/
class Model {

////////////////////////////////////////////////////////////////
//函 数 名：add_update_delete($sql);
//权    限：protected
//参    数：$sql：接收sql语句
//作    用：对数据的增、删、改操作
///////////////////////////////////////////////////////////////
protected function add_update_delete($sql) {
	$db = DataBase::DataBaseConnect();
	if(!$result = mysqli_query($db, $sql)) {
		exit('error：mysql语句错误！' . mysqli_error($db));
	}
	$return = $result;
	DataBase::DataBaseClose($db, $result=null);
	return $return;
}
////////////////////////////////////////////////////////////////
//函 数 名：getCount($sql);
//权    限：protected
//参    数：$sql：接收sql语句
//作    用：获取表的总数据
////////////////////////////////////////////////////////////////
protected function getCount($table) {
	$db = DataBase::DataBaseConnect();
	$sql = "SELECT COUNT(*) as count FROM {$table} ";
	if(!$result = mysqli_query($db, $sql)) {
		exit('error：mysql语句错误！' . mysqli_error($db));
	}
	$html = mysqli_fetch_object($result);
	DataBase::DataBaseClose($db, $result);
	return $html->count;
}

}

