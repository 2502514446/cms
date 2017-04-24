<?php
/* *************************************************************
*	 类名：等级业务类 LevelAction
*	 作用：对level的操作与功能
***************************************************************/
class LevelAction {
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
	$this->model = new LevelModel();
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
	$this->template->assigned('title', '等级列表');
	$this->template->assigned('level',$this->model->getLevelLimit());
}
////////////////////////////////////////////////////////////////
//函 数 名：action_add();
//权    限：private
//参    数：void
//作    用：对数据的新增业务
///////////////////////////////////////////////////////////////
private function action_add() {
	$this->template->assigned('add', 1);
	$this->template->assigned('title', '新增等级');
	if(isset($_POST['send'])) {

		if(CheckData::checkDataEmpty($_POST['level_name'])) {
			Tool::alertBack('等级名称不得为空！');
		}
		foreach($this->model->getLevel() as $key=>$value) {
			if($_POST['level_name'] == $value->level_name) {
				Tool::alertBack('等级名称已被使用！');
			}
		}
		if(CheckData::checkDataLength($_POST['level_name'], 2, 'min')) {
			Tool::alertBack('等级名称长度不得小于2位！');
		}
		if(CheckData::checkDataLength($_POST['level_name'], 10, 'max')) {
			Tool::alertBack('等级名称长度不得大于10位！');
		}
		if(CheckData::checkDataLength($_POST['level_info'], 200, 'max')) {
			Tool::alertBack('等级信息长度不得大于200位！');
		}

		$this->model->level_name = $_POST['level_name'];
		$this->model->level_info = $_POST['level_info'];
		$this->model->addLevel() ?
				Tool::alertLocation('新增等级成功！', './level.php?action=show') : 
				Tool::alertBack('新增等级失败！');
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
	$this->template->assigned('title', '修改等级');
	if(isset($_GET['id'])) {
		$this->model->id = $_GET['id'];
		$this->template->assigned('level', $this->model->getOneLevel());
	}
	if(isset($_POST['send'])) {

		if(CheckData::checkDataEmpty($_POST['level_name'])) {
			Tool::alertBack('等级名称不得为空！');
		}
		///////////////
		foreach($this->model->getOneLevel() as $key=>$value) {
			if($_POST['level_name'] != $value->level_name) {
				foreach($this->model->getManager() as $key=>$value) {
					if($_POST['level_name'] == $value->level_name) {
						Tool::alertBack('等级名称已被使用！');
					}
				}
			}
		}
		///////////////
		if(CheckData::checkDataLength($_POST['level_name'], 2, 'min')) {
			Tool::alertBack('等级名称长度不得小于2位！');
		}
		if(CheckData::checkDataLength($_POST['level_name'], 10, 'max')) {
			Tool::alertBack('等级名称长度不得大于10位！');
		}
		if(CheckData::checkDataLength($_POST['level_info'], 200, 'max')) {
			Tool::alertBack('等级信息长度不得大于200位！');
		}

		$this->model->level_name = $_POST['level_name'];
		$this->model->level_info = $_POST['level_info'];
		$this->model->updateLevel() ?
				Tool::alertLocation('修改等级成功！', './level.php?action=show') : 
				Tool::alertBack('修改等级失败！');
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
	$this->template->assigned('title', '删除等级');
	if(isset($_GET['id'])) {
		$this->model->id = $_GET['id'];
		foreach($this->model->getManager() as $keyM=>$value) {
			if($_GET['id'] == $value->level) {
				Tool::alertBack('等级已被管理员使用，不得删除，请先删除管理员！');
			}
		}
		$this->model->deleteLevel() ?
				Tool::alertLocation('删除等级成功！', './level.php?action=show') : 
				Tool::alertBack('删除等级失败！');
	}
}

}
