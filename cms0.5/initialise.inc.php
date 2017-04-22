<?php
header('Content-Type:text/html;charset=utf-8');
// 网站根目录
define( 'ROOT_PATH', dirname(__FILE__) );
//载入模板配置文件
require_once(ROOT_PATH . '/config/profile.inc.php');
//载入缓冲开关文件
require_once('./cache.inc.php');
// 加载模板类
require_once(ROOT_PATH . '/include/Template.class.php');
//数据库连接与关闭
require_once(ROOT_PATH . '/include/DataBase.class.php');
