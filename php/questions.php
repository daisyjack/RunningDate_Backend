<?php 
session_start();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include ("mysql.class.php");

$mysql=new mysql("localhost", "root", "", "runningdate");
$group=1;
$result=$mysql->query("select `content`,`a`,`b`,`c`,`d` from `questions` where `group`=$group order by `order`");
while ($question=mysql_fetch_array($result))
{
	$questions[]=$question;
}
$que_num=mysql_num_rows($result);
//echo $que_num;
for ($i=0;$i<$que_num;$i++)
{
	?>
	<form action="questions.php"  method="post">
	<?php echo ($i+1).'.'.$questions[$i]['content']?><br/>
	a.<?php echo $questions[$i][a]?>
	b.<?php echo $questions[$i][b]?>
	c.<?php echo $questions[$i][c]?>
	d.<?php echo $questions[$i][d]?>
</form>
	<?php 
}
?>
  <form action="questions.php" method="post"">
  请输入答案（字母小写，不加空格）eg:abcda<br/>
  答案：<input type="text" size="10" name="answers" />
  <input type="submit" name="submit" value="提交答案"/>


  </form>
<?php
if($_POST['submit'])
{
	$mysql=new mysql("localhost", "root", "", "runningdate");
	$result=$mysql->query("insert into `answers` values('$_SESSION[id]',$group,'$_POST[answers]')");
	if($result)
		echo 成功;
	else
		echo 请勿重复提交！;
	echo "<script>location.href='local_home.php';</script>";
}
?>