<?php
/* *************************************************************
*	 类名：等级实体类 LevelModel
*	 作用：对level表的操作
***************************************************************/
class LevelModel extends Model{
private $id;
private $level_name;
private $level_info;
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
	return parent::getCount('cms_level');
}
////////////////////////////////////////////////////////////////
//函 数 名：getLevel();
//权    限：public
//参    数：void
//作    用：获取level表的内容
///////////////////////////////////////////////////////////////
public function getLevel() {
	$sql = "SELECT 
				id,
				level_name,
				level_info
			FROM 
				cms_level
			ORDER BY
				id ASC
			";
	return parent::getMoreData($sql);
}
////////////////////////////////////////////////////////////////
//函 数 名：getLevelLimit();
//权    限：public
//参    数：void
//作    用：获取level表的内容
///////////////////////////////////////////////////////////////
public function getLevelLimit() {
	$sql = "SELECT 
				id,
				level_name,
				level_info
			FROM 
				cms_level
			ORDER BY
				id ASC
			{$this->limit}
			";
	return parent::getMoreData($sql);
}
////////////////////////////////////////////////////////////////
//函 数 名：getOneLevel();
//权    限：public
//参    数：void
//作    用：获取指定的数据
///////////////////////////////////////////////////////////////
public function getOneLevel() {
	$sql = "SELECT 
				level_name,
				level_info
			FROM 
				cms_level
			WHERE
				id = '$this->id'
			LIMIT 1
			";
	return parent::getOneData($sql);
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
///////////////////////////////////////////////////////////////
//函 数 名：addLevel();
//权    限：public
//参    数：void
//作    用：插入数据
///////////////////////////////////////////////////////////////
public function addLevel() {
	$sql = "INSERT INTO cms_level(
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
	$sql = "UPDATE cms_level SET
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
						cms_level
					WHERE
						id = '$this->id'
					LIMIT
						1
						";
	return parent::add_update_delete($sql);
}

}
