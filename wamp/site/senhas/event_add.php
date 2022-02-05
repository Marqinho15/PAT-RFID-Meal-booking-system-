<?php
require_once("includes/config.php");


session_start();


$db_connection = mysql_connect ($DBHost, $DBUser, $DBPass) OR die (mysql_error());  
$db_select = mysql_select_db ($DBName) or die (mysql_error());

$tipo=$_SESSION['tipo'];
$user = $_SESSION['MM_Username'];



IF(isset($_POST['submit']))
{
	
	
$db_table = "req_almocos";	
$todays_date = date("j-n-Y");
$date2 = $_GET['day'] . "-" . $_GET['month'] . "-" . $_GET['year'];

$mysqldate1 = date('j-n-Y', strtotime($todays_date));
$mysqldate2 = date('j-n-Y', strtotime($date2));

$date1 = new DateTime($mysqldate1);
$date3 = new DateTime($mysqldate2);

$datet = date('w', strtotime($date2));
$ns = date('W', strtotime($date2));
$interval = $date1->diff($date3);

$intervalo = $interval->format('%R%a');
	IF($interval->format('%R%a') <= -1)
	{
		echo "Não pode marcar senhas para dias anteriores ao atual";
	}
	ELSE
	{
		IF($interval->format('%R%a') == 0)
		{
			echo "Não pode marcar senhas para o próprio dia";
		}
		ELSE
		{
			IF($intervalo == 1)
			{
				echo "Não pode marcar senhas para amanhã";
			}
			ELSE
			{
				IF($intervalo >= 14)
				{
					echo " Não pode marcar senhas com mais de duas semanas de antecedência";
				}
				ELSE
				{
					IF($datet == 0 || $datet == 6)
					{
						echo "Não pode marcar senhas para o fim de semana";
					}
					ELSE
					{
						IF($tipo=="aluno")
						{
							$query = "SELECT `n_req` FROM req_almocos WHERE dia='".addslashes($_GET['day'])."' AND mes='".addslashes($_GET['month'])."' AND ano='".addslashes($_GET['year'])."' AND n_proc='".$user."'";
							$query_result = mysql_query ($query);
							while($info = mysql_fetch_array($query_result))
							{
								
								$ver = $info['n_req'];
							}
							IF($ver=="")
							{							
								mysql_query("INSERT INTO $db_table (`n_req`, `dia`, `mes`,`ano` ,`almocou`, `n_semana`, `n_proc`, `id_prof`, `id_func`) VALUES ('', '".addslashes($_GET['day'])."', '".addslashes($_GET['month'])."', '".addslashes($_GET['year'])."', '0', '".$ns."', '".$user."', '', '' )");
								echo "Senha marcada com sucesso";
							}
							Else
							{
								echo "Já marcou senha para este dia";
							}
						}
						IF($tipo=="prof")
						{
							$query = "SELECT `n_req` FROM $db_table WHERE dia='".addslashes($_GET['day'])."' AND mes='".addslashes($_GET['month'])."' AND ano='".addslashes($_GET['year'])."' AND id_prof='".$user."'";
							$query_result = mysql_query ($query);
							while($info = mysql_fetch_array($query_result))
							{
								$ver = $info['n_req'];
							}
							IF($ver=="")
							{						
								mysql_query("INSERT INTO $db_table (`n_req`, `dia`, `mes`,`ano` ,`almocou`, `n_semana`, `n_proc`, `id_prof`, `id_func`) VALUES ('', '".addslashes($_GET['day'])."', '".addslashes($_GET['month'])."', '".addslashes($_GET['year'])."', '0', '".$ns."', '', '".$user."', '' )");
								echo "Senha marcada com sucesso";
							}
							Else
							{
								echo "Já marcou senha para este dia";
							}
						}
						IF($tipo=="func")
						{
							{
							$query = "SELECT `n_req` FROM $db_table WHERE dia='".addslashes($_GET['day'])."' AND mes='".addslashes($_GET['month'])."' AND ano='".addslashes($_GET['year'])."' AND id_prof='".$user."'";
							$query_result = mysql_query ($query);
							while($info = mysql_fetch_array($query_result))
							{
								$ver = $info['n_req'];
							}
							IF($ver=="")
							{						
							mysql_query("INSERT INTO $db_table (`n_req`, `dia`, `mes`,`ano` ,`almocou`, `n_semana`, `n_proc`, `id_prof`, `id_func`) VALUES ('', '".addslashes($_GET['day'])."', '".addslashes($_GET['month'])."', '".addslashes($_GET['year'])."', '0', '".$ns."', '', '', '".$user."' )");
							echo "Senha marcada com sucesso";
							}
							Else
							{
								echo "Já marcou senha para este dia";
							}
						}
					}	
				}
			}
		}
	}
	}



	  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Easy Calendar - Add Event</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language='javascript' type="text/javascript">
<!--
 function redirect_to(where, closewin)
 {
 	opener.location= 'index.php?' + where;
 	
 	if (closewin == 1)
 	{
 		self.close();
 	}
 }
  //-->
 </script>
</head>
<body onLoad="javascript:redirect_to('month=<? echo $_GET['month'].'&year='.$_GET['year']; ?>',1);">
</body>
</html>
<?php
}
ELSE 
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Calendar - Add Event</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="images/cal.css" rel="stylesheet" type="text/css">
</head>
<body>
		<?php
		if ($user)
		{
			if($_SESSION['limit'] == 0)
			{
				

		
				$date = $_GET['day'] . "-" . $_GET['month'] . "-" . $_GET['year'];
		
	  			echo "Tem a certeza que deseja marcar almoço para o dia " . $date . " ?"; 
	  
	  
	  ?>
    
 <form name="form1" method="post" action="">
 
      <td><input name="submit" type="submit" id="submit" value="Confirmar"></td>
		<? $_POST['month']=$_GET['month'];?>
     	<? $_POST['day']=$_GET['day'];?>
   		<? $_POST['year']=$_GET['year'];?>
<?php        
			}
			else
			{
				die("Marcações de Senhas Bloqueadas, Limite de Faltas atingido" .$_SESSION['limit']);
			}
		}
		else
		{	
			die ("Não tem sessão iniciada, inicie sessão <a href=http://localhost/login.php > aqui</a>");
		}
?>
 </form>
</body>
</html>
<?php
}
?>