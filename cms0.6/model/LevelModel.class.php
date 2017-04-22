<?php
/* *************************************************************
*	 类名：等级实体类 LevelModel
*	 作用：对level表的操作
***************************************************************/
class LevelModel extends Model{
private $id;
private $level_name;
private $level_info;

////////////////////////////////////////////////////////////////
//函 数 名：__construct();
//权    限：public
//参    数：
//作    用：
///////////////////////////////////////////////////////////////
public function __construct() {
}
public function __set($key, $value) {
	$this->$key = $value;
}
public function __get($key) {
	return $this->$key;
}
////////////////////////////////////////////////////////////////
//函 数 名：getLevel();
//权    限：public
//参    数：void
//作    用：获取level表的内容
///////////////////////////////////////////////////////////////
public function getLevel() {
	$db = DataBase::DataBaseConnect();
	$sql = "SELECT 
				id,
				level_name,
				level_info
			FROM 
				cms_levle
			ORDER BY
				id ASC
			LIMIT 
				0,10
			";
	if(!$result = mysqli_query($db, $sql)) {
		exit('error：mysql语句错误！' . mysqli_error($db));
	}
	$html = array();
	while(!!$objects = mysqli_fetch_object($result)) {
		$html[] = $objects; 
	}
	DataBase::DataBaseClose($db, $result);
	return $html;
}
////////////////////////////////////////////////////////////////
//函 数 名：getOneLevel();
//权    限：public
//参    数：void
//作    用：获取指定的数据
///////////////////////////////////////////////////////////////
public function getOneLevel() {
	$db = DataBase::DataBaseConnect();
	$sql = "SELECT 
				level_name,
				level_info
			FROM 
				cms_levle
			WHERE
				id = '$this->id'
			LIMIT 1
			";
	if(!$result = mysqli_query($db, $sql)) {
		exit('error：mysql语句错误！' . mysqli_error($db));
	}
	$html[] = mysqli_fetch_object($result);
	DataBase::DataBaseClose($db, $result);
	return $html;
}
///////////////////////////////////////////////////////////////
//函 数 名：addLevel();
//权    限：public
//参    数：void
//作    用：插入数据
///////////////////////////////////////////////////////////////
public function addLevel() {
	$sql = "INSERT INTO cms_levle(
				level_name,
				level_info
			)
			VALUES(
				'$this->level_name',
				'$this->level_info'
			)";
	return parent::add_update_delete($sql);
}
////////////////////////////////////////////////////////////////
//函 数 名：updateLevel();
//权    限：public
//参    数：void
//作    用：修改内容
///////////////////////////////////////////////////////////////
public function updateLevel() {
	$sql = "UPDATE cms_levle SET
						level_name = '$this->level_name',
						level_info = '$this->level_info'
					WHERE
						id = '$this->id'
					LIMIT 1
			";
	return parent::add_update_delete($sql);
}
////////////////////////////////////////////////////////////////
//函 数 名：deleteLevel();
//权    限：public
//参    数：void
//作    用：删除数据
///////////////////////////////////////////////////////////////
public function deleteLevel() {
	$sql = "DELETE FROM 
						cms_levle
					WHERE
						id = '$this->id'
					LIMIT
						1
						";
	return parent::add_update_delete($sql);
}

}
