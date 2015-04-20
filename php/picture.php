<?php 
session_start();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql.class.php");
if(isset($_SESSION['id']))
{
	echo "已登录".$_SESSION['id'];
	if(is_uploaded_file($_FILES['upfile']['tmp_name']))
	{
		if($_FILES['upfile']['error']==0)
		{
			if(move_uploaded_file($_FILES['upfile']['tmp_name'], '../../headpic/'.$_SESSION['id'].'.jpg'))
			{
				$mysql=new mysql("localhost","root", "", "runningdate");
				$mysql->query("update user set picture='/headpic/$_SESSION[id].jpg' where id='$_SESSION[id]'");
			}
			echo '上传成功';
			echo "<script>location.href='local_home.php';</script>";
		}
	}
}

else
{
	echo 'not registered';
}
?>
<form action="" enctype="multipart/form-data" method="post" name="upform">
  上传文件:
  <input name="upfile" type="file">
  <input type="submit" value="上传"><br>
 </form>