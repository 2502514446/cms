<?php
require_once('template.config.php');
$template = new Template();
//注入变量应在生成编译文件之前注入
$template->assigned('name', '李勇');
$template->assigned('a', 5<4);
$template->assigned('b', 5>4);
$template->assigned('c', 1>2);
$_array = array('one'=>'lijie', 'two'=>'liyong', 'three'=>'lizhi');
$template->assigned('array',$_array);
$template->display('index.tpl');
