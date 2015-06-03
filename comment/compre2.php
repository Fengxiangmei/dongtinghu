<?php 
/* if(!isset($_POST['submit'])){
    exit('非法访问!');
} */
$time=$_POST['time'];
$sql="select  *  from parameter_p where time='".$time."' ";
include('../conn.php');
$result= mysql_query($sql); 
if(mysql_num_rows($result)){
	while($row=mysql_fetch_array($result))
	{		
		$CODMn[]=$row['CODMn'];
		$COD[]=$row['COD'];
		$BOD5[]=$row['BOD5'];
		$NH3_N[]=$row['NH3_N'];
		$P[]=$row['P'];
		$Cr[]=$row['Cr'];
		$Hg[]=$row['Hg'];
		$As[]=$row['As'];
		$Cd[]=$row['Cd'];
		$Petroleum[]=$row['Petroleum'];
		$Anionicsurfactant[]=$row['Anionicsurfactant'];
		$Sulfid[]=$row['Sulfid'];
		$Coliforms[]=$row['Coliforms'];
		$address[]=$row['place'];
		$ave[]=$row['average'];
		} 		
}else {
	exit("<script language=JavaScript> alert('此年份没有数据!'); location.replace('compre.html');</script>");
}
	$data[]=array_sum($Cr)/count($Cr);
	$data[]=array_sum($Hg)/count($Hg);
	$data[]=array_sum($As)/count($As);
	$data[]=array_sum($Cd)/count($Cd);
	$data[]=array_sum($CODMn)/count($CODMn);
	$data[]=array_sum($COD)/count($COD);
	$data[]=array_sum($BOD5)/count($BOD5);
	$data[]=array_sum($NH3_N)/count($NH3_N);
	$data[]=array_sum($P)/count($P);
	$data[]=array_sum($Petroleum)/count($Petroleum);
	$data[]=array_sum($Anionicsurfactant)/count($Anionicsurfactant);
	$data[]=array_sum($Sulfid)/count($Sulfid);
	$data[]=array_sum($Coliforms)/count($Coliforms);
	for($k=0;$k<count($address);$k++) {
		$text.="'".$address[$k]."'".",";
	}
?>
 <!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script> 
