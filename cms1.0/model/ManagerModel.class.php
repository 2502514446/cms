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
private $limit;

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
//函 数 名：getCount();
//权    限：public
//参    数：void
//作    用：获取表的总数据
////////////////////////////////////////////////////////////////
public function getCountSon() {
	return parent::getCount('cms_manager');
}
////////////////////////////////////////////////////////////////
//函 数 名：getManager();
//权    限：public
//参    数：void
//作    用：获取manager表的内容
///////////////////////////////////////////////////////////////
public function getManager() {
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
				cms_level	as l
			WHERE
				m.level = l.id
			ORDER BY
				m.level ASC
			";
	return parent::getMoreData($sql);
}
////////////////////////////////////////////////////////////////
//函 数 名：getManagerLimit();
//权    限：public
//参    数：void
//作    用：获取manager表的内容,有limit限制
///////////////////////////////////////////////////////////////
public function getManagerLimit() {
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
				cms_level	as l
			WHERE
				m.level = l.id
			ORDER BY
				m.level ASC
			{$this->limit}
			";
	return parent::getMoreData($sql);
}
////////////////////////////////////////////////////////////////
//函 数 名：getOneManager();
//权    限：public
//参    数：void
//作    用：获取指定的数据
///////////////////////////////////////////////////////////////
public function getOneManager() {
	$sql = "SELECT 
				m.user,
				m.level,
				m.password,
				l.id,
				m.id,
				l.level_name
			FROM 
				cms_manager	as m,
				cms_level	as l
			WHERE
				m.id = '$this->id'
			LIMIT 1
			";
	return parent::getOneData($sql);
}
////////////////////////////////////////////////////////////////
//函 数 名：getLevel();
//权    限：public
//参    数：void
//作    用：获取等级列表
////////////////////////////////////////////////////////////////
public function getLevel() {
	$sql = "SELECT 
				id,
				level_name
			FROM 
				cms_level
			";
	return parent::getMoreData($sql);
}
////////////////////////////////////////////////////////////////
//函 数 名：getLoginManager();
//权    限：public
//参    数：void
//作    用：获取登陆用户的数据
///////////////////////////////////////////////////////////////
public function getLoginManager() {
	$db = DataBase::DataBaseConnect();
	$sql = "SELECT 
				m.user,
				l.level_name
			FROM 
				cms_manager	as m,
				cms_level	as l
			WHERE
					m.user = '$this->user'
				AND
					m.password = '$this->password'
				AND
					m.level = l.id
			LIMIT 1
			";
	return parent::getOneData($sql);
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
