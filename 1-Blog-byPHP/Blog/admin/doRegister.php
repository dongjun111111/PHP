<?php
header('content-type:text/html; charset=gb2312');
error_reporting(0);
session_start();
$sessionuser=$_SESSION['sessionuser'];
if(!$sessionuser)
{
 echo "<script>alert('��ֹ�Ƿ�����');location.href='../index.php';</script>";
 exit;
}

$conn=mysql_connect('localhost','root','903456967');
mysql_select_db('blog');
mysql_query('set names gb2312');
$username=$_POST['username'];
$sex=$_POST['sex'];
$qq=$_POST['qq'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$password=$_POST['password'];
$confirm=$_POST['confirm'];
$ip=$_SERVER['REMOTE_ADDR'];

if($password != $confirm)
{
  echo "<script>alert('����������');</script>";
  exit;
}
$password=md5($password);
$isok=mysql_query("insert into admin(username,sex,email,phone,password,qq,ip,addtime,classify) values ('$username','$sex','$email','$phone','$password','$qq','$ip',now(),'һ���û�')");
if($isok)
{
  echo "<script>alert('ע��ɹ�');location.href='../index.php';</script>";
}
else
{
   echo "<script>alert('ע��ʧ��');location.href='../index.php';</script>";
}
?>