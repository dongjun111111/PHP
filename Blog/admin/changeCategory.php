<?php
session_start();
$sessionuser=$_SESSION['sessionuser'];
if(!$sessionuser)
{
 echo "<script>alert('��ֹ�Ƿ�����');location.href='../index.php';</script>";
 exit;
}

$id=$_GET['id'];
$category=$_POST['category'];

$conn=mysql_connect('localhost','root','903456967');
mysql_select_db('blog');
mysql_query('set names utf8');

$change=mysql_query("update article set category='$category' where id='$id'");
if($change)
{
 echo "<script>alert('�޸ķ���ɹ�');location.href='allArticle.php';</script>";
}
else
{
 echo "<script>alert('�޸ķ���ʧ��');location.href='allArticle.php';</script>";
}
?>