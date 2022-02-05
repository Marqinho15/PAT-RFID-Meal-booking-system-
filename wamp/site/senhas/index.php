<?php
require_once("includes/config.php");
session_start();
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);

$user = $_SESSION['MM_Username'];
$_SESSION['limit'] = $limit;
$tipo=$_SESSION['tipo'];

if ($user)
{



$db_connection = mysql_connect ($DBHost, $DBUser, $DBPass) OR die (mysql_error());  
$db_select = mysql_select_db ($DBName) or die (mysql_error());
$db_table = "req_almocos";

$sem = date('W');
$sem2 = $sem + 1;
		
function getmicrotime(){ 
    list($usec, $sec) = explode(" ",microtime()); 
    return ((float)$usec + (float)$sec); 	
} 

$time_start = getmicrotime();

IF(!isset($_GET['year'])){
    $_GET['year'] = date("Y");
}
IF(!isset($_GET['month'])){
    $_GET['month'] = date("n")+1;
}

$month = addslashes($_GET['month'] - 1);
$year = addslashes($_GET['year']);


IF($_SESSION['tipo'] == "aluno")
{	
	$query = "SELECT n_req, dia, almocou FROM req_almocos WHERE mes='".$month."' AND ano='".$year."' AND n_proc='".$user."'";
	$query2 = "SELECT COUNT(n_req) FROM req_almocos WHERE almocou='0' AND  n_proc='".$user."' AND n_semana<'".$sem."'";
	$query_result2 = mysql_query ($query2);
			while($info2 = mysql_fetch_assoc($query_result2))
			{
				$teste3 = $info2['COUNT(n_req)'];
			}
			$max = 4 - $teste3;
			IF ($max <=0)
			{
				$limit = 1;
			}
			ELSE
			{
				$limit = 0;
			}
			

}

IF($tipo == "prof")
{
	
	$query = "SELECT n_req, dia, almocou FROM $db_table WHERE mes='".$month."' AND ano='".$year."' AND id_prof='".$user."'";

	$query2 = "SELECT COUNT(n_req) FROM req_almocos WHERE almocou='0' AND  id_prof='".$user."' AND n_semana<'".$sem."'";
	$query_result2 = mysql_query ($query2);
			while($info2 = mysql_fetch_assoc($query_result2))
			{
				$teste3 = $info2['COUNT(n_req)'];
			}
			$max = 4 - $teste3;
			IF ($max <=0)
			{
				$limit = 1;
			}
			ELSE
			{
				$limit = 0;
			}
			

}

IF($tipo == "func")
{
	
	$query = "SELECT n_req, dia, almocou FROM $db_table WHERE mes='".$month."' AND ano='".$year."' AND id_func='".$user."'";
	$query2 = "SELECT COUNT(n_req) FROM req_almocos WHERE almocou='0' AND  id_func='".$user."' AND n_semana<'".$sem."'";
	$query_result2 = mysql_query ($query2);
			while($info2 = mysql_fetch_assoc($query_result2))
			{
				$teste3 = $info2['COUNT(n_req)'];
			}
			$max = 4 - $teste3;
			IF ($max <=0)
			{
				$limit = 1;
			}
			ELSE
			{
				$limit = 0;
			}			
}

	//
$query_result = mysql_query($query) or die(mysql_error());
	while ($info = mysql_fetch_array($query_result))
	{
		$day2 = $info['dia'];
		IF($info['almocou'] == '0')
		{
			IF(date("n") > $month)
			{
   				$day = $info['dia'];
    			$event_id = $info['n_req'];
    			$events[$day][] = $info['n_req'];
    			$event_info[$event_id]['0'] = substr("FALHADA", 0, 8);
			}
			IF(date("n") == $month)
			{
				IF( date("j") > $day2)
				{
					$day = $info['dia'];
    				$event_id = $info['n_req'];
    				$events[$day][] = $info['n_req'];
    				$event_info[$event_id]['0'] = substr("FALHADA", 0, 8);
				}
				IF( date("j") <= $day2)
				{
					$day = $info['dia'];
    				$event_id = $info['n_req'];
    				$events[$day][] = $info['n_req'];
    				$event_info[$event_id]['0'] = substr("MARCADA", 0, 8);
				}
			}
			IF(date("n") < $month)
			{
					$day = $info['dia'];
    				$event_id = $info['n_req'];
    				$events[$day][] = $info['n_req'];
    				$event_info[$event_id]['0'] = substr("MARCADA", 0, 8);
			}
		}
		IF($info['almocou'] == '1')
		{
			$day = $info['dia'];
    				$event_id = $info['n_req'];
    				$events[$day][] = $info['n_req'];
    				$event_info[$event_id]['0'] = substr("VALIDADA", 0, 8);
		}
	}	

$todays_date = date("j");
$todays_month = date("n");

$days_in_month = date ("t", mktime(0,0,0,$_GET['month'],0,$_GET['year']));
$first_day_of_month = date ("w", mktime(0,0,0,$_GET['month']-1,1,$_GET['year']));
$first_day_of_month = $first_day_of_month + 1;
$count_boxes = 0;
$days_so_far = 0;

IF($_GET['month'] == 13){
    $next_month = 2;
    $next_year = $_GET['year'] + 1;
} ELSE {
    $next_month = $_GET['month'] + 1;
    $next_year = $_GET['year'];
}

IF($_GET['month'] == 2){
    $prev_month = 13;
    $prev_year = $_GET['year'] - 1;
} ELSE {
    $prev_month = $_GET['month'] - 1;
    $prev_year = $_GET['year'];
}
}
else
{	
	die ("Não tem sessão iniciada, inicie sessão <a href=http://localhost/login.php > aqui</a>");

}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Calend&aacute;rio</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="images/cal.css" rel="stylesheet" type="text/css">
<link href="estilo.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</head>

