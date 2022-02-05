<?php
require_once("includes/config.php");
session_start();
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);
$db_connection = mysql_connect ($DBHost, $DBUser, $DBPass) OR die (mysql_error());  
$db_select = mysql_select_db ($DBName) or die (mysql_error());
$db_table = "req_almocos";
$id = $_GET['id'];
//$query5 = "SELECT `dia`, `mes`, `ano` FROM $db_table WHERE n_req='".$id."	' LIMIT 1";
//$query_result5 = mysql_query ($query5);
//while ($info5 = mysql_fetch_array($query_result5))
//{
//    $date = $info5['dia'];
//	$date2 = $info5['mes'];
//	$date3 = $info5['ano'];
//	
// }


$todays_date = date("j-n-Y");
$date2 = $_GET['day'] . "-" . $_GET['month'] . "-" . $_GET['year'];

$mysqldate1 = date('j-n-Y', strtotime($todays_date));
$mysqldate2 = date('j-n-Y', strtotime($date2));
$date1 = new DateTime($mysqldate1);
$date3 = new DateTime($mysqldate2);
$interval = $date1->diff($date3);

$intervalo = $interval->format('%R%a');


$ver = "";
	$ver2 = "";
	$ver3 = "";
	$query = "SELECT `dia`, `mes`, `ano` FROM `req_almocos` WHERE n_req='".addslashes($_GET['id'])."'";
	$query_result = mysql_query ($query);
	while($info = mysql_fetch_array($query_result))
	{
		$ver = $info['dia'];
		$ver2 = $info['mes'];
		$ver3 = $info['ano'];
	}
IF(isset($_POST['submit']))
{
		IF($interval->format('%R%a') <= 1)
	{
		echo "Não pode cancelar senhas para dias anteriores a amanhã";
	}
	Else
	{
	mysql_query("DELETE FROM `req_almocos` WHERE n_req='".addslashes($_GET['id'])."'");
	echo "Senha cancelada.";
	}
}
ELSE
{
	

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>PHPCalendar </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="images/cal.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php echo "Tem a certeza que quer cancelar a senha marcada para o dia " .$ver. "-" .$ver2. "-" .$ver3. "?"; ?>
<form name="form1" method="post" action="">
 
      <td><input name="submit" type="submit" id="submit" value="Confirmar"></td>
        <?php } ?>
</body>
</html>