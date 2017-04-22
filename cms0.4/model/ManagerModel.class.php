<?php
/* *************************************************************
*	 类名：管理员实体类 ManagerModel
*	 作用：对manager表的操作
***************************************************************/
class ManagerModel {
private $template;
private $id;
private $user;
private $password;
private $level;
private $reg_time;

////////////////////////////////////////////////////////////////
//函 数 名：__construct(&$template);
//权    限：public
//参    数：&$template：接受模板的地址
//作    用：用于接受模板的地址，供本类使用
///////////////////////////////////////////////////////////////
public function __construct(&$template) {
	$this->template = $template;
}
////////////////////////////////////////////////////////////////
//函 数 名：action();
//权    限：public
//参    数：void
//作    用：对模板的页面显示处理
///////////////////////////////////////////////////////////////
public function action() {
	switch($_GET['action']) {
		case 'show':
			$this->template->assigned('show', 1);
			$this->template->assigned('title', '管理员列表');
			$this->template->assigned('manager',$this->getManager());
			break;
		case 'add':
			$this->template->assigned('add', 1);
			$this->template->assigned('title', '新增管理员');
			if(isset($_POST['send'])) {
				$this->user = $_POST['user'];
				$this->password = sha1($_POST['password']);
				$this->level = $_POST['level'];
				$this->addManager();
			}
			break;
		case 'update':
			$this->template->assigned('update', 1);
			$this->template->assigned('title', '修改管理员');
			if(isset($_GET['id'])) {
				$this->id = $_GET['id'];
				$this->template->assigned('manager', $this->getOneManager());
			}
			if(isset($_POST['send'])) {
				$this->id = $_POST['id'];
				$this->user = $_POST['user'];
				$this->password = sha1($_POST['password']);
				$this->level = $_POST['level'];
				$this->updateManager();
			}
			break;
		case 'delete':
			$this->template->assigned('delete', 1);
			$this->template->assigned('title', '删除管理员');
			if(isset($_GET['id'])) {
				$this->id = $_GET['id'];
				$this->deleteManager();
			}
			break;
		default:
			$this->template->assigned('show', 1);
			$this->template->assigned('title', '管理员列表');
			$this->template->assigned('manager',$this->getManager());
			break;
	}
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
//函 数 名：addManager();
//权    限：public
//参    数：void
//作    用：插入数据
///////////////////////////////////////////////////////////////
public function addManager() {
	$db = DataBase::DataBaseConnect();
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
	if(!$result = mysqli_query($db, $sql)) {
		exit('error：mysql语句错误！' . mysqli_error($db));
	}
	DataBase::DataBaseClose($db, $result=null);
}
////////////////////////////////////////////////////////////////
//函 数 名：updateManager();
//权    限：public
//参    数：void
//作    用：修改内容
///////////////////////////////////////////////////////////////
public function updateManager() {
	$db = DataBase::DataBaseConnect();
	$sql = "UPDATE cms_manager SET
						user = '$this->user',
						password = '$this->password',
						level = '$this->level'
					WHERE
						id = '$this->id'
					LIMIT 1
			";
	if(!$result = mysqli_query($db, $sql)) {
		exit('error：mysql语句错误！' . mysqli_error($db));
	}
	DataBase::DataBaseClose($db, $result=null);
}
////////////////////////////////////////////////////////////////
//函 数 名：deleteManager();
//权    限：public
//参    数：void
//作    用：删除数据
///////////////////////////////////////////////////////////////
public function deleteManager() {
	$db = DataBase::DataBaseConnect();
	$sql = "DELETE FROM 
						cms_manager
					WHERE
						id = '$this->id'
					LIMIT
						1
						";
	if(!$result = mysqli_query($db, $sql)) {
		exit('error：mysql语句错误！' . mysqli_error($db));
	}
	DataBase::DataBaseClose($db, $result=null);
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

}
