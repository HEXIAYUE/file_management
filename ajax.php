          <?php
      error_reporting(0);
      header("Content-type: text/html; charset=utf-8");
      $file = "upload";
      function list_file($data)
      {
        $i = 0;
        //1、首先先读取文件夹
        $temp = scandir($data);
        //遍历文件夹
        foreach ($temp as $v) {
          $a = $data . '/' . $v;
          if (is_dir($a)) {//如果是文件夹则执行

            if ($v == '.' || $v == '..') {//判断是否为系统隐藏的文件.和..  如果是则跳过否则就继续往下走，防止无限循环再这里。
              continue;
            }


            list_file($a);//因为是文件夹所以再次调用自己这个函数，把这个文件夹下的文件遍历出来
          } else {
            //名字
            $v=iconv("gbk","utf-8",$v);//linux
            $name = $v;
            $a=iconv("gbk","utf-8",$a);//linux
            //大小
            //获取文件大小  转码
            $a=iconv("utf-8","gbk",$a);//linux
            $size = filesize($a);

            if (($size / 1024) < 1) {
              $size =  round($size) . "B";
            } else {
              if ($size / (1024 * 1024) < 1)
                $size =   round($size / 1024) . "KB";
              else {
                if ($size / (1024 * 1024 * 1024) < 1)
                  $size =  round($size / (1024 * 1024)) . "M";
                else {
                  if ($size / (1024 * 1024 * 1024 * 1024) < 1)
                    $size = round($size / (1024 * 1024 * 1024)) . "G";
                }
              }
              clearstatcache();
            }

            //上传时间
             $a=iconv("gbk","utf-8",$a);//linux
             $a=iconv("utf-8","gbk",$a);//linux
            $date = date("Y-m-d H:i:s", filemtime($a));
            //文件地址
             $a=iconv("gbk","utf-8",$a);//linux
             $url=$a;
            //转化成json对象
            $result[$i] = array(
              "name" => $name,
              "size" => $size,
              "time" => $date,
              "url" => $url,
            );
            $i = $i + 1;
          }

        }
        return  $result;
      }
      $result = list_file($file);
      echo json_encode($result);//JSON_UNESCAPED_UNICODE让中文不编码
      ?>