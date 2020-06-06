<?php
$a = $_GET["url"];
function delFile($path)
{
  $url = iconv('utf-8', 'gbk', $path);
  if (PATH_SEPARATOR == ':') {
    //linux
    unlink($url);
  } else {
    //Windows
    unlink($url);
  }
}
delFile($a);
header("Location: ../file_show.html");
?>