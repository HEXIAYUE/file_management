<?php
//文件排序
$m=$_GET["m"];
$n=$_GET["n"];
//获取文件数组
$dir = "upload"; //目录
list_file($dir, $m, $n);
function  list_file($dir, $m, $n){
if (is_dir($dir)) {
  if ($dh = opendir($dir)) {
    $i = 0;
    while (($file = readdir($dh)) !== false) {
        $file = iconv("gbk", "utf-8", $file);
      if ($file != "." && $file != "..") {
        $files[$i]["name"] = $file; //获取文件名称
        $files[$i]["size"] = round((filesize($file) / 1024), 2); //获取文件大小
        $files[$i]["time"] = date("Y-m-d H:i:s", filemtime($file)); //获取文件最近修改日期
        $i++;
      }
    
    }
  }
  closedir($dh);
  foreach ($files as $k => $v) {
    $size[$k] = $v['size'];
    $time[$k] = $v['time'];
    $name[$k] = $v['name'];
  }
    //排序
   
    //文件名
    if (($m == 0) && ($n == 0)) {
      array_multisort($name, SORT_ASC, SORT_STRING, $files); //按名字升序
    }

    if (($m == 0) && ($n == 1)) {
      array_multisort($name, SORT_DESC, SORT_STRING, $files); //按名字降序
    }
    //时间
    if (($m == 1) && ($n == 0)) {
      array_multisort($time, SORT_ASC, SORT_STRING, $files); //按时间升序
    }

    if (($m == 1) && ($n == 1)) {
      array_multisort($time, SORT_DESC, SORT_STRING, $files); //按时间降序
    }
    //大小
    if (($m == 2) && ($n == 0)) {
      array_multisort($size, SORT_ASC, SORT_STRING, $files); //按大小升序
    }

    if (($m == 2) && ($n == 1)) {
      array_multisort($size, SORT_DESC, SORT_STRING, $files); //按大小降序
    }

    clearstatcache($file);
    print_r($files);
}
}


//header("Location: index1.php");

?>