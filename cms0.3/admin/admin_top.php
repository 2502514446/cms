<?php
$rootFile = dirname(__FILE__);
$fileLength = mb_strlen(basename(dirname(__FILE__)), 'utf-8')*(-1);
require_once(substr($rootFile, 0, $fileLength) . 'initialise.inc.php');
$template = new Template();
//注入变量应在生成编译文件之前注入
$template->assigned('array',$_array);
$template->display('admin_top.tpl');

