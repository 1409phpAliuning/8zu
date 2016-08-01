<?php
namespace app\up;
/*
$file文件的具体信息
$type文件的格式信息
$size文件的大小信息
$name数据库的路径名字
$table数据库表名
$web 添加成功后跳转的具体网站
*/
class Up{
	public static $type=array('audio/mpeg','image/jpg', 'image/gif', 'image/png', 'image/jpeg','video/mp4','video/x-ms-wmv','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','text/plain','application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	public static $size=947194367;
	public static function image($file){
		if(!in_array($file['type'],Up::$type)){
			die("文件类型不支持");
		}
		//判断文件大小是否符合要求
		if($file['size']>Up::$size){
			die("文件过大不支持");
		}
		//判断上传文件的信息如有错误输出相关错误信息
		switch($file['error']){
			case 1: die("文件超过PHPini配置<br>");break;
			case 2: die("文件超过表单最大值<br>");break;
			case 3: die("文件只上传部分<br>");break;
			case 4: die("没有文件上传<br>");break;
		}
		//生成文件名字
		$path="image/".date('Y').'/'.date('m').'/'.date('d').'/';
		//判断文件路径是否存在
		is_dir($path) or mkdir($path,0777,true);
		//截取后缀
		$last=substr($file['name'],strrpos($file['name'],"."));
		//重新命名
		$newname=time().rand(10000,99999).$last;
		//生成路径
		$way=$path.$newname;
		//移动到指定文件夹
		move_uploaded_file($file['tmp_name'],$way);
		//返回路径
		return $way;
	}
}
