<?php
header('Content-Type:text/html;charset=utf-8');
// 网站根目录
define( 'ROOT_PATH', dirname(__FILE__) );
// 模板目录
define( 'TPL_PATH', ROOT_PATH.'/template/'  ); 
// 编译目录
define( 'TPL_C_PATH', ROOT_PATH.'/template_c/'  ); 
// 缓冲目录
define( 'CACHE_PATH', ROOT_PATH.'/cache/'  ); 
//缓冲开关
define('IS_CACHE', true);
IS_CACHE ? ob_start() : null;
// 加载模板类
require (ROOT_PATH.'/include/Template.class.php');
