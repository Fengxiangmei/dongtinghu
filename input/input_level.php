<?php 

//登录

$time=$_POST['time'];
$chla=$_POST['chla'];
$TN=$_POST['TN'];
$SD=$_POST['SD'];
$CODMn=$_POST['CODMn'];
$TP=$_POST['TP'];
$average=(float)($chla+$TN+$SD+$CODMn+$TP)/5;
$other="new";
include('../conn.php');
$sq="select id from nutrition where time='".$time."'";
$result = mysql_query($sq,$conn);
$data=mysql_fetch_array($result);
if(count($data)==1)
{ 
	//写入数据
	$sql="INSERT INTO nutrition(`time`, `chla`, `TP`, `TN`, `SD`, `CODMn`, `average`, `other`) VALUES ($time,$chla,$TP,$TN,$SD,$CODMn,$average,'".$other."')";
	if(mysql_query($sql,$conn)){
		//exit  ('数据录入成功，点击此处<a href="input.html">继续录入</a>');
		echo  ("<script language=JavaScript> alert('数据录入成功!'); location.replace('input_level.html');</script>");

	}  else {
		echo '抱歉！添加数据失败：',mysql_error(),'<br />';
		echo '点击此处 <a href="javascript:history.back(-1);">返回</a> 重试';
	}
} else {
$sql2="update nutrition set `chla`=$chla,`TP`=$TP,`TN`=$TN,`SD`=$SD,`CODMn`=$CODMn,`average`=$average,`other`='".$other."'  WHERE time=$time";

	if(mysql_query($sql2,$conn)){
		//exit  ('数据录入成功，点击此处<a href="input.html">继续录入</a>');
		echo  ("<script language=JavaScript> alert('数据录入成功!'); location.replace('input_level.html');</script>");

	}  else {
		echo '抱歉！添加数据失败：',mysql_error(),'<br />';
		echo '点击此处 <a href="javascript:history.back(-1);">返回</a> 重试';
	}

}


?>