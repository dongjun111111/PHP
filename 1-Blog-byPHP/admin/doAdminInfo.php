<?php
header("content-type:text/html; charset=gb2312");
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

$id=$_POST['id'];
$username=$_POST['username'];
$photo=$_FILES['photo'];
$sex=$_POST['sex'];
$qq=$_POST['qq'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$ip=$_SERVER['REMOTE_ADDR'];
$isphoto=isset($_FILES['photo']['size'])?$_FILES['photo']['size']:0;
if($isphoto > 0)
{
    $arr=explode(".",$_FILES['photo']['name']);//���ļ�������ֳ�����
    $hz=$arr[count($arr)-1];//ȡ���ļ���׺��
	$filepath="../uploads/";//�����ļ��ϴ�·��
	$randname=date("Y").date("m").date("d").date("H").date("i").date("s").rand(100,999).".".$hz;//������
	if(is_uploaded_file($_FILES['photo']['tmp_name']))
	{
	 if(move_uploaded_file($_FILES['photo']['tmp_name'],$filepath.$randname))
		{
		echo "�ϴ��ɹ�";
		}
		else
		{
		 echo "�ϴ�ʧ��";
		}
	}
	else
	{
	 echo "����һ���ϴ��ļ�";
	 exit;
	  }

   $photo=$filepath.$randname;

    $result=mysql_query("update admin set username='$username',photo='$photo',sex='$sex',qq='$qq',ip='$ip',phone='$phone',email='$email' where id='$id'");
	if(isset($result))
	{
	 echo "<script>alert('�޸ĳɹ�');location.href='../index.php';</script>";
	}
	else
	{
	 echo "<script>alert('�޸�ʧ��');location.href='../index.php';</script>";
	}
}

else
{
	$result=mysql_query("update admin set username='$username',sex='$sex',qq='$qq',ip='$ip',phone='$phone',email='$email' where id='$id'");
	if(isset($result))
	{
	 echo "<script>alert('�޸ĳɹ�');location.href='../index.php';</script>";
	}
	else
	{
	 echo "<script>alert('�޸�ʧ��');location.href='../index.php';</script>";
	}

}

?>