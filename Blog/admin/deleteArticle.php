<?php
$id=$_GET['id'];
$conn=mysql_connect('localhost','root','903456967');
mysql_select_db('blog');
mysql_query('set names utf8');

session_start();
$sessionuser=$_SESSION['sessionuser'];
if(!$sessionuser)
{
 echo "<script>alert('��ֹ�Ƿ�����');location.href='../index.php';</script>";
 exit;
}

$delete=mysql_query("delete from article where id='$id'");
if($delete)
{
 echo "<script>alert('ɾ���ɹ�');location.href='allArticle.php';</script>";
}
else
{
 echo "<script>alert('ɾ��ʧ��');location.href='allArticle.php';</script>";

}
?>