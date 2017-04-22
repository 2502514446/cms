<?php
/* *************************************************************
*	 类名：管理员实体类 ManagerModel
*	 作用：对manager表的操作
***************************************************************/
class ManagerModel extends Model{
private $id;
private $user;
private $password;
private $level;
private $reg_time;

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
//函 数 名：getManager();
//权    限：public
//参    数：void
//作    用：获取manager表的内容
///////////////////////////////////////////////////////////////
public function getManager() {
	$db = DataBase::DataBaseConnect();
	$sql = "SELECT 
				m.user,
				m.login_count,
				m.last_ip,
				m.last_time,
				m.reg_time,
				m.level,
				l.id,
				m.id,
				l.level_name
			FROM 
				cms_manager	as m,
				cms_levle	as l
			WHERE
				m.level = l.id
			ORDER BY
				m.level ASC
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
//函 数 名：getOneManager();
//权    限：public
//参    数：void
//作    用：获取指定的数据
///////////////////////////////////////////////////////////////
public function getOneManager() {
	$db = DataBase::DataBaseConnect();
	$sql = "SELECT 
				m.user,
				m.level,
				m.password,
				l.id,
				m.id,
				l.level_name
			FROM 
				cms_manager	as m,
				cms_levle	as l
			WHERE
				m.id = '$this->id'
			LIMIT 1
			";
	if(!$result = mysqli_query($db, $sql)) {
		exit('error：mysql语句错误！' . mysqli_error($db));
	}
	$html[] = mysqli_fetch_object($result);
	DataBase::DataBaseClose($db, $result);
	return $html;
}
////////////////////////////////////////////////////////////////
//函 数 名：getLevel();
//权    限：public
//参    数：void
//作    用：获取等级列表
////////////////////////////////////////////////////////////////
public function getLevel() {
	$db = DataBase::DataBaseConnect();
	$sql = "SELECT 
				id,
				level_name
			FROM 
				cms_levle
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
//函 数 名：addManager();
//权    限：public
//参    数：void
//作    用：插入数据
///////////////////////////////////////////////////////////////
public function addManager() {
	$sql = "INSERT INTO cms_manager(
				user, 
				password,
				level,
				reg_time
			)
			VALUES(
				'$this->user',
				'$this->password',
				'$this->level',
				NOW()
			)";
	return parent::add_update_delete($sql);
}
////////////////////////////////////////////////////////////////
//函 数 名：updateManager();
//权    限：public
//参    数：void
//作    用：修改内容
///////////////////////////////////////////////////////////////
public function updateManager() {
	$sql = "UPDATE cms_manager SET
						user = '$this->user',
						password = '$this->password',
						level = '$this->level'
					WHERE
						id = '$this->id'
					LIMIT 1
			";
	return parent::add_update_delete($sql);
}
////////////////////////////////////////////////////////////////
//函 数 名：deleteManager();
//权    限：public
//参    数：void
//作    用：删除数据
///////////////////////////////////////////////////////////////
public function deleteManager() {
	$sql = "DELETE FROM 
						cms_manager
					WHERE
						id = '$this->id'
					LIMIT
						1
						";
	return parent::add_update_delete($sql);
}

}
