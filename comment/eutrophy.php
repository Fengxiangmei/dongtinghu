<?php 

if(count($_POST)==0)
 {exit ("<script language=JavaScript> alert('请选择年份!'); location.replace('eutrophy.html');</script>");} 
else
{
for($i=0;$i<100;$i++){
	if($_POST[$i]!=""){
		$a[]=$_POST[$i];
	}
}
for($j=0;$j<count($a);$j++){
	$sql="select time,average from nutrition where time='".$a[$j]."'";
	include('../conn.php');
	$check_query = mysql_query($sql);
	if($result = mysql_fetch_array($check_query)){
	     $data[$j]=$result['average'];
		 $year[$j]=$result['time'];
	}
}
$average=array_sum($data)/count($data);
$sql2="select level from standards where '".$average."'>min and '".$average."'<max";
$check=mysql_query($sql2);
$result2=mysql_fetch_array($check);
$level=$result2['level']; 
 ?>
 <!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script> 
<script type="text/javascript" src="../js/highcharts.js"></script> 
<script type="text/javascript" src="../js/modules/exporting.js"></script> 
<script type="text/javascript">
var chart; 
$(function() { 
    chart = new Highcharts.Chart({ 
        chart: { 
            renderTo: 'chart_line', //放置图表的DIV容器对应的id属性 
            defaultSeriesType: 'line' //图表类型line, spline, area, areaspline, column, bar, pie ,  scatter 
        }, 
        title: { 
            text: '<?php echo "洞庭湖营养状况表"?>',  //图表标题 
            x: -20 //center 
        }, 
        subtitle: { 
            text: '',  //副标题 
            x: -20 
        }, 
		   credits: { 
            enabled: false   //不显示LOGO 
        }, 
        xAxis: {  //x轴 
		   categories: [<?php for ($k=0;$k<count($year);$k++) echo $year[$k],",";?>] 
        }, 
        yAxis: {  //y轴 
            title: { 
                text: '综合营养状态指数' 
            }, 
            plotLines: [{ 
                value: 0, 
                width: 1, 
                color: '#808080' 
            }] 
        }, 
        tooltip: { 
            formatter: function() {  //当鼠标悬置数据点时的格式化提示 
                //return '<b>' + this.series.name + '</b><br/>' + this.x + ': ' + this.y + ''; 
				return '<b>' + this.series.name + '</b><br/>' + this.y+ ': ' + this.x + ''; 
            } 
        }, 
		  plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        legend: {  //【图例】位置样式 
            layout: 'vertical',  //【图例】显示的样式：水平（horizontal）/垂直（vertical） 
            backgroundColor: '#FFFFFF', 
            align: 'left', 
            verticalAlign: 'top', 
            x: 100, 
            y: 20, 
            floating: true, 
            shadow: true 
        }, 
        series: [{ 
            name: 'TLI', 
			data :[<?php for ($l=0;$l<count($data);$l++) echo $data[$l],",";?>]
        }] 
    }); 
}); </script>
<style type="text/css">
div#container{width:100%;background-color:#BCD4E3;}
div#header {background-image:url(../image/header.png);height:150px;width:100%;background-size:100% 100%;}
div#navigation {background-color:#3C72C4; opacity: 0.6;width:100%;height:40px;
						position: relative;
						  left: 0px;
						  top: 110px;}
div#br {width:100%;height:10px;}
div#center {background-color:;height:600px;width:960px; margin:0 auto;}
div#menu {background-color:#7488B8;height:600px;width:190px;float:left;border-radius:10px;border:2px solid #7488B8;}
div#divise {background-color:;height:500px;width:10px;float:left;}
div#content {background-color:#EEEEEE;height:600px;width:750px;float:left;border-radius:10px;border:2px solid#7488B8;}
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
	color :#FFFFFF;}
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
.title{font-family : 微软雅黑,宋体;
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
			 left: 250px;}
			 
			 
			 
*{
margin:0px;
padding:0px;
}
 #nav2{ background-color:#eee; width:600px; height:40px; margin:0 auto;}/*设置导航的长度和宽度，左右居中显示*/
 ul{ list-style:none;}/*去除列表样式*/
 ul li{ float:left; line-height:40px;  text-align:center;}/*设置样式的行高以及居中显示*/

 ul li a{
 text-decoration:none;color:#000;/*定义A标签的样式 颜色 去除下划线*/
 display:block;padding:0 10px;
 }
 ul li ul li{ /*去除浮动，设置背景颜色，内边距以上方为两个像素*/
float:none;background:#7488B8;
margin-top:0px;
 }
 ul li ul{
 position:absolute;/*定位显示的位置*/
 display:none;/*隐藏第二个样式的内容*/
 }
 ul li:hover ul{
 display:block;/*鼠标经过时显示内容*/
 width:190px;
 }

