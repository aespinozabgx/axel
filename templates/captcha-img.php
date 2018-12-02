<?php

  header("Content-type: image/png");
  $img = @imagecreatetruecolor(110,32);
  $bgcolor = imagecolorallocate($img,102,102,153);
  $letracolor = imagecolorallocate($img,255,255,255);
  session_start();
  $captcha='';
  for ($i=15; $i<95; $i+=20) {
    $captcha.=($num=rand(0,9));
    imagechar($img,rand(3,5),$i,rand(2,14),$num,$letracolor);
  }
  imagepng($img);
  imagedestroy($img);
  $_SESSION["captcha"] = $captcha;

?>
