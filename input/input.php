<?php 
//登录
/* if(!isset($_POST['submit'])){
    exit('非法访问!');
} */
$parameter=$_POST['parameter'];
$place=$_POST['place'];
$time=$_POST['time'];
$CODMn=$_POST['CODMn'];
$COD=$_POST['COD'];
$BOD5=$_POST['BOD5'];
$NH3_N=$_POST['NH3_N'];
$P=$_POST['P'];
$As=$_POST['As'];
$Hg=$_POST['Hg'];
$Cd=$_POST['Cd'];
$Cr=$_POST['Cr'];
$Petroleum=$_POST['Petroleum'];
$Anionicsurfactant=$_POST['Anionicsurfactant'];
$Sulfid=$_POST['Sulfid'];
$Coliforms=$_POST['Coliforms'];
$average=(float)($CODMn+$COD+$BOD5+$NH3_N+$P+$As+$Hg+$Cd+$Cr+$Petroleum+$Anionicsurfactant+$Sulfid+$Coliforms)/13;
$other="new";
include('conn.php');
//写入数据
$sql="INSERT INTO parameter_".$parameter."(place, time, CODMn, COD, BOD5, NH3_N, P, `As`, Hg, Cd, Cr, Petroleum, 
Anionicsurfactant, Sulfid, Coliforms, average,other) VALUES ('".$place."',$time,$CODMn,$COD,$BOD5,$NH3_N,$P,$As,$Hg,$Cd,$Cr,$Petroleum,$Anionicsurfactant,$Sulfid,$Coliforms,$average,'".$other."')";
if(mysql_query($sql,$conn)){
	//exit  ('数据录入成功，点击此处<a href="input.html">继续录入</a>');
	echo  ("<script language=JavaScript> alert('数据录入成功!'); location.replace('input.html');</script>");

}  else {
    echo '抱歉！添加数据失败：',mysql_error(),'<br />';
    echo '点击此处 <a href="javascript:history.back(-1);">返回</a> 重试';
} 
 
?>