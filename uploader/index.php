<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$ret=array('strings'=>$_POST,'error'=>'0');

	$fs=array();

	// 枚举所有提交的文件
	foreach ( $_FILES as $name=>$file ) {

		$fn=$file['name'];
		$ft=strrpos($fn,'.',0);
		$fm=substr($fn,0,$ft);
		$fe=substr($fn,$ft);
		$fp='files/'.$fn;
		$fi=1;
		while( file_exists($fp) ) {	// 当提交的文件已经存在时则重命名
			$fn=$fm.'['.$fi.']'.$fe;
			$fp='files/'.$fn;
			$fi++;
		}

		// 将临时文件保存到files目录
		move_uploaded_file($file['tmp_name'],$fp);

		$fs[$name]=array('name'=>$fn,'url'=>$fp,'type'=>$file['type'],'size'=>$file['size'],);
	}

	$ret['files']=$fs;

	// 输出返回数据格式
	echo json_encode($ret);
}else{
	echo "{'error':'Unsupport GET request!'}";
}

?>
