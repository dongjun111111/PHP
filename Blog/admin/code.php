<?php
header("content-type:image/png");//头文件声明类型
$db=imagecreate(50,25);//大小，宽，高
$b=imagecolorallocate($db,0,204,102);//图片颜色 这里图片颜色的位置一定要是图片本身的颜色在上面，下面是字体颜色，不然会出错
$f=imagecolorallocate($db,255,255,255);//字体颜色
$s="";
for($i=0;$i<4;$i++)
{
 $k=mt_rand(0,9);
 $s.=$k;
}
session_start();
$_SESSION['code']=$s;
imagestring($db,5,5,5,$s,$f);//第一个数字为字体大小，第二个为字体距左距离，第三个是距顶部距离
//imagefill($db,0,0,$b);//画图非必须
imagepng($db);
$sessionuser=$_SESSION['sessionuser'];
if(!$sessionuser)
{
 echo "<script>alert('禁止非法访问');location.href='../index.php';</script>";
}
?>
