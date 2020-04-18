<style>
  * {
    margin: 0;
    padding: 0;
  }

  html {
    font-size: 62.5%;
    background-color: #e3e3e3;
    height: 100%;
  }

  body {
    font-size: 1.6rem;
  }

  #header {
    width: 100%;
    overflow: hidden;
  }

  #header p {
    width: 100%;
    text-align: center;
    padding-top: 2rem;
    font-size: 2.5rem;
    letter-spacing: 2rem;
  }

  button {
    width: 7rem;
    height: 2.5rem;

  }

  a {
    text-decoration: none;
    color: #000;
  }

  a:hover {
    color: red;
  }

  #body {
    overflow: hidden;
    text-align: center;
  }

  table {
    margin: auto;
  }

  th,
  td {
    width: 20rem;
    height: 3rem;
    text-align: center;
  }

  td:nth-child(1) {
    width: 30rem;
  }
</style>


<div id="header">
  <p>文件管理/<a href="index.html">首页</a>/
  <a href="imgshow.php">图片预览</a>
</p>
</div>



<div id="body">
  <table border="2rem" cellspacing="0" align="center">
    <tr>
      <th>文件名</th>
      <th>大小</th>
      <th>上传时间</th>
      <th>下载</th>
      <th>删除</th>

    </tr>
    <?php
    error_reporting(0);
    header("Content-type: text/html; charset=utf-8");

    // 文件夹遍历
    //展示文件
    $fl = "upload";
    list_file($fl);
    // 文件夹遍历
    function list_file($date)
    {
      //1、首先先读取文件夹
      $temp = scandir($date);

      //遍历文件夹
      foreach ($temp as $v) {
        $a = $date . '/' . $v;
        if (is_dir($a)) { //如果是文件夹则执行

          if ($v == '.' || $v == '..') { //判断是否为系统隐藏的文件.和.. 如果是则跳过否则就继续往下走，防止无限循环再这里。
            continue;
          }
          echo "<a href='" . $a . ">";
          echo "</a>";
          list_file($a); //因为是文件夹所以再次调用自己这个函数，把这个文件夹下的文件遍历出来
        } else {
          echo "<tr>";
          //php 中文转码 把中文文件显示出来   
          // $a = iconv("gbk", "UTF-8", $a);linux不用
          //文件名
          $a = iconv("gbk", "utf-8", $a);
          echo "<td> ";

          echo $a;

          echo "</td>";
          //大小
          //获取文件大小  转码
          $a = iconv("utf-8", "gbk", $a);
          echo "<td>";
          $size= filesize($a);
          if(($size/1024)<1)
          {
            echo  round($size) ."B";
          }
          else{
             if($size/(1024*1024)<1)
              echo  round($size/1024) . "KB";
             
              else {
              if ($size / (1024 * 1024*1024) < 1)
                echo  round($size/(1024 * 1024)) . "M";
               
              else{
                if ($size / (1024 * 1024 * 1024*1024) < 1)
                  echo  round($size/(1024 * 1024*1024)) . "G";
              }
              }
          }

          echo "</td>";
          //上传时间
          echo "<td>";
          echo date("Y-m-d H:i:s", filemtime($a));
          echo "</td>";
          //下载
          $a = iconv("gbk", "utf-8", $a);
          echo "<td>";
          echo "<button>";
          echo "<a href=' $a' download >";
          echo "下载";
          echo "</a>";
          echo "</button>";
          echo "</td>";
          //删除
          //$a = iconv("utf-8", "gbk", $a);
          echo "<td>";
          echo "<button>";
          echo "<a href='del.php?url=$a'>";
          echo "删除";
          echo "</a>";
          echo "</button>";
          echo "</td>";



          echo "</tr>";
        }
      }
    }

    ?>

  </table>
</div>