<body>
<div id="box">
   
   <div id="header">
		
        <div id="logo">
        
        <img src="../images/logo.jpg" />
        </div>
	
      </div>
    
      <div id="menu">

      <a href="../painel.php"> Inicio</a>
      <img src="../images/divisor_menu2.jpg" />
      <a href="../hist.php"> Histórico</a>
      <img src="../images/divisor_menu2.jpg" />
      <a href="../regl.php">Regulamento</a>
      <img src="../images/divisor_menu2.jpg" />
      <a href="../logout.php"> Sair</a>
      <img src="../images/divisor_menu2.jpg" /><!--vai para "logout com sucesso" e de seguida inedmaia.com-->

      </div>
    <div id="spacer">  
    </div>
    <div id="content">
    
    	<div id="conteudo">
        
<c>
<div align="left"><span class="currentdate"><? echo date ("F Y", mktime(0,0,0,$_GET['month']-1,1,$_GET['year'])); ?></span><br>
  <br>
</div>
<div align="left"><br>



  <table width="629" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td width="250"><div align="left"></td>
      <td width="200"><div align="left">
            
          <select name="month" id="month" onChange="MM_jumpMenu('parent',this,0)">
            <?php
								$mes = array(1=>"Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez");
								
			for ($i = 1; $i <= 12; $i++) {
				$link = $i+1;
				IF($_GET['month'] == $link){
					$selected = "selected";

				} ELSE {
					$selected = "";

				}
				echo "<option value=\"index.php?month=$link&amp;year=$_GET[year]\" $selected>" .  $mes[$i]  . "</option>\n";
			}
			?>
          </select>
          <select name="year" id="year" onChange="MM_jumpMenu('parent',this,0)">
		  <?php
		  for ($i = 2013; $i <= 2014; $i++) {
		  	IF($i == $_GET['year']){
				$selected = "selected";
			} ELSE {
				$selected = "";
			}
		  	echo "<option value=\"index.php?month=$_GET[month]&amp;year=$i\" $selected>$i</option>\n";
		  }
		  ?>
          </select>
        </div></td>
      
    </tr>
  </table>
  <br>
