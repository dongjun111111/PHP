<?php
session_start();
$sessionuser=$_SESSION['sessionuser'];
if(!$sessionuser)
{
 echo "<script>alert('��ֹ�Ƿ�����');location.href='../index.php';</script>";
 exit;
}

$id=$_GET['id'];
$classify=$_POST['classify'];

$conn=mysql_connect('localhost','root','903456967');
mysql_select_db('blog');
mysql_query('set names utf8');

$change=mysql_query("update admin set classify='$classify' where id='$id'");
if($change)
{
 echo "<script>alert('�޸�Ȩ�޳ɹ�');location.href='allUser.php';</script>";
}
else
{
 echo "<script>alert('�޸�Ȩ��ʧ��');location.href='allUser.php';</script>";
}
?>