<?php 

$time=$_POST['time'];
$place=$_POST['place'];
$sql="select * from parameter_k where time='".$time."' and place='".$place."' limit 1 ";
include('../conn.php');
	$sql2="select * from parameter_k where time='".$time."' ";
	$result2= mysql_query($sql2); 
	if(mysql_num_rows($result2)){
		while($row2=mysql_fetch_array($result2))
		{
		$CODMn_array[]=$row2['CODMn'];
		$COD_array[]=$row2['COD'];
		$BOD5_array[]=$row2['BOD5'];
		$NH3_N_array[]=$row2['NH3_N'];
		$P_array[]=$row2['P'];
		$Cr_array[]=$row2['Cr'];
		$Hg_array[]=$row2['Hg'];
		$As_array[]=$row2['As'];
		$Cd_array[]=$row2['Cd'];
		$Petroleum_array[]=$row2['Petroleum'];
		$Anionicsurfactant_array[]=$row2['Anionicsurfactant'];
		$Sulfid_array[]=$row2['Sulfid'];
		$Coliforms_array[]=$row2['Coliforms'];

		}
	}
		else{
		exit("<script language=JavaScript> alert('此地点没有数据!'); location.replace('pollutant.html');</script>");
		}
	
		$f_CODMn=array_sum($CODMn_array)/count($CODMn_array);
		$f_COD=array_sum($COD_array)/count($COD_array);
		$f_BOD5=array_sum($BOD5_array)/count($BOD5_array);
		$f_NH3_N=array_sum($NH3_N_array)/count($NH3_N_array);
		$f_P=array_sum($P_array)/count($P_array);
		$f_Cr=array_sum($Cr_array)/count($Cr_array);
		$f_Hg=array_sum($Hg_array)/count($Hg_array);
		$f_As=array_sum($As_array)/count($As_array);
		$f_Cd=array_sum($Cd_array)/count($Cd_array);
		$f_Petroleum=array_sum($Petroleum_array)/count($Petroleum_array);
		$f_Anionicsurfactant=array_sum($Anionicsurfactant_array)/count($Anionicsurfactant_array);
		$f_Sulfid=array_sum($Sulfid_array)/count($Sulfid_array);
		$f_Coliforms=array_sum($Coliforms_array)/count($Coliforms_array);
		
		$data['CODMn']=$f_CODMn;
		$data['COD']=$f_COD;
		$data['BOD5']=$f_BOD5;
		$data['NH3_N']=$f_NH3_N;
		$data['P']=$f_P;
		$data['Cr']=$f_Cr;
		$data['Hg']=$f_Hg;
		$data['As']=$f_As;
		$data['Cd']=$f_Cd;
		$data['Petroleum']=$f_Petroleum;
		$data['Anionicsurfactant']=$f_Anionicsurfactant;
		$data['Sulfid']=$f_Sulfid;
		$data['Coliforms']=$f_Coliforms;
		$am=$data;
		arsort($data);

		foreach ($data as $key=>$value) {
			$name[]=$key ;}
		for($p=0;$p<count($name);$p++){
		if($name[$p]=="CODMn") $name[$p]="高锰酸盐指数";
		if($name[$p]=="COD") $name[$p]="化学需氧量";
		if($name[$p]=="BOD5") $name[$p]="五日生化需氧量";
		if($name[$p]=="NH3_N") $name[$p]="氨氮";
		if($name[$p]=="P") $name[$p]="总磷";
		if($name[$p]=="As") $name[$p]="砷";
		if($name[$p]=="Hg") $name[$p]="汞";
		if($name[$p]=="Cd") $name[$p]="镉";
		if($name[$p]=="Cr") $name[$p]="鉻";
		if($name[$p]=="Petroleum") $name[$p]="石油类";
		if($name[$p]=="Anionicsurfactant") $name[$p]="阴离子表面活性剂";
		if($name[$p]=="Sulfid") $name[$p]="硫化物";
		if($name[$p]=="Coliforms") $name[$p]="粪大肠菌群"; 
		
		}
		
		 $data=implode(",",$data);
		$data=explode(",",$data); 
		$sum=0;
		//$data与$name数组一一对应
	
		for($i=0;$i<count($name);$i++){
			$sum=$sum+$data[$i];
			if($sum>70) break;
		}
	
