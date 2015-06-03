<?php 

for($i=0;$i<10;$i++){
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

 
  // Standard inclusions   
  include("pChart/pData.class");
  include("pChart/pChart.class");

  // Dataset definition 
  $DataSet = new pData;
  $DataSet->AddPoint(array($data),"Serie1");
  //$DataSet->AddPoint(array(0.5,2,4.5,8,12.5,18,24.5,32,40.5,50),"Serie2");

  $DataSet->AddAllSeries();
  $DataSet->SetAbsciseLabelSerie();
  $DataSet->SetSerieName("TLI(∑)","Serie1");
/*   $DataSet->SetSerieName("February","Serie2");  */

  // Initialise the graph
  $Test = new pChart(700,230);
  $Test->setFontProperties("Fonts/tahoma.ttf",8);
  $Test->setGraphArea(50,30,585,200);
  $Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);
  $Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);
  $Test->drawGraphArea(255,255,255,TRUE);
  $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2);   
  $Test->drawGrid(4,TRUE,230,230,230,50);
$Test>SetXAxisName("Samples") ;
  // Draw the 0 line
  $Test->setFontProperties("Fonts/tahoma.ttf",6);
  $Test->drawTreshold(0,143,55,72,TRUE,TRUE);

  // Draw the line graph
  $Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());
  $Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);

  // Set labels
  $Test->setFontProperties("Fonts/tahoma.ttf",8);
  $Test->setLabel($DataSet->GetData(),$DataSet->GetDataDescription(),"Serie1","2","Daily incomes",221,230,174);
 // $Test->setLabel($DataSet->GetData(),$DataSet->GetDataDescription(),"Serie2","6","Production break",239,233,195);

  // Finish the graph
  $Test->setFontProperties("Fonts/tahoma.ttf",8);
  $Test->drawLegend(600,30,$DataSet->GetDataDescription(),255,255,255);
  $Test->setFontProperties("Fonts/tahoma.ttf",10);
  $Test->drawTitle(50,22,"Example 9",50,50,50,585);
  //生成图表
$imageFile = "example12.png";
$Test->Render($imageFile);
echo '<img src="'.$imageFile.'">';
 ?>
 