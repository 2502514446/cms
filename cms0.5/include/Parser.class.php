<?php
/* *************************************************************
*	 类名：模板解析类 Parser
*	 作用：获取模板内容->解析模板中的变量->输出编译文件
***************************************************************/
class Parser {
private $tplContent;		//保存模板内容
private $parFile;			//接收编译文件路径

////////////////////////////////////////////////////////////////
//函 数 名：__construct($tplFile);
//权    限：public
//参    数：1、$tplFile : 用于接收传过的模板文件路径。
//	  		  2、$_parFile：用于接收传过的编译文件路径
//作    用：获取模板内容。
///////////////////////////////////////////////////////////////
public function __construct($_tplFile, $_parFile) {
	//接收模板内容
	$this->tplContent = file_get_contents($_tplFile);
	//接收编译文件路径
	$this->parFile = $_parFile;
	//解析模板并生成编译文件
	$this->compile();
}
////////////////////////////////////////////////////////////////
//函 数 名：compile();
//权    限：private
//参    数：void
//作    用：解析模板中的变量,并生成编译文件
///////////////////////////////////////////////////////////////
private function compile() {
	if( !$this->tplContent ) {
		exit('error：模板内容获取错误！');	
	}	 
	//解析模板变量
	$this->parserConfigVariable();
	$this->parserNote();
	$this->parserInclude();
	$this->parserVariable();
	$this->parserIf();
	$this->parserForeach();
	//生成编译文件
	if( !file_put_contents($this->parFile, $this->tplContent) ) {
		exit('error：编译文件生成失败！');
	}
}
////////////////////////////////////////////////////////////////
//函 数 名：parserConfigVariable();
//权    限：private
//参    数：void
//作    用：解析<!--{webname}-->系统变量
///////////////////////////////////////////////////////////////
private function parserConfigVariable() {
	$pattenConfigVariable = '/<!--\{\s*([a-zA-Z0-9_]+)\s*\}-->/';
	if(preg_match($pattenConfigVariable, $this->tplContent)) {
		$this->tplContent = preg_replace($pattenConfigVariable, "<?php echo \$this->configVar['$1']; ?>", $this->tplContent);
	}
}
////////////////////////////////////////////////////////////////
//函 数 名：parserNote();
//权    限：private
//参    数：void
//作    用：解析{#}注释
///////////////////////////////////////////////////////////////
private function parserNote() {
	$pattenNote = '/\{#\}(.*)\{#\}/';
	if(preg_match($pattenNote, $this->tplContent)) {
		$this->tplContent = preg_replace($pattenNote, "<?php /* $1  */ ?>", $this->tplContent);
	}
}
////////////////////////////////////////////////////////////////
//函 数 名：parserInclude();
//权    限：private
//参    数：void
//作    用：解析include语句
///////////////////////////////////////////////////////////////
private function parserInclude() {
	$pattenInclude = '/\{include\s+\"\s*([a-zA-Z0-9_\.\-\/]+)\s*\"\}/';
	$file = null;		//用于保存$pattenInclude正则中的表达式
	if(preg_match($pattenInclude, $this->tplContent, $file)) {
		if(!file_exists($file[1]) || empty($file[1])) {
			exit("$file[1]包含文件出错！");
		}
		$this->tplContent = preg_replace($pattenInclude, "<?php include('$1'); ?>", $this->tplContent);
	}
}
////////////////////////////////////////////////////////////////
//函 数 名：parserVariable();
//权    限：private
//参    数：void
//作    用：解析$variable普通变量
///////////////////////////////////////////////////////////////
private function parserVariable() {
	$pattenVariable = '/\{\$([a-zA-Z0-9_]+)\}/';
	if( preg_match($pattenVariable, $this->tplContent) ) {
		$this->tplContent = preg_replace($pattenVariable, "<?php echo \$this->tplVar['$1']; ?>", $this->tplContent);
	}
}
////////////////////////////////////////////////////////////////
//函 数 名：parserIf();
//权    限：private
//参    数：void
//作    用：解析if语句
///////////////////////////////////////////////////////////////
private function parserIf() {
	$pattenIf = '/\{if\s+\$([a-zA-Z0-9_]+)\}/';
	$pattenEndIf = '/\{\/if\}/';
	$pattenElse = '/\{else\}/';
	$pattenElseIf = '/\{elseif\s+\$([a-zA-Z0-9_]+)\}/';
	if( preg_match($pattenIf, $this->tplContent) ) {
		if(preg_match($pattenEndIf, $this->tplContent) ) {
			$this->tplContent = preg_replace($pattenIf, "<?php if(\$this->tplVar['$1']) {  ?>", $this->tplContent);
			$this->tplContent = preg_replace($pattenEndIf, "<?php }  ?>", $this->tplContent);
		if( preg_match($pattenElseIf, $this->tplContent) ) {
			$this->tplContent = preg_replace($pattenElseIf, "<?php } elseif(\$this->tplVar['$1']) {  ?>", $this->tplContent);
		}
		if( preg_match($pattenElse, $this->tplContent) ) {
			$this->tplContent = preg_replace($pattenElse, "<?php } else {  ?>", $this->tplContent);
		}
		}
		else {
			exit('error：if语句没有关闭！');
		}
	}
}
////////////////////////////////////////////////////////////////
//函 数 名：parserForeach();
//权    限：private
//参    数：void
//作    用：解析foreach语句
///////////////////////////////////////////////////////////////
private function parserForeach() {
	$pattenVariable = '/\{@([a-zA-Z0-9_]+)([a-zA-Z0-9_\-\>]*)\}/';
	$pattenForeach = '/\{foreach\s+\$([a-zA-Z0-9_]+)\s*\(([a-zA-Z0-9_]+)\s*\,\s*([a-zA-Z0-9_]+)\s*\)\s*\}/';
	$pattenEndForeach = '/\{\/foreach\}/';
	if( preg_match($pattenForeach, $this->tplContent) ) {
		if( preg_match($pattenEndForeach, $this->tplContent) ) {
			$this->tplContent = preg_replace($pattenForeach, "<?php foreach(\$this->tplVar['$1'] as \$$2=>\$$3) { ?>", $this->tplContent );
			$this->tplContent = preg_replace($pattenVariable, "<?php echo \$$1$2 ?>", $this->tplContent  );
			$this->tplContent = preg_replace($pattenEndForeach, "<?php } ?>", $this->tplContent);
		}
		else {
			exit('error：foreach语句没有关闭！');
		}
	}
}

}
