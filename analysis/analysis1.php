<?php 
/* if(!isset($_POST['submit'])){
    exit('非法访问!');
} */
$time=$_POST['time'];
$sql="select  *  from analysis where time='".$time."' ";
include('../conn.php');
$result= mysql_query($sql); 
if(mysql_num_rows($result)){
	while($row=mysql_fetch_array($result))
	{	

	$place[]=$row['place'];
	$pa1[]=$row['parameter1'];
	$pa2[]=$row['parameter2'];
	$pa3[]=$row['parameter3'];
	$pa4[]=$row['parameter4'];
		} 		
}else {
	exit("<script language=JavaScript> alert('此年份没有数据!'); location.replace('analysis1.html');</script>");
}

?>


<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="http://cdn.hcharts.cn/jquery/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="http://cdn.hcharts.cn/highcharts/highcharts.js"></script>
  <script type="text/javascript" src="http://cdn.hcharts.cn/highcharts/exporting.js"></script>
<script type="text/javascript">
var chart;  
        $(document).ready(function () {  
            chart = new Highcharts.Chart({  
                chart: {  
                    renderTo: 'chart_line',  
					defaultSeriesType: 'spline',  
                    marginRight: 130,  
                    marginBottom: 25  
                },  
        title: {
            text: '聚类分析',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
		 credits: { 
            enabled: false   //不显示LOGO 
        }, 
        xAxis: {
		 title: {
                text: '监测断面',
            },
            categories: [<?php for($i=0;$i<count($place);$i++) {echo "'".$place[$i]."',";}?>],
			    labels: { 
                rotation: -45,  //逆时针旋转45°，标签名称太长。 
                align: 'left',  //设置右对齐 
				style:{ 
						//color: '#89A54E', 
						fontWeight:'bold', 
						fontSize:'10'
				},
            } , 
        },
        yAxis: {
            title: {
                text: '污染指数'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ''
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'right',
            borderWidth: 0
		
        },
        series: [{
            name: '第一类参数(高锰酸盐指数，'+"<br/>"+'化学需氧量，总磷（以P计）)',
            data: [<?php for($i=0;$i<count($place);$i++) {	echo $pa1[$i].",";}?>]
        }, {
            name: '第二类参数(砷，汞，镉，'+"<br/>"+'鉻（六价），石油类，'+"<br/>"+'阴离子表面活性剂，硫化物)',
            data: [<?php for($i=0;$i<count($place);$i++) {	echo $pa2[$i].",";}?>]
        }, {
            name: '第三类参数(氨氮,'+"<br/>"+'五日生化需氧量)',
            data: [<?php for($i=0;$i<count($place);$i++) {	echo $pa3[$i].",";}?>]
        }, {
            name: '第四类参数(粪大肠菌群)',
            data: [<?php for($i=0;$i<count($place);$i++) {	echo $pa4[$i].",";}?>]
        }]
    });
});
				
</script>
<style type="text/css">
div#container{width:100%;background-color:#BCD4E3;}
div#header {background-image:url(../image/header.png);height:150px;width:100%;background-size:100% 100%;}
div#navigation {background-color:#3C72C4; opacity: 0.6;width:100%;height:40px;
						position: relative;
						  left: 0px;
						  top: 110px;}
div#br {width:100%;height:10px;}
div#center {background-color:;height:550px;width:960px; margin:0 auto;}
div#menu {background-color:#7488B8;height:550px;width:190px;float:left;border-radius:10px;border:2px solid #7488B8;}
div#divise {background-color:;height:500px;width:10px;float:left;}
div#content {background-color:#EEEEEE;height:550px;width:750px;float:left;border-radius:10px;border:2px solid#7488B8;}
div#footer {background-image:url(image/footer.png);height:50px;width:100%;;background-size:100% 100%;clear:both;text-align:center;}
h1 {margin-bottom:0;}
h2 {margin-bottom:0;font-size:18px;}
ul {margin:0;}
li {list-style:none;}
a { text-decoration: none;} 
.padding {
	padding:0.15cm 5.5cm; }
 .nav{
	font-family : 微软雅黑,宋体;
	font-size : 1.2em;
	color :#FFFFFF;
	font-weight:bold;}
 .nav1{
	font-family : 微软雅黑,宋体;
	font-size : 1.2em;
	color :#000;
	font-weight:bold;}
.function{
	background-color:#203A66;
	border-radius:10px;
	width:192px;
	height:45px;
	font-family : 微软雅黑,宋体;
	font-size : 1em;
	color :#FFFFFF;
}	
.subnav{
	font-family : 微软雅黑,宋体;
	font-size : 0.8em;
	color :#FFFFFF;
}
.subnav1{
	font-family : 微软雅黑,宋体;
	font-size : 0.8em;
	color :#203A66;
	font-weight:bold;
}
.title{font-family : ,宋体;
				font-size : 1em;
				color :#203A66;
				position: relative;
				left: 20px;
}
 .input{width:80px;height=100px;
				font-family : 微软雅黑,宋体;
				font-size : 1em;
				color :#203A66;
				position: relative;
			 left: 150px;
			 top:0px;}
.choice{
	width:200px;
	font-family : 微软雅黑,宋体;
	font-size : 0.8em;
	color :#000;}
</style>
</head>

<body>

<div id="container">

<div id="header">
<div id="navigation">
<p class="padding">
<a href="../main.html" class="nav">首页</a>&nbsp;&nbsp;&nbsp;
<a href="../input.html"  class="nav">数据录入与管理</a>&nbsp;&nbsp;&nbsp;
<a href="../comment.html"  class="nav">水环境评价</a>&nbsp;&nbsp;&nbsp;
<a href="../analysis.html"  class="nav1">分析决策</a>&nbsp;&nbsp;&nbsp;
<a href=""  class="nav">后台管理</a>&nbsp;&nbsp;&nbsp;
<a href="login.php?action=logout" class="nav">退出</a> &nbsp;&nbsp;&nbsp;&nbsp;
</p>
</div>
</div>
<div id="br"></div>
<div id="center">
<div id="menu">
<center><input type="button" name="test" value="功 能 导 航" onClick="location.href='comment.html'" class="function"/>

<br/><br/>
<a href="analysis1.html" class="subnav1">聚类分析</a><br/>
<hr style="filter: alpha(opacity=100, finishopacity=0, style=3)" width="80%" color="#203A66" SIZE="3">
<a href="analysis2.html" class="subnav">决策树分析</a><br/>
<hr style="filter: alpha(opacity=100, finishopacity=0, style=3)" width="80%" color="#203A66" SIZE="3">
<a href="analysis3.html" class="subnav">关联规则分析</a><br/>
<hr style="filter: alpha(opacity=100, finishopacity=0, style=3)" width="80%" color="#203A66" SIZE="3">
</center>
</div>
<div id="divise"></div>
<div id="content">
<form action="analysis1.php" method="post" onSubmit="return Check(this)" name="Form"> 
<p class="title">
&nbsp;聚类分析<br/><br/>
&nbsp;时间：
<select name="time" id="time"  class="choice" >
<option  value="null">请选择</opton>
<?php  include('../conn.php');  $sq="select  distinct time from parameter_p"; $result = mysql_query($sq,$conn);
$i=0;
while($row=mysql_fetch_array($result))
{  
	echo "<option value=".$row['time'].">".$row['time']."</option>" ;
	$i=$i+1;
}
?>
</select>

<input type="submit" value="确定" class="input" />&nbsp;&nbsp;&nbsp;
 <input type="reset" value="重置"  class="input" />
 
</form> <br/>
<div id="chart_line" style="min-width:700px;height:400px"></div>


</div>
</div>
</div>

</body>
</html>
