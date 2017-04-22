<?php
require_once( './initialise.inc.php');
$template = new Template();
//注入变量应在生成编译文件之前注入
$template->assigned('array',$_array);
$template->display('index.tpl');