</div>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr class="topdays"> 
          <td><div align="center">Domingo</div></td>
          <td><div align="center">Segunda</div></td>
          <td><div align="center">Terça</div></td>
          <td><div align="center">Quarta</div></td>
          <td><div align="center">Quinta</div></td>
          <td><div align="center">Sexta</div></td>
          <td><div align="center">Sábado</div></td>
        </tr>
		<tr valign="top" bgcolor="#FFFFFF"> 
		<?php
		for ($i = 1; $i <= $first_day_of_month-1; $i++) {
			$days_so_far = $days_so_far + 1;
			$count_boxes = $count_boxes + 1;
			echo "<td width=\"75\" height=\"75\" class=\"beforedayboxes\"></td>\n";
		}
		for ($i = 1; $i <= $days_in_month; $i++) {
   			$days_so_far = $days_so_far + 1;
    			$count_boxes = $count_boxes + 1;
			IF($_GET['month'] == $todays_month+1){
				IF($i == $todays_date){
					$class = "highlighteddayboxes";
				} ELSE {
					$class = "dayboxes";
				}
			} ELSE {
				IF($i == 1){
					$class = "highlighteddayboxes";
				} ELSE {
					$class = "dayboxes";
				}
			}
			
			echo "<td width=\"100\" height=\"75\" class=\"$class\">\n";
			$link_month = $_GET['month'] - 1;
			echo "<div align=\"right\"><span class=\"toprightnumber\">\n<a href=\"javascript:MM_openBrWindow('event_add.php?day=$i&amp;month=$link_month&amp;year=$_GET[year]','','width=500,height=300');\">$i</a>&nbsp;</span></div>\n";
		
			IF(isset($events[$i])){
				echo "<div align=\"left\"><span class=\"eventinbox\">\n";
				while (list($key, $value) = each ($events[$i])) {
					echo "&nbsp;<a href=\"javascript:MM_openBrWindow('event.php?id=$value','','width=500,height=200');\">" . $event_info[$value]['1'] . " " . $event_info[$value]['0']  . "</a>\n<br>\n";
				}
				echo "</span></div>\n";
			}
			echo "</td>\n";
			IF(($count_boxes == 7) AND ($days_so_far != (($first_day_of_month-1) + $days_in_month))){
				$count_boxes = 0;
				echo "</TR><TR valign=\"top\">\n";
			}
		}
		$extra_boxes = 7 - $count_boxes;
		for ($i = 1; $i <= $extra_boxes; $i++) {
			echo "<td width=\"100\" height=\"75\" class=\"afterdayboxes\"></td>\n";
		}
		$time_end = getmicrotime();
		$time = round($time_end - $time_start, 3);
		?>
        </tr>
      </table></td>
  </tr>
