<?php
header('Access-Control-Allow-Origin: *');
require_once("config.php");
if(!$dir = $_GET["spase"]){#有传入的搜索视频位置就用
	//$dir=$VIDEO_BasePathURL;#否则使用配置文件里的
}


echo '{"test":"","data":[{"name":"","tell":"","path":"","REL_path":""}';
vid_scan($VIDEO_BasePathURL);
echo ']}';


function vid_scan($dir){
	$str = opendir($dir);
	while( ($filename = readdir($str)) !== false ){
		if($filename != "." && $filename != ".."){
			if (!is_file($dir.'/'.$filename)){
				//vid_scan($dir.'/'.$filename);
			}else{
				if (strtoupper(substr($filename,strlen($filename)-4)) == ".VFG"){//配置文件格式
					#读取信息
					$fp = fopen($dir.'/'.$filename,"r");
					$info = fread($fp,filesize($dir.'/'.$filename));
					fclose($fp);
					$infox = explode(PHP_EOL,$info);
					if (count($infox) >= 5){
						/*
						@ *.VFG 视频自述文件
						视频名称
						说明/简介
						-web绝对路径
						-硬盘绝对路径
						星级/分类
						*/
						echo ',{"name":"'.$infox[0].'","tell":"'.$infox[1].'","path":"'.$infox[2].'","REL_path":"'.$infox[3].'","sort":"'.$infox[4].'","id":"'.$filename.'"}';
					}else{#如果有文件但数据不全则抛出个异常读取.
						echo ',{"name":"","tell":"E:文件内数据校验错误('.$dir.'/'.$filename.')","path":"","REL_path":"","sort":"","id":""}';
					}
				}
				if (strtoupper(substr($filename,strlen($filename)-4)) == ".MP4"
				|| strtoupper(substr($filename,strlen($filename)-4)) == ".AVI"
				|| strtoupper(substr($filename,strlen($filename)-4)) == ".MPG"
				|| strtoupper(substr($filename,strlen($filename)-4)) == ".MOV"
				|| strtoupper(substr($filename,strlen($filename)-4)) == ".AVI"
				|| strtoupper(substr($filename,strlen($filename)-5)) == ".MPEG"
				|| strtoupper(substr($filename,strlen($filename)-4)) == ".RAM"
				|| strtoupper(substr($filename,strlen($filename)-3)) == ".RM"
				){
					if(!is_file($dir.'/'.$filename.'.VFG')){
						echo ',{"name":"'.$filename.'","tell":"","path":"'.$dir.'/'.$filename.'","REL_path":"'.$VIDEO_BasePath.'/'.$dir.'/'.$filename.'","sort":"-1","id":"'.$filename.'.VFG"}';
					}
					
				}
			}
		}
	}
	closedir($str);
}