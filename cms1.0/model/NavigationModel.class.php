<?php
/* *************************************************************
*	 类名：导航实体类 NavigationModel
*	 作用：对navigation表的操作
***************************************************************/
class NavigationModel extends Model{
private $id;
private $nav_name;
private $nav_info;
private $nav_pid;
private $nav_sort;
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
	return parent::getCount('cms_navigation');
}
////////////////////////////////////////////////////////////////
//函 数 名：getNavigation();
//权    限：public
//参    数：void
//作    用：获取navigation表的内容
///////////////////////////////////////////////////////////////
public function getNavigation() {
	$sql = "SELECT 
				id,
				nav_name,
				nav_info,
				nav_pid,
				nav_sort
			FROM 
				cms_navigation
			";
	return parent::getMoreData($sql);
}
////////////////////////////////////////////////////////////////
//函 数 名：getNavigationLimit();
//权    限：public
//参    数：void
//作    用：获取navigation表的内容,有limit限制
///////////////////////////////////////////////////////////////
public function getNavigationLimit() {
	$sql = "SELECT 
				id,
				nav_name,
				nav_info,
				nav_pid,
				nav_sort
			FROM 
				cms_navigation
			ORDER BY
				id ASC
			{$this->limit}
			";
	return parent::getMoreData($sql);
}
////////////////////////////////////////////////////////////////
//函 数 名：getOneNavigation();
//权    限：public
//参    数：void
//作    用：获取指定的数据
///////////////////////////////////////////////////////////////
public function getOneNavigation() {
	$sql = "SELECT 
				id,
				nav_name,
				nav_info
			FROM 
				cms_navigation
			WHERE
				id = '$this->id'
			LIMIT 1
			";
	return parent::getOneData($sql);
}
////////////////////////////////////////////////////////////////
//函 数 名：addNavigation();
//权    限：public
//参    数：void
//作    用：插入数据
///////////////////////////////////////////////////////////////
public function addNavigation() {
	$sql = "INSERT INTO cms_navigation(
				nav_name, 
				nav_info,
				nav_pid,
				nav_sort
			)
			VALUES(
				'$this->nav_name',
				'$this->nav_info',
				0,
				0
			)";
	return parent::add_update_delete($sql);
}
////////////////////////////////////////////////////////////////
//函 数 名：updateNavigation();
//权    限：public
//参    数：void
//作    用：修改内容
///////////////////////////////////////////////////////////////
public function updateNavigation() {
	$sql = "UPDATE cms_navigation SET
						nav_name = '$this->nav_name',
						nav_info = '$this->nav_info'
					WHERE
						id = '$this->id'
					LIMIT 1
			";
	return parent::add_update_delete($sql);
}
////////////////////////////////////////////////////////////////
//函 数 名：deleteNavigation();
//权    限：public
//参    数：void
//作    用：删除数据
///////////////////////////////////////////////////////////////
public function deleteNavigation() {
	$sql = "DELETE FROM 
						cms_navigation
					WHERE
						id = '$this->id'
					LIMIT
						1
						";
	return parent::add_update_delete($sql);
}

}