</table>
</c>
<br></br>
	</div>
    	<div id= "sidebar">
        <h1>Esta Semana:</h1>
        <br />
        <h2>Segunda-Feira:</h2>
        <div id="comida1">
        <?php
			
		$query = "SELECT `n_semana` FROM ementa";
			
		$query_result = mysql_query ($query);
		while($info = mysql_fetch_array($query_result))
		{
			$ver = $info['n_semana'];
		}
		
		
		$sqla1 = "SELECT sopa FROM ementa WHERE n_semana='".$ver."' AND segunda='1'";
		$sqla2 = "SELECT conduto FROM ementa WHERE n_semana='".$ver."' AND segunda='1'";
		$sqla3 = "SELECT sobremesa FROM ementa WHERE n_semana='".$ver."' AND segunda='1'";
		$res1 = mysql_query ($sqla1);
		$res2 = mysql_query ($sqla2);
		$res3 = mysql_query ($sqla3);
		$r1 = mysql_fetch_assoc ($res1);
		$r2 = mysql_fetch_assoc ($res2);
		$r3 = mysql_fetch_assoc ($res3);
		
		
				$sqlb1 = "SELECT sopa FROM ementa WHERE n_semana='".$ver."' AND terca='1'";
		$sqlb2 = "SELECT conduto FROM ementa WHERE n_semana='".$ver."' AND terca='1'";
		$sqlb3 = "SELECT sobremesa FROM ementa WHERE n_semana='".$ver."' AND terca='1'";
		$res4 = mysql_query ($sqlb1);
		$res5 = mysql_query ($sqlb2);
		$res6 = mysql_query ($sqlb3);
		$r4 = mysql_fetch_assoc ($res4);
		$r5 = mysql_fetch_assoc ($res5);
		$r6 = mysql_fetch_assoc ($res6);
		
				$sqlc1 = "SELECT sopa FROM ementa WHERE n_semana='".$ver."' AND quarta='1'";
		$sqlc2 = "SELECT conduto FROM ementa WHERE n_semana='".$ver."' AND quarta='1'";
		$sqlc3 = "SELECT sobremesa FROM ementa WHERE n_semana='".$ver."' AND quarta='1'";
		$res7 = mysql_query ($sqlc1);
		$res8 = mysql_query ($sqlc2);
		$res9 = mysql_query ($sqlc3);
		$r7 = mysql_fetch_assoc ($res7);
		$r8 = mysql_fetch_assoc ($res8);
		$r9 = mysql_fetch_assoc ($res9);
		
				$sqld1 = "SELECT sopa FROM ementa WHERE n_semana='".$ver."' AND quinta='1'";
		$sqld2 = "SELECT conduto FROM ementa WHERE n_semana='".$ver."' AND quinta='1'";
		$sqld3 = "SELECT sobremesa FROM ementa WHERE n_semana='".$ver."' AND quinta='1'";
		$res10 = mysql_query ($sqld1);
		$res11 = mysql_query ($sqld2);
		$res12 = mysql_query ($sqld3);
		$r10 = mysql_fetch_assoc ($res10);
		$r11 = mysql_fetch_assoc ($res11);
		$r12 = mysql_fetch_assoc ($res12);
		
				$sqle1 = "SELECT sopa FROM ementa WHERE n_semana='".$ver."' AND sexta='1'";
		$sqle2 = "SELECT conduto FROM ementa WHERE n_semana='".$ver."' AND sexta='1'";
		$sqle3 = "SELECT sobremesa FROM ementa WHERE n_semana='".$ver."' AND sexta='1'";
		$res13 = mysql_query ($sqle1);
		$res14 = mysql_query ($sqle2);
		$res15 = mysql_query ($sqle3);
		$r13 = mysql_fetch_assoc($res13);
		$r14 = mysql_fetch_assoc ($res14);
		$r15 = mysql_fetch_assoc ($res15);
		
		
	
		?>
 			<form id="form1" name="form1" method="post" action="">
 	<table border="0" align="left" cellpadding="3" cellspacing="3">
    <tr>
    	<td><span class="sopa_seg"><p4>Sopa:</p4></span></td>
        <td><input type="text" size="30"  value="<?php echo $r1['sopa']?>"  readonly="readonly" /></td>
        </tr>
    	</table>
        </form>
        </div>
                <div id="comida2">
 			<form id="form2" name="form2" method="post" action="">
 	<table border="0" align="left" cellpadding="3" cellspacing="3">
    <tr>
    	<td><span class="sopa_seg"><p3>Prato:</p3></span></td>
        <td><input type="text" size="30"  value="<?php echo $r2['conduto']?>"  readonly="readonly" /></td>
        </tr>
    	</table>
        </form>
        </div>
                       <div id="comida3">
 			<form id="form3" name="form3" method="post" action="">
 	<table width="0" border="0" align="left" cellpadding="3" cellspacing="3">
    <tr>
    	<td><span class="sopa_seg"><p2>Sobremesa:</p2></span></td>
        <td><input type="text" size="30"  value="<?php echo $r3['sobremesa']?>"  readonly="readonly" /></td>
        </tr>
    	</table>
        </form>
        </div>
        
        </br>
        </br>
        </br>
        
        
        <h2>Terça-Feira:</h2>
        <div id="comida1">
 			<form id="form4" name="form4" method="post" action="">
 	<table border="0" align="left" cellpadding="3" cellspacing="3">
    <tr>
    	<td><span class="sopa_seg"><p4>Sopa:</p4></span></td>
        <td><input type="text" size="30"  value="<?php echo $r4['sopa']?>"  readonly="readonly" /></td>
        </tr>
    	</table>
        </form>
        </div>
                <div id="comida2">
 			<form id="form5" name="form5" method="post" action="">
 	<table border="0" align="left" cellpadding="3" cellspacing="3">
    <tr>
    	<td><span class="sopa_seg"><p3>Prato:</p3></span></td>
        <td><input type="text" size="30"  value="<?php echo $r5['conduto']?>"  readonly="readonly" /></td>
        </tr>
    	</table>
        </form>
        </div>
                       <div id="comida3">
 			<form id="form6" name="form6" method="post" action="">
 	<table width="0" border="0" align="left" cellpadding="3" cellspacing="3">
    <tr>
    	<td><span class="sopa_seg"><p2>Sobremesa:</p2></span></td>
        <td><input type="text" size="30"  value="<?php echo $r6['sobremesa']?>"  readonly="readonly" /></td>
        </tr>
    	</table>
        </form>
        </div>
        
        </br>
        </br>
        </br>
        
        <h2>Quarta-Feira:</h2>
        <div id="comida1">
 			<form id="form7" name="form7" method="post" action="">
 	<table border="0" align="left" cellpadding="3" cellspacing="3">
    <tr>
    	<td><span class="sopa_seg"><p4>Sopa:</p4></span></td>
        <td><input type="text" size="30"  value="<?php echo $r7['sopa']?>"  readonly="readonly" /></td>
        </tr>
    	</table>
        </form>
        </div>
                <div id="comida2">
 			<form id="form8" name="form8" method="post" action="">
 	<table border="0" align="left" cellpadding="3" cellspacing="3">
    <tr>
    	<td><span class="sopa_seg"><p3>Prato:</p3></span></td>
        <td><input type="text" size="30"  value="<?php echo $r8['conduto']?>"  readonly="readonly" /></td>
        </tr>
    	</table>
        </form>
        </div>
                       <div id="comida3">
 			<form id="form9" name="form9" method="post" action="">
 	<table width="0" border="0" align="left" cellpadding="3" cellspacing="3">
    <tr>
    	<td><span class="sopa_seg"><p2>Sobremesa:</p2></span></td>
        <td><input type="text" size="30"  value="<?php echo $r9['sobremesa']?>"  readonly="readonly" /></td>
        </tr>
    	</table>
        </form>
        </div>
        
        </br>
        </br>
        </br>
        
        <h2>Quinta-Feira:</h2>
        <div id="comida1">
 			<form id="form10" name="form10" method="post" action="">
 	<table border="0" align="left" cellpadding="3" cellspacing="3">
    <tr>
    	<td><span class="sopa_seg"><p4>Sopa:</p4></span></td>
        <td><input type="text" size="30"  value="<?php echo $r10['sopa']?>"  readonly="readonly" /></td>
        </tr>
    	</table>
        </form>
        </div>
                <div id="comida2">
 			<form id="form11" name="form11" method="post" action="">
 	<table border="0" align="left" cellpadding="3" cellspacing="3">
    <tr>
    	<td><span class="sopa_seg"><p3>Prato:</p3></span></td>
        <td><input type="text" size="30"  value="<?php echo $r11['conduto']?>"  readonly="readonly" /></td>
        </tr>
    	</table>
        </form>
        </div>
                       <div id="comida3">
 			<form id="form12" name="form12" method="post" action="">
 	<table width="0" border="0" align="left" cellpadding="3" cellspacing="3">
    <tr>
    	<td><span class="sopa_seg"><p2>Sobremesa:</p2></span></td>
        <td><input type="text" size="30"  value="<?php echo $r12['sobremesa']?>"  readonly="readonly" /></td>
        </tr>
    	</table>
        </form>
        </div>
        
        </br>
        </br>
        </br>
        
        <h2>Sexta-Feira:</h2>
        <div id="comida1">
 			<form id="form13" name="form13" method="post" action="">
 	<table border="0" align="left" cellpadding="3" cellspacing="3">
    <tr>
    	<td><span class="sopa_seg"><p4>Sopa:</p4></span></td>
        <td><input type="text" size="30"  value="<?php echo $r13['sopa']?>"  readonly="readonly" /></td>
        </tr>
    	</table>
        </form>
        </div>
                <div id="comida2">
 			<form id="form14" name="form14" method="post" action="">
 	<table border="0" align="left" cellpadding="3" cellspacing="3">
    <tr>
    	<td><span class="sopa_seg"><p3>Prato:</p3></span></td>
        <td><input type="text" size="30"  value="<?php echo $r14['conduto']?>"  readonly="readonly" /></td>
        </tr>
    	</table>
        </form>
        </div>
                       <div id="comida3">
 			<form id="form15" name="form15" method="post" action="">
 	<table width="0" border="0" align="left" cellpadding="3" cellspacing="3">
    <tr>
    	<td><span class="sopa_seg"><p2>Sobremesa:</p2></span></td>
        <td><input type="text" size="30"  value="<?php echo $r15['sobremesa']?>"  readonly="readonly" /></td>
        </tr>
    	</table>
        </form>
        </div>
        
        </br>
        </br>
        </br>
        
        
    	</div>
      <div id= "cont_spac">
        </div>
      <div id="divclear"></div>
 	</div>
       	
    
</div>
<div id="box2">
<div id="footer"></div>
<div id="footer2"></div>
<div id="footer3"><p align="left"><span class="footer">
    <a href="http://validator.w3.org/check/referer"><img border="0" src="http://www.w3.org/Icons/valid-html401" alt="Valid HTML 4.01!" height="31" width="88"></a> 
<a href="http://jigsaw.w3.org/css-validator/check/referer"><img border="0" style="border:0;width:88px;height:31px" src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!"></a></p>

</div>
</div>

</body>
</html>

