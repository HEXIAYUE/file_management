<?php
//图片预览
  error_reporting(0);
  header("Content-type: text/html; charset=utf-8");

 
  $fl = "../upload";
  $result=list_file($fl);
  // 输入图片json
  echo json_encode($result,JSON_UNESCAPED_UNICODE);
  // 文件夹遍历
  function list_file($date)
  {
      $result=array();
    //1、首先先读取文件夹
    $temp = scandir($date);
      $i=0;
    //遍历文件夹
    foreach ($temp as $v) {
      
      $a = $date . '/' . $v;
      if (is_dir($a)) { //如果是文件夹则执行

        if ($v == '.' || $v == '..') { //判断是否为系统隐藏的文件.和.. 如果是则跳过否则就继续往下走，防止无限循环再这里。
          continue;
        }
    
        list_file($a); //因为是文件夹所以再次调用自己这个函数，把这个文件夹下的文件遍历出来
      } else {
        $b = getExt1($a); //变量b为文件后缀
        if (($b == "jpg") || ($b == "png") || ($b == "gif") || ($b == "jpeg") || ($b == "bmp")) {
            $result[$i]=$a;
          $i++;
        }
      }
    }
    return $result;
  }

  // 获取文件后缀
  function getExt1($file)
  {
    return substr(strrchr($file, '.'), 1);
  }

  
?>