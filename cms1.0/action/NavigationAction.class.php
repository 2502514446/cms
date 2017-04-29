<?php
/* *************************************************************
*	 类名：导航业务类 NavigationAction
*	 作用：对navigation的操作与功能
***************************************************************/
class NavigationAction {
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
	$this->model = new NavigationModel();
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
	$page = new Page($this->model->getCountSon(), PAGE_SIZE);
	$this->model->limit = $page->limit;
	$this->template->assigned('page', $page->showPage());

	$this->template->assigned('show', 1);
	$this->template->assigned('title', '导航列表');
	$this->template->assigned('navigation',$this->model->getNavigationLimit());
}
////////////////////////////////////////////////////////////////
//函 数 名：action_add();
//权    限：private
//参    数：void
//作    用：对数据的新增业务
///////////////////////////////////////////////////////////////
private function action_add() {
	$this->template->assigned('add', 1);
	$this->template->assigned('title', '新增导航');
	if(isset($_POST['send'])) {

		if(CheckData::checkDataEmpty($_POST['nav_name'])) {
			Tool::alertBack('导航名称不得为空！');
		}
		foreach($this->model->getNavigation() as $key=>$value) {
			if($_POST['nav_name'] == $value->nav_name) {
				Tool::alertBack('导航名称已被使用！');
			}
		}
		if(CheckData::checkDataLength($_POST['nav_name'], 2, 'min')) {
			Tool::alertBack('导航名称不得小于2位！');
		}
		if(CheckData::checkDataLength($_POST['nav_name'], 8, 'max')) {
			Tool::alertBack('导航名称不得大于8位！');
		}
		if(CheckData::checkDataLength($_POST['nav_info'], 200, 'max')) {
			Tool::alertBack('导航说明不得大于200位！');
		}

		$this->model->nav_name = $_POST['nav_name'];
		$this->model->nav_info = $_POST['nav_info'];
		$this->model->addNavigation() ?
				Tool::alertLocation('新增导航成功！', './navigation.php?action=show') : 
				Tool::alertBack('新增导航失败！');
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
	$this->template->assigned('title', '修改导航');
	if(isset($_GET['id'])) {
		$this->model->id = $_GET['id'];
		$this->template->assigned('navigation', $this->model->getOneNavigation());
	}
	if(isset($_POST['send'])) {

		if(CheckData::checkDataEmpty($_POST['nav_name'])) {
			Tool::alertBack('导航名称不得为空！');
		}
		///////////////
		foreach($this->model->getOneNavigation() as $key=>$value) {
			if($_POST['nav_name'] != $value->nav_name) {
				foreach($this->model->getNavigation() as $key=>$value) {
					if($_POST['nav_name'] == $value->nav_name) {
						Tool::alertBack('导航名称已被使用！');
					}
				}
			}
		}
		///////////////
		if(CheckData::checkDataLength($_POST['nav_name'], 2, 'min')) {
			Tool::alertBack('导航名称长度不得小于2位！');
		}
		if(CheckData::checkDataLength($_POST['nav_name'], 8, 'max')) {
			Tool::alertBack('导航名称长度不得大于8位！');
		}
		if(CheckData::checkDataLength($_POST['nav_info'], 200, 'max')) {
			Tool::alertBack('导航说明长度不得大于200位！');
		}

		$this->model->id = $_POST['id'];
		$this->model->nav_name = $_POST['nav_name'];
		$this->model->nav_info = $_POST['nav_info'];
		$this->model->updateNavigation() ?
				Tool::alertLocation('修改导航成功！', './navigation.php?action=show') : 
				Tool::alertBack('修改导航失败！');
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
	$this->template->assigned('title', '删除导航');
	if(isset($_GET['id'])) {
		$this->model->id = $_GET['id'];
		$this->model->deleteNavigation() ? 
				Tool::alertLocation('删除导航成功！', './navigation.php?action=show') : 
				Tool::alertBack('删除导航失败！');
	}
}

}
