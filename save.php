 <?php
  header("Content-type: text/html; charset=utf-8");
 //判断目录upload是否存在 如果不存在 就创建
 $drupload= "upload";
 if((file_exists($drupload))==0)
  {
mkdir($drupload);
  }
  if ($_FILES["file"]["error"] > 0) {
    echo "错误：: " . $_FILES["file"]["error"] . "<br>";
  } else {
    //php 中文转码 能够保存中文 
    $_FILES["file"]["name"] = iconv("UTF-8", "gbk", $_FILES["file"]["name"]);
    // 判断当前目录下的 upload 目录是否存在该文件
    // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777

    if (file_exists("upload/" . $_FILES["file"]["name"])) {
      echo $_FILES["file"]["name"] . " 文件已经存在。 ";
    } else {
      // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
      move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
    }
  }
header("Location: index1.php");
  ?>