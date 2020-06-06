<?php
 header("Content-type: text/html; charset=utf-8");
$url=$_GET["url"];
$url=iconv("utf-8","gbk",$url);
$down_host = $_SERVER['HTTP_HOST'].'/'; //当前域名
    //跳转到文件下载地址，下载
header('location:http://'.$down_host.$url);


?>