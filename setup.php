<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
    .code{
        background-color: black;
        color: whitesmoke;
        width: 500px;
        border-radius: 10px;
        padding: 15px;
    }
    input{
        background-color: black;
        color: orange;
        width: 280px;
        border: 0;
        font-size: 16px;
        opacity: 0.9;
    }
    input:hover{
        opacity:1;
    }
    d{
        color: greenyellow;
    }
    r{
        color: red;

    }
    .btn{
        padding: 5px;
        margin: 5px;
        width: 80px;
        height: 23px;
        background-color: #F26D7D;
        border-radius: 5px;
        color: #fff;
        font-size: 16px;
        text-align: center;
        display: inline-block;
    }
    .btn:hover{
        color: black;
        background-color: #ffacb6;
        
    }
    bk{
        color: beige;
    }
    .edit_main{
        width: 530px;
        margin: 0 auto;
        margin-top: auto;
        border-radius: 20px;
        background-color: #51a1ff;
        padding: 20px;
        padding-bottom: 50px;
    }
</style>
<div class="edit_main">
<?php
if($a=str_replace("\\","\\\\",$_GET["a"])){
    $b=str_replace("\\","\\\\",$_GET["b"]);
    $c=str_replace("\\","\\\\",$_GET["c"]);
    $d=str_replace("\\","\\\\",$_GET["d"]);
    $filepath = 'api/config.php';
    $s='<?php'."\r\n";
    $s=$s.'$API_BasePath = "'.$a.'";'."\r\n";
    $s=$s.'$VIDEO_BasePath = "'.$c.'";'."\r\n";
    $s=$s.'$VIDEO_BasePathURL = "'.$d.'";'."\r\n";
    $fopen = fopen($filepath,"wb")or die("E:文件不存在");
    fwrite($fopen,$s);
    fclose($fopen);
    $fp = fopen("index.htm_","r");
    $info = fread($fp,filesize("index.htm_"));
    fclose($fp);
    $s=str_replace("[#API#]",$b,$info);
    $fopen = fopen("index.html","wb")or die("E:文件不存在");
    fwrite($fopen,$s);
    fclose($fopen);
    ?>
<h1>NASVIDEO project V1 [SETUP]</h1>
<h3>Power by IDlike</h3>
<h2>Step 2/2 完成配置</h2>
<h1>所有步骤都已完成,setup配置程序仍可以再次重新配置,如果需要删除请手动删除.</h1>
    <?
    exit();
}

?>
<h1>NASVIDEO project V1 [SETUP]</h1>
<h3>Power by IDlike</h3>
<h2>Step 1/2 检查配置信息是否正确并配置视频目录</h2>

<div class="code">
<?php
$path = __FILE__;
echo " 00| <r>[Config]</r>";
echo "<br/>";
echo " 01| <d>SETUP_FILE</d> = " . $path;
echo "<br/>";
echo " 02| <bk>#配置器所在的绝对位置</bk>";
echo "<br/>";
echo " 03| <d>API_BasePath</d> = <input value='" . substr($path,0,strlen($path)-9) . "api\\' id='a'>";
echo "<br/>";
echo " 04| <bk>#api所在的绝对位置 (用于确定ffmpeg位置)</bk>";
echo "<br/>";
echo " 05| <d>base_server</d> = <input value='http://" . $_SERVER['SERVER_ADDR'] . "/api/' id='b'>";
echo "<br/>";
echo " 06| <bk>#api所在的相对位置 (使用./api/可以仅在服务端配置h5前端页.)</bk>";
echo "<br/>";
echo " 07| <d>VIDEO_BasePath</d> = <input value='C:\\video\\' id='c'>" ;
echo "<br/>";
echo " 08| <bk>#配置视频绝对位置</bk>";
echo "<br/>";
echo " 09| <d>VIDEO_BasePathURL</d> = <input value='/video/' id='d'>" ;
echo "<br/>";
echo " 10| <bk>#配置视频相对位置</bk>";
?>
</div>
<br>
<br>
<a class="btn" onclick="sub()">完成配置</a>
<script>
    function sub(){
        var val = document.getElementById('a').value+"&b="+document.getElementById('b').value+"&c="+document.getElementById('c').value+"&d="+document.getElementById('d').value;
        window.location.href = "?a="+val;
    }
</script>
</div>