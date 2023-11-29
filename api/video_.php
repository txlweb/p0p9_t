<?php
require_once("config.php");
function getVideoCover( $input, $output ) {
   $command = $API_BasePath."ffmpeg.exe -v 0 -y -i $input -vframes 1 -ss 5 -vcodec mjpeg -f rawvideo -s 286x160 -aspect 16:9 $output ";
   exec($command);
}
header('Content-Type: image/png');
getVideoCover($_GET["URL"],$API_BasePath."tmp.jpg");
$c = file_get_contents("tmp.jpg");
echo $c;
echo "video api [V1]";
?>