<?php
header("content-type:text/html; charset=gb2312");

$file=fopen("copyRight.txt","r")or die("��ȡ��Ȩ�ļ�ʧ��");
echo fread($file,filesize("copyRight.txt"));
fclose($file);
?>