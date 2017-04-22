<?php
/* *************************************************************
*	 类名：管理员业务类 ManagerAction
*	 作用：对manager的操作与功能
***************************************************************/
class ManagerAction {
private $template;
private $model;

////////////////////////////////////////////////////////////////
//函 数 名：action();
//权    限：public
//参    数：void
//作    用：对模板的页面显示处理
///////////////////////////////////////////////////////////////
public function __construct(&$template) {
	$this->template = $template;
	$this->model = new ManagerModel();
	$this->action();
}
////////////////////////////////////////////////////////////////
//函 数 名：action();
//权    限：private
//参    数：void
//作    用：对模板的页面显示处理
///////////////////////////////////////////////////////////////
private function action() {
	switch($_GET['action']) {
		case 'show':
			$this->action_show();
			break;
		case 'add':
			$this->action_add();
			break;
		case 'update':
			$this->action_update();
			break;
		case 'delete':
			$this->action_delete();
			break;
		default:
			$this->action_show();
			break;
	}
}
////////////////////////////////////////////////////////////////
//函 数 名：action_show();
//权    限：private
//参    数：void
//作    用：对数据的显示业务
///////////////////////////////////////////////////////////////
private function action_show() {
	$this->template->assigned('show', 1);
	$this->template->assigned('title', '管理员列表');
	$this->template->assigned('manager',$this->model->getManager());
}
////////////////////////////////////////////////////////////////
//函 数 名：action_add();
//权    限：private
//参    数：void
//作    用：对数据的新增业务
///////////////////////////////////////////////////////////////
private function action_add() {
	$this->template->assigned('add', 1);
	$this->template->assigned('title', '新增管理员');
	$this->template->assigned('level', $this->model->getLevel());
	if(isset($_POST['send'])) {
		$this->model->user = $_POST['user'];
		$this->model->password = sha1($_POST['password']);
		$this->model->level = $_POST['level'];
		$this->model->addManager();
	}
}
////////////////////////////////////////////////////////////////
//函 数 名：action_update();
//权    限：private
//参    数：void
//作    用：对数据的修改业务
///////////////////////////////////////////////////////////////
private function action_update() {
	$this->template->assigned('update', 1);
	$this->template->assigned('title', '修改管理员');
	if(isset($_GET['id'])) {
		$this->model->id = $_GET['id'];
		$this->template->assigned('manager', $this->model->getOneManager());
		$this->template->assigned('level', $this->model->getLevel());
	}
	if(isset($_POST['send'])) {
		$this->model->id = $_POST['id'];
		$this->model->user = $_POST['user'];
		$this->model->password = sha1($_POST['password']);
		$this->model->level = $_POST['level'];
		$this->model->updateManager();
	}
}
////////////////////////////////////////////////////////////////
//函 数 名：action_delete();
//权    限：private
//参    数：void
//作    用：对数据的删除业务
///////////////////////////////////////////////////////////////
private function action_delete() {
	$this->template->assigned('delete', 1);
	$this->template->assigned('title', '删除管理员');
	if(isset($_GET['id'])) {
		$this->model->id = $_GET['id'];
		$this->model->deleteManager();
	}
}

}
