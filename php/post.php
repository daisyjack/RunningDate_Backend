<?php 
session_start();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include ("mysql.class.php");
if($_POST['submit'])
{
	$mysql=new mysql("localhost", "root", "", "runningdate");
	$result=$mysql->query("insert into `poster` (`id`,`time`,`place`,`slogan`) values ('$_SESSION[id]','$_POST[time]','$_POST[place]','$_POST[slogan]')");
	if($result)
	{
		echo 成功！;
		echo "<script>location.href='local_home.php';</script>";
	}
	else 
		echo 发布失败，请重试！;
}

?>
  <form action="post.php" method="post"  >
  时间：<input type="text" size="10" name="time" /><br>
  地点：<input type="text" name="place" /><br/>
  约跑宣言：<textarea name="slogan"  cols="60" rows="9"></textarea><br/>

  <input type="submit" name="submit" value="约约约！"/>
  </form>