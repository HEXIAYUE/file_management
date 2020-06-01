<style>
  .container {
    width: 100%;
    display: -webkit-flex;
    /* Safari */
    display: flex;
    overflow: hidden;
    flex-wrap: wrap;
    justify-content: space-between;
    flex: 1;
  }

  .container .itm {

    width: 23%;
    font-size: 1.6rem;
  }

  .container img {

    width: auto;
    height: 30rem;
    max-width: 100%;
    min-width: 25%;
    max-height: 100%;
    margin: 0 auto;
    vertical-align: middle;
    justify-content: space-around;
    align-items: center;
   
  }

  .itm p {
    width: 80%;
    word-break: break-word;
    height: 7rem;
    line-height: 2rem;
  }


</style>
<link rel="stylesheet" href="css/common.css" />
<div id="header">
  <p>文件预览/<a href="index.html">首页</a>/<a href=""file_show.html">文件管理</a></p>
</div>
<div class="container">
  <?php
  //图片预览
  error_reporting(0);
  header("Content-type: text/html; charset=utf-8");
  $fl = "upload";
  list_file($fl);
  // 文件夹遍历
  function list_file($date)
  {
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
        echo "<a href='" . $a . ">";
        echo "</a>";
        list_file($a); //因为是文件夹所以再次调用自己这个函数，把这个文件夹下的文件遍历出来
      } else {
        $b = getExt1($a); //变量b为文件后缀
        if (($b == "jpg") || ($b == "png") || ($b == "gif") || ($b == "jpeg") || ($b == "bmp")) {
          echo "<div class='itm'>";
          echo "<a href='$a'>";
          echo "<img src='$a' />";
          echo "</a>";
          echo "<p>";
          echo "<a href='$a'>";
          echo "$a";
          echo "</a>";
          echo "</p>";
          echo "</div>";
          $i++;
        }
      }
    }
    if($i==0){
      echo "<p style=' text-align: center;width:100%;margin-top:15%;font-size:2rem;'>";
      echo "没有图片";
      echo "</p>";
    }
  }

  // 获取文件后缀
  function getExt1($file)
  {
    return substr(strrchr($file, '.'), 1);
  }

  ?>
</div>