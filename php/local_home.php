<?php 
session_start();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
echo $_SESSION[id];
include ("head.php");
?>
<img src="/headpic/<?php echo $_SESSION[id]?>.jpg" alt="头像" 
style="width:300px;height:300px;"/>
<?php 

?>