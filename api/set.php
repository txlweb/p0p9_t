<?php
include("config.php");
if(!$file=$_GET['f']){
    exit("E:NO API THIS!");
}
if($a=$_GET['a']){#写入文件
    $a=$_GET['a'];
    
    if(strpos($a,"<") == FALSE && strpos($a,"?") == FALSE){
        echo $a;
        $filepath = $VIDEO_BasePathURL.'/'.$file;
        $fopen = fopen($filepath,"wb")or die("文件不存在");
        fwrite($fopen,str_replace("[rn]","\r\n",$a));
        fclose($fopen);
        echo '<script>window.location.href = "?f='.$file.'";alert("保存成功!");</script>';
    }else{
        exit('<script>window.location.href = "?f='.$file.'";alert("保存失败! 由于检测到文本中包含违禁字!(< ?)");</script>');
    }
}
$fp = fopen($VIDEO_BasePathURL.'/'.$file,"r");
$info = fread($fp,filesize($VIDEO_BasePathURL.'/'.$file));
fclose($fp);
$infox = explode(PHP_EOL,$info);
$infox[3]=str_replace("\\","/",$infox[3]);
if (count($infox) < 5){
    $infox[0]=substr($file,0,strlen($file)-4);
    $infox[1]="-";
    $infox[2]=$VIDEO_BasePathURL.'/'.substr($file,0,strlen($file)-4);
    $infox[3]=str_replace("\\","/",$VIDEO_BasePath).'/'.substr($file,0,strlen($file)-4);
    $infox[4]="0";
}
?>
<style>
    .edit_main{
        width: 400px;
        margin: 0 auto;
        margin-top: auto;
        font-size: 20px;
        background-color: #ffacb6;
        padding: 20px;
        padding-bottom: 50px;
    }
    input{
        width: 100%;
        height: 30px;
    }
    button{
        margin: 0 auto;
        width: 70px;
        height: 30px;
        float: right;
    }
    h1{
        text-align:center
    }
</style>
<div class="edit_main">
    <h1><?=$file; ?></h1>
    名字:<input type="text" value="<?=$infox[0]; ?>" id="a"><br>
    简介:<input type="text" value="<?=$infox[1]; ?>" id="b"><br>
    服务器视频地址:<input type="text" value="<?=$infox[2]; ?>" id="c"><br>
    本地视频地址:<input type="text" value="<?=$infox[3]; ?>" id="d"><br>
    分级(类):<input type="text" value="<?=$infox[4]; ?>" id="e"><br>
    <br>
    <button onclick="sub()">保存</button>

</div>
<script>
    function sub(){
        var val = document.getElementById('a').value+"[rn]"+document.getElementById('b').value+"[rn]"+document.getElementById('c').value+"[rn]"+document.getElementById('d').value+"[rn]"+document.getElementById('e').value;
        window.location.href = "?f=<?=$file ?>&a="+val;
    }
</script>