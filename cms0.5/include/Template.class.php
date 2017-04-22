<?php
/* *************************************************************
*	类    名：模板类 Template
*	作    用：1、用于判断系统目录是否存在;
*		  2、用于接收模板的变量;
***************************************************************/
class Template {
private $tplVar = array();		//创建模板变量数组
private $configVar = array();	//系统变量

public function __construct() {
	$this->checkDir();
	$this->assignedConfig();
}

////////////////////////////////////////////////////////////////
//函 数 名：checkDir();
//权    限：private
//参    数：void
//作    用：判断include, template, template_c, cache是否存在
///////////////////////////////////////////////////////////////
private function checkDir() {
	if(!is_dir(TPL_PATH)) {
		exit( 'template目录不存在！');
	}
	if(!is_dir(TPL_C_PATH)) {
		exit( 'template_c目录不存在！');
	}
	if(!is_dir(CACHE_PATH)) {
		exit( 'cache目录不存在！');
	}
}
////////////////////////////////////////////////////////////////
//函 数 名：display($_file);
//权    限：public
//参    数：$_file : 用于接收传过的模板文件名。
//作    用：将模板导入到php文件中
///////////////////////////////////////////////////////////////
public function display($_file) {
	//设置模板文件的路径
	$tplFile = TPL_PATH . $_file;
	//设置编译文件的路径
	$parFile = TPL_C_PATH .md5($_file) .$_file . '.php';
	//设置缓冲文件的路径
	$cacheFile = CACHE_PATH . md5($_file) .$_file . '.html';
	//判断$tplFile文件是否存在
	if(!file_exists($tplFile)) {
		exit("error：{$_file}模板文件不存在！");
	}
	//缓冲开启的第二次运行，直接载入缓冲，不运行编译程序
	if(IS_CACHE) {
		if(file_exists($cacheFile) && file_exists($parFile)) {
			//缓冲文件，模板文件，编译文件是否修改过
			if(filemtime($parFile)>=filemtime($tplFile) && filemtime($cacheFile)>=filemtime($parFile)) {
				include($cacheFile);
				return true;
			}
		}
	}
	//判断$parFile编译文件是否存在，或判断$tplFile模板文件是否修改
	//若编译文件不存在，或模板文件修改过，则导入模板内容，并生成编译文件
	if(!file_exists($parFile) || filemtime($tplFile)>filemtime($parFile)) {
		//载入解析类，对模板中的变量解析
		require_once (ROOT_PATH . '/include/Parser.class.php');
		$parser = new Parser($tplFile, $parFile);
	}
	//载入$parFile编译文件
	include ($parFile);

	//生成缓冲文件
	if(IS_CACHE) {
		file_put_contents($cacheFile, ob_get_contents());	
		ob_end_clean();
		include($cacheFile);
	}
}
////////////////////////////////////////////////////////////////
//函 数 名：assigned($_variable, $_value)
//权    限：public
//参    数：1、$_variable：模板里的变量名
//	    	2、$_value：变量值	
//作    用：声明模板中的变量
///////////////////////////////////////////////////////////////
public function assigned($_variable, $_value) {
	//判断变量名声明并且不为空
	if(isset($_variable) && !empty($_variable)) {
		$this->tplVar[$_variable] = $_value;
	}
	else {
		exit('error：请设置变量名！');
	}
}
////////////////////////////////////////////////////////////////
//函 数 名：assigned()
//权    限：private
//参    数：void
//作    用：声明系统变量
///////////////////////////////////////////////////////////////
private function assignedConfig() {
	$xml = simplexml_load_file(ROOT_PATH . '/config/profile.xml');
	$taglib = $xml->xpath('/root/taglib');
	foreach($taglib as $tag) {
		$this->configVar["$tag->name"] = $tag->value;
	}
}
////////////////////////////////////////////////////////////////
//函 数 名：create($_file)
//权    限：public
//参    数：$_file
//作    用：不需要缓冲，只编译的文件。像admin的文件和和header,footer
///////////////////////////////////////////////////////////////
public function displayNoCache($_file) {
	//设置模板文件的路径
	$tplFile = TPL_PATH . $_file;
	//设置编译文件的路径
	$parFile = TPL_C_PATH .md5($_file) .$_file . '.php';
	//判断$tplFile文件是否存在
	if(!file_exists($tplFile)) {
		exit("error：{$_file}模板文件不存在！");
	}
	//判断$parFile编译文件是否存在，或判断$tplFile模板文件是否修改
	//若编译文件不存在，或模板文件修改过，则导入模板内容，并生成编译文件
	if(!file_exists($parFile) || filemtime($tplFile)>filemtime($parFile)) {
		//载入解析类，对模板中的变量解析
		require_once (ROOT_PATH . '/include/Parser.class.php');
		$parser = new Parser($tplFile, $parFile);
	}
	//载入$parFile编译文件
	include ($parFile);
}

}
