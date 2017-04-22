<?php
/* *************************************************************
*	 类名：检查数据	CheckData
*	 作用：对表单的数据进行检查
***************************************************************/
class CheckData {

////////////////////////////////////////////////////////////////
//函 数 名：checkDataEmpty($data);
//权    限：static public
//参    数：$data：接受数据
//作    用：对数据检查是否为空
///////////////////////////////////////////////////////////////
static public function checkDataEmpty($data) {
	if(trim($data) == '') {
		return 1;
	}
	return 0;
}
////////////////////////////////////////////////////////////////
//函 数 名：checkDataLength($data, $length, $flag);
//权    限：static public
//参    数：1、$data：接受数据
//			2、$length：接受长度
//			3、$flag：接受模式
//作    用：对数据长度的检查
///////////////////////////////////////////////////////////////
static public function checkDataLength($data, $length, $flag) {
	switch($flag) {
		case 'min' :
			if(mb_strlen(trim($data), 'utf-8') < $length) {
				return 1;
			}
			break;
		case 'max' :
			if(mb_strlen(trim($data), 'utf-8') > $length) {
				return 1;
			}
			break;
		default :
			echo "<script type='text/javascript'>
					alert('数据有误');		
				</script>";
	}
	return 0;
}
////////////////////////////////////////////////////////////////
//函 数 名：checkDataEquals($data, $yes_data);
//权    限：static public
//参    数：1、$data：接受数据
//			2、$yes_data：接受另一个数据与上一个比较
//作    用：对数据的相等检查
///////////////////////////////////////////////////////////////
static public function checkDataEquals($data, $yes_data) {
	if(trim($data) != trim($yes_data)) {
		return 1;
	}
	return 0;
}

}