ul li a:hover{
 background:#7488B8;
 }

 ul li ul li a:hover{
background:#00ABC3;/*鼠标经过时显示内容*/
 width:170px;
 }
 #t{ /*定义地二个列表样式*/
 float:none;
  position:absolute;
  display:none;
  padding-left:2px;
 top:0px;
  left:0px;
 }
 ul li ul li:hover #t{/*鼠标移上导航显示下拉列表*/
 display:block;
 }
  
 
 .btn-select { 
position: relative; 
display: inline-block; 
width: 150px; 
height: 25px; 
background-color: #f80; 
font: 14px/20px "Microsoft YaHei"; 
color: #eee;
} 
.btn-select .cur-select { 
position: absolute; 
display: block; 
width: 150px; 
height: 35px; 
line-height: 25px; 
background:#7488B8; url(ico-arrow.png) no-repeat 125px center; 
text-indent: 10px; 
} 
.btn-select:hover .cur-select { 
background-color: #7488B8;
} 
.btn-select select { 
position: absolute; 
top: 0; 
left: 0; 
width: 150px; 
height: 35px; 
opacity: 0; 
filter: alpha(opacity: 0;); 
font: 14px/20px "Microsoft YaHei"; 
color: #7488B8;<!-- 选项字体颜色-->
} 
.btn-select select option { 
text-indent: 15px; 
} 
.btn-select select option:hover { 
background-color: #7488B8;
color:#7488B8;
} 
 
 
</style>
</head>

<body>

<div id="container">

<div id="header">
<div id="navigation">
<p class="padding">
<a href="../main.html" class="nav">首页</a>&nbsp;&nbsp;&nbsp;
<a href="../input.html"  class="nav">数据录入与管理</a>&nbsp;&nbsp;&nbsp;
<a href="../comment.html"  class="nav1">水环境评价</a>&nbsp;&nbsp;&nbsp;
<a href="../analysis.html"  class="nav">分析决策</a>&nbsp;&nbsp;&nbsp;
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
<a href="eutrophy.html" class="subnav1">水体营养状况</a><br/><br/>
<hr style="filter: alpha(opacity=100, finishopacity=0, style=3)" width="100%" color="#203A66" SIZE="3"><br/>

<p class="btn-select " id="btn_select"> 
<span class="cur-select">断面水体主要污染物</span> 
<select onchange='document.location.href=this.options[this.selectedIndex].value;'> 
<option value="" select="">请选择</option>
<option value="pollutant2.html">断面水体污染分担率均值</option>
<option value="pollutant.html">断面水体主要污染物</option> 

</select> 
</p> <br/><br/>
<hr style="filter: alpha(opacity=100, finishopacity=0, style=3)" width="100%" color="#203A66" SIZE="3">
<ul>
<li> <a href="#" class="subnav">&nbsp;&nbsp;&nbsp;&nbsp;水体水质综合污染指数&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</a>

<ul>
<li><a href="compre1.html" class="subnav">断面评价参数污染指数</a></li>
<li><a href="compre2.html" class="subnav">断面综合污染指数</a></li>
<li><a href="compre.html" class="subnav">污染分子数均值</a><hr style="filter: alpha(opacity=100, finishopacity=0, style=3)" width="100%" color="#203A66" SIZE="3"></li>

</ul>
</li>
</ul>
<hr style="filter: alpha(opacity=100, finishopacity=0, style=3)" width="100%" color="#203A66" SIZE="3"><br/>

</center>
</div>
<div id="divise"></div>
<div id="content"><form action="eutrophy.php" method="post" onSubmit="return Check(this)" name="Form"> <br/>
<p class="title">请选择年份：</p><br/>&nbsp;
<?php  include('../conn.php');  $sq="select time from nutrition "; $result = mysql_query($sq,$conn);
$i=0;
   while($row=mysql_fetch_array($result))
{  
	if(($i+1)%9==0){
	echo "<label><input name=".$i." type='checkbox' value='".$row['time']."'/>".$row['time']."</label><br/><br/>&nbsp;&nbsp;" ;
	}else {
		echo "<label><input name=".$i." type='checkbox' value='".$row['time']."'/>".$row['time']."</label> &nbsp;&nbsp;&nbsp;" ;
	}
	$i=$i+1;
}
?>
<br/>
<input type="submit" value="确定" class="input" />&nbsp;  &nbsp; 
 <input type="reset" value="重置"  class="input" />
</form> <br/>
<div id="chart_line" style="width: 700px; height: 400px; margin: 0 auto"></div> <br>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;综合以上,全湖各年度综合营养状态指数在<?php echo min($data)."~".max($data)?>之间,得出洞庭湖营养状况为:<?php echo $level;?></span>
</div>
</div>
</div>

</body>
</html>
<?php }?>
 