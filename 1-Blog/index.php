<?php
header("content-type:text/html; charset=utf-8");
session_start();
$username=$_SESSION['sessionuser'];

$conn=mysql_connect('localhost','root','903456967');
mysql_select_db('blog');
mysql_query('set names utf8');

$result=mysql_query("select * from admin where username='$username'");
while($row=mysql_fetch_array($result))
{
  $id=$row['id'];
  $photo=$row['photo'];
  $username=$row['username'];
}

$showArticle=mysql_query("select * from article limit 4");
?>
<!doctype html>
<html>
<head>
<title>首页</title>
<meta charset="utf-8">
<meta name="Author" content="">
<meta name="Keywords" content="">
<meta name="Descriptions" content="">
<link href="./css/init.css" rel="stylesheet" type="text/css">
<link href="./css/index.css" rel="stylesheet" type="text/css">
<link href="./css/index-article.css" rel="stylesheet" type="text/css">
</head>
<body>
<h1>D-Jason</h1>
<div id="header">
<ul>
	<li><a href="index.php">首页</a></li>
	<li><a href="article.php">文章</a></li>
    <li><a href="tucao.php">吐槽</a></li>
</ul>
<p>
<?php
if(!$username)
{ echo '
 <a href="javascript:void(0)" onclick="start()"><img src="./images/login.png" height="80px" width="80px" alt="Login" /></a>
 ';
}
else
{
	$photo=substr($photo,1);
  echo '
 <a href="./admin/adminInfo.php?id='.$id.'"><img  style="margin-top:10px;" src="'.$photo.'" height="40px" width="40px" alt="'.$username.'"/></a><a href="loginOut.php" ><b>登出</b></a>
   ';
}
?>
</p>
</div>

<div id="container">
<div class="left"></div>
<div class="content">
<div class="focus">
焦点图
</div>



<div class="content-show"><!--一次显示4个，每个高17em,border为0.5em-->
<div class="show-article">
<ul>
<?php
while($rows=mysql_fetch_array($showArticle))
{
echo '
<li><div style="height:17em;width:100%;background:#093;">
<h2>'.$rows['title'].'</h2>
<span style="position:absolute;margin-top:-0.5em;margin-left:26em;font-size:0.8em;">'.$rows["author"].' 发表于'.$rows["createtime"].'&nbsp <img src="./images/star.png" height="16px" width="16px" alt="star"/>'.$rows["vote"].'</span>
<div>'.$rows["content"].'</div>
<p><a href="./admin/articleDetail.php?id='.$rows["id"].'" style="float:right;color:white;">阅读原文</a></p>
</div></li><hr style="height:0.5em;background:#F5F5F5;">
';
}
?>
</ul>
</div>



</div>
<div class="content-createnew1">
在这里显示每日科技新闻，来自其他网站
</div>
<div class="content-createnew2">
在这里显示精彩吐槽
</div>
<div class="content-bottom">
待定模块
</div>
</div>
<div class="right"></div>
</div>

<div id="footer">
<p><a href="copyRight.php">版权声明</a>&nbsp|&nbsp<a href="http://dongjun111111.github.io/D-Jason.html">关于作者</a>&nbsp|&nbsp<a href="contact.php">联系作者</a></p><br>
<p>Copyright © 1998 - 2015 D-Jason. All Rights Reserved</p>
</div>

<div id="login">
<p><a href="javascript:void(0)" onclick="login('none')">X</a></p>
<form action="./admin/doLogin.php" method="post">
姓名:<input type="text" name="username" placeholder="请输入您的姓名" /><br>
密码:<input type="password" name="password" placeholder="请输入您的密码" /><br>
<p>验证:<input type="text" name="confirm" class="confirm" placeholder="请输入验证码" /><img src="./admin/code.php" height="30em" width="60em" alt="confirm" /></p>
<input type="submit" value="登录" class="submit" />
</form>
<p style="position:relative;margin:-2em 3em;"><a href="./admin/register.php">没有账号?去注册</a></p>
</div>
<script  src="./js/login.js"></script>
</body>
</html>