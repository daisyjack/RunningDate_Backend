<?php 
session_start();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
if(isset($_POST["submit"]) && $_POST["submit"] == "登陆")
{
	$user = $_POST["username"];
	$psw = $_POST["password"];
	if($user == "" || $psw == "")
	{
		echo "<script>alert('请输入用户名或密码！'); history.go(-1);</script>";
		//echo "{\'error\':1}";//信息不完整
	}
	else
	{
		$mdPass=md5($_POST['password']);
		include ("mysql.class.php");
		$mysql=new mysql("localhost", "root", "", "runningdate");
/* 		mysql_connect("localhost","root","");
		mysql_select_db("vt");
		mysql_query("set names 'gbk'");
		$sql = "select username,password from user where username = '$_POST[username]' and password = '$_POST[password]'";
		$result = mysql_query($sql); */
		$result=$mysql->query("select id,name,password from user where name='$_POST[username]' and password ='$mdPass'");
		$num = mysql_num_rows($result);
		if($num)
		{
			echo "<script>alert('登录成功！');history.go(-1);</script>";
			//echo "{\'error\':0}";//登录成功
			while($item=mysql_fetch_array($result))
			{
				$login[]=$item;
			}
			print_r($login);
			$_SESSION[id]=$login[0][id];
		}
		else
		{
			echo "<script>alert('用户名或密码不正确！');history.go(-1);</script>";
			//echo "{\'error\':2}";//用户名或密码不正确
		}
	}
}
//删除
	else
	{
		echo "<script>alert('提交未成功！'); history.go(-1);</script>";
	}
//删除

?>