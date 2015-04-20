<?php 
session_start();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql.class.php");
$id=$_SESSION[id];
$mysql=new mysql("localhost", "root", "", "runningdate");
$result=$mysql->query("select * from `poster` natural join `answers` where id='$id' limit 0,1");
while($item=mysql_fetch_array($result))
{
	print_r($item);
	$time=$item[time];
	$place=$item[place];
	$answers=$item[answers];
}
$result_m=$mysql->query("select * from `user` natural join `poster` natural join `answers` where  `id`<>'$id' and `time`='$time' and `place`='$place' 
		and `answers`='$answers'  limit 0,1");
/* $result_m=$mysql->query("select * from `user` natural join `poster` natural join `answers` where `time`='$time' and `place`='$place'
and `answers`='$answers'  limit 0,1"); */
$num_m=mysql_num_rows($result_m);
if($result_m)
{
	if($num_m)
	{
	echo 匹配成功！;
	$item=mysql_fetch_array($result_m);
	print_r($item);
	$name_m=$item[name];
	$pic_m=$item[picture];
	$time_m=$item[time];
	$place_m=$item[place];
	$slogan_m=$item[slogan];
	?>
	<table width=500 border="0" cellpadding="5" cellspacing="1" bgcolor="#add3ef">
  <tr bgcolor="#eff3ff">
  <td>用户：<?php echo $name_m?> 时间：<?php echo $time_m?> 地点：<?php echo $place_m?></td>
  </tr>
  <tr bgColor="#ffffff">
  <td>ta的约跑宣言：<?
 echo $slogan_m;
   ?></td>
  </tr>
</table>
<img src="<?php echo $pic_m?>" alt="头像" 
style="width:300px;height:300px;"/>
	<?php 

}
}
	
?>