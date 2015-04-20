<?php 
session_start();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//删掉
if(isset($_POST["Submit"]) && $_POST["Submit"] == "register")
{
//
	$user = $_POST["username"];
	$psw = $_POST["password"];
	$psw_confirm = $_POST["confirm"];
	//echo $user;
	if($user == "" || $psw == "" || $psw_confirm == "")
	{
		echo "<script>alert('请确认信息完整性！'); history.go(-1);</script>";
		//echo "{\"error\":1}"; //请确认信息完整性
	}
	else
	{
		if($psw == $psw_confirm)
		{
			include ("mysql.class.php");
			$mysql=new mysql("localhost", "root", "","RunningDate");
			$result=$mysql->query("select `name` from `user` where `name`= '$user'");
			$num = mysql_num_rows($result); //统计执行结果影响的行数
			
			if($num)    //如果已经存在该用
			{
				echo "<script>alert('用户名已存在！'); history.go(-1);</script>";
				//echo "{\"error\":2}";  //用户名已存在
			}
			else    //不存在当前注册用户名称
			{
				$uuidQuery=$mysql->query("select uuid()");
				while($uuidItem=mysql_fetch_array($uuidQuery))
				{
					$uuidArray[]=$uuidItem;
				}
				$uuid=$uuidArray[0][0];
				$pwmd5=md5($psw);
				$sql_insert = "insert into `user` (`id`,`name`,`password`) values ('$uuid','$user','$pwmd5')";
				$res_insert = $mysql->query($sql_insert);
				if($res_insert)
					{
						//echo "<script>alert('注册成功！'); history.go(-1);</script>";
						//echo "{\"error\":0}";  //注册成功！ 
						$_SESSION['id']=$uuid;
						echo "<script>location.href='picture.php';</script>";
					}
				else
					{
						echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";
						//echo "{\"error\":4}";  //系统繁忙，请稍候！
					}
			}
		}
			else
			{
				echo "<script>alert('密码不一致！'); history.go(-1);</script>";
				//echo "{\"error\":3}";  //密码不一致！
			}
	}
}
//
    else
    {
        echo "<script>alert('提交未成功！'); history.go(-1);</script>";
        //echo "{error:5}" //提交未成功
    }
//
    

?>