<?php
$rootFile = dirname(__FILE__);
$fileLength = mb_strlen(basename(dirname(__FILE__)), 'utf-8')*(-1);
require_once(substr($rootFile, 0, $fileLength) . 'initialise.inc.php');
$template = new Template();

$db = DataBase::DataBaseConnect();
$sql = "SELECT * FROM cms_manager";
if(!$result = mysqli_query($db, $sql)) {
	exit('error：查找数据错误！' . mysqli_error($db));
}
$html = array();
while(!!$objects = mysqli_fetch_object($result)) {
	$html[] = $objects; 
}
DataBase::DataBaseClose($db, $result);

//注入变量应在生成编译文件之前注入
$template->assigned('html',$html);
$template->display('manager.tpl');