<script type="text/javascript" src="../js/highcharts.js"></script> 
<script type="text/javascript" src="../js/modules/exporting.js"></script> 
<script type="text/javascript">
function Check(Form)
{
//检查下拉框是否选择
if(document.getElementById("place").value == "null"){
  alert("请选择地点！");
  return false;
}
if(document.getElementById("time").value == "null"){
  alert("请选择时间！");
  return false;
}
}
</script>
<script type="text/javascript">
var chart,chart1; 
$(function() { 
   	chart1 = new Highcharts.Chart({ 
        chart: { 
            renderTo: 'chart_column', //图表放置的容器，关联DIV#id 
            zoomType: 'xy'   //X、Y轴均可放大 
            //因为是柱状图和曲线图共存在一个图表中，所以默认图表类型不在这里设置。 
        }, 
        title: { 
            text: '<?php echo '洞庭湖断面综合污染指数';?>' //图表标题 
        }, 
        subtitle: { 
            text: ''   //图表副标题 
        }, 
        credits: { 
            enabled: false   //不显示LOGO 
        }, 
        xAxis: [{ //X轴标签 
	      categories: [<?php echo $text;?>], 
		  
            labels: { 
                rotation: -45,  //逆时针旋转45°，标签名称太长。 
                align: 'right',  //设置右对齐 
				style:{ 
						//color: '#89A54E', 
						fontWeight:'bold', 
						fontSize:'15'
				},
            } ,
        }], 
        yAxis: [{ //设置Y轴-第一个（增幅） 
            labels: { 
                formatter: function() { //格式化标签名称 
                    return this.value + '%'; 
                }, 
                style: { 
                    color: '#89A54E' //设置标签颜色 
                } 
            }, 
            title: {text: ''}, //Y轴标题设为空 
            opposite: true  //显示在Y轴右侧，通常为false时，左边显示Y轴，下边显示X轴 
 
        }, 
        { //设置Y轴-第二个（金额） 
            gridLineWidth: 0,  //设置网格宽度为0，因为第一个Y轴默认了网格宽度为1 
            title: {text: ''},//Y轴标题设为空 
            labels: { 
                formatter: function() {//格式化标签名称 
                    return this.value + ''; 
                }, 
                style: { 
                    color: '#4572A7' //设置标签颜色 
                } 
            } 
 
        }], 
        tooltip: { //鼠标滑向数据区显示的提示框 
            formatter: function() {  //格式化提示框信息 
                var unit = { 
                  /* '金额': '亿元', 
                    '增幅': '%' */  
                } [this.series.name]; 
				if(this.series.name=='数值'){
                return '' + this.x + ': ' + this.y +'' ; 
				}
				else  return " 平均值：<?php echo array_sum($ave)/count($ave);?>";
            } 
        }, 
        legend: { //设置图例 
            layout: 'vertical', //水平排列图例 
            shadow: true,  //设置阴影 
        }, 
        series: [{  //数据列 
            name: '数值', 
            color: '#4572A7', 
            type: 'column', //类型：纵向柱状图 
            yAxis: 1, //数据列关联到Y轴，默认是0，设置为1表示关联上述第二个Y轴即金额 
           //data: [<?php echo $As.','.$Hg.','.$Cd.','.$Cr.','.$CODMn.','.$COD.','.$BOD5.','.$NH3_N.','.$P.','.$Petroleum.','.$Anionicsurfactant.','.$Sulfid.','.$Coliforms;?>] 
        data:[<?php for($i=0;$i<count($ave);$i++){ echo $ave[$i].",";}?>],
		dataLabels: {
                enabled: true,
                rotation: 0,
                color: '#000',
                align: 'right',
                x: 4,
                y: -3,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif',
                    //textShadow: '0 0 3px black'
                }
            }
		
		}, 
     ] 
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
div#center {background-color:;height:500px;width:960px; margin:0 auto;}
div#menu {background-color:#7488B8;height:500px;width:190px;float:left;border-radius:10px;border:2px solid #7488B8;}
div#divise {background-color:;height:500px;width:10px;float:left;}
div#content {background-color:#EEEEEE;height:500px;width:750px;float:left;border-radius:10px;border:2px solid#7488B8;}
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
.choice{
	width:200px;
	font-family : 微软雅黑,宋体;
	font-size : 0.8em;
	color :#000;}
			 
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
<a href="eutrophy.html" class="subnav">水体营养状况</a><br/><br/>
<hr style="filter: alpha(opacity=100, finishopacity=0, style=3)" width="100%" color="#203A66" SIZE="3"><br/>

<p class="btn-select " id="btn_select"> 
<span class="cur-select">断面水体主要污染物</span> 
<select onchange='document.location.href=this.options[this.selectedIndex].value;'> 
<option value="" select="">请选择</option>
<option value="pollutant2.html">断面水体污染分担率均值</option>
<option value="pollutant.html">断面水体主要污染物</option> 

</select> 
</p><br/><br/>
<hr style="filter: alpha(opacity=100, finishopacity=0, style=3)" width="100%" color="#203A66" SIZE="3">
<ul>
<li> <a href="#" class="subnav1">&nbsp;&nbsp;&nbsp;&nbsp;水体水质综合污染指数&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</a>

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
<div id="content"><br/><p class="title">断面综合污染指数评价</p><br/>
<form action="compre2.php" method="post" onSubmit="return Check(this)" name="Form"> 
<p class="title">
时间：
<select name="time" id="time"  class="choice" >
<option  value="null">请选择</opton>
<?php  include('../conn.php');  $sq="select  distinct time from parameter_k "; $result = mysql_query($sq,$conn);
$i=0;
while($row=mysql_fetch_array($result))
{  
	echo "<option value=".$row['time'].">".$row['time']."</option>" ;
	$i=$i+1;
}
?>
</select>
<input type="submit" value="确定" class="input" />&nbsp;&nbsp;&nbsp;
 <input type="reset" value="重置"  class="input" /></p>
</form> <br/>
<div id="chart_column" style="width: 720px; height: 400px; margin: 0 auto"></div> <br>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
</div>
</div>
</div>

</body>
</html>
 