?>

<!DOCTYPE html>
<html>
<head>
 <script type="text/javascript" src="http://cdn.hcharts.cn/jquery/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="http://cdn.hcharts.cn/highcharts/highcharts.js"></script>
  <script type="text/javascript" src="http://cdn.hcharts.cn/highcharts/exporting.js"></script>
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
    chart = new Highcharts.Chart({ 
        chart: { 
            renderTo: 'chart_column', //图表放置的容器，关联DIV#id 
            zoomType: 'xy'   //X、Y轴均可放大 
            //因为是柱状图和曲线图共存在一个图表中，所以默认图表类型不在这里设置。 
        }, 
        title: { 
            text: '<?php echo "洞庭湖监测断面水体污染分担率平均值";?>' //图表标题 
        }, 
        subtitle: { 
            text: ''   //图表副标题 
        }, 
        credits: { 
            enabled: false   //不显示LOGO 
        }, 
        xAxis: [{ //X轴标签 
	      categories: ['高锰酸盐指数', '化学需氧量', '五日生化需氧量', '氨氮','总磷', '砷', '汞', '镉', '鉻',  '石油类', '阴离子表面活性剂', '硫化物', '粪大肠菌群'], 
		  
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
			
                return '' + this.x + ': ' + this.y +'' ; 
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
			data:[<?php foreach ($am as $value) {echo sprintf("%.4f", $value).",";}?>],
			 dataLabels: {
                enabled: true,
                rotation: 0,
                color: '#000',
                align: 'right',
                x: 2,
                y: 3,
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
div#center {background-color:;height:540px;width:960px; margin:0 auto;}
div#menu {background-color:#7488B8;height:540px;width:190px;float:left;border-radius:10px;border:2px solid #7488B8;}
div#divise {background-color:;height:540px;width:10px;float:left;}
div#content {background-color:#EEEEEE;height:540px;width:750px;float:left;border-radius:10px;border:2px solid#7488B8;}
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
			 left: 120px;}
.choice{
	width:100px;
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
<li> <a href="#" class="subnav">&nbsp;&nbsp;&nbsp;&nbsp;水体水质综合污染指数&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</a>

<ul>
<li><a href="compre.html" class="subnav">断面评价参数污染指数</a></li>
<li><a href="compre2 .html" class="subnav">断面综合污染指数</a></li>
<li><a href="compre1.html" class="subnav">污染分子数均值</a><hr style="filter: alpha(opacity=100, finishopacity=0, style=3)" width="100%" color="#203A66" SIZE="3"></li>

</ul>
</li>
</ul>
<hr style="filter: alpha(opacity=100, finishopacity=0, style=3)" width="100%" color="#203A66" SIZE="3"><br/>

</center>
</div>
<div id="divise"></div>
<div id="content"><br/><form action="pollutant2.php" method="post" onSubmit="return Check(this)" name="Form"> 
<p class="title">
&nbsp;断面水体污染分担率均值<br/><br/>
&nbsp;时间：
<select name="time" id="time"  class="choice" >
<option  value="null">请选择</opton>
<?php  include('../conn.php');  $sq="select  distinct time from parameter_p"; $result = mysql_query($sq,$conn);
while($row=mysql_fetch_array($result))
{  
	echo "<option value=".$row['time'].">".$row['time']."</option>" ;

}
?>
</select>

<input type="submit" value="确定" class="input" />&nbsp;&nbsp;&nbsp;
 <input type="reset" value="重置"  class="input" />
 
</form>  </p><br/>
<div id="chart_column" style="width: 740px; height: 380px; margin: 0 auto"></div> <br>
<span>&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
 for($j=0;$j<=$i;$j++){ 
 $str[]=$name[$j];
 $str2[]=sprintf("%.4f", $data[$j])."%";
 }
  $str =implode(",   ",$str);
  $str2=implode(",   ",$str2);
echo $time.'年2006年洞庭湖的主要污染物依次为:'.$str.",其污染分担率分别为". $str2.",";?></span>
</div>
</div>
</div>

</body>
</html>