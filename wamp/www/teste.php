<?php require_once('Connections/login_alunos.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_login_alunos, $login_alunos);
$query_Recordset1 = "SELECT *  FROM alunos, professores, funcionarios";
$Recordset1 = mysql_query($query_Recordset1, $login_alunos) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>


<body>
		<form name="login" method="POST" name="login">            
			Numero Processo:<br/>          
		 	<input name="n_proc" type="text" maxlength="10"/></br>            
			Password:</br>           
			<input name="password_a" type="password" maxlength="20"/></br>           
			<input type="submit" value="Login" />
                    </form>

            
            <form action="login" method="get" name="login">
            <input name="n_proc" type="text" maxlength="10" />
			            <input name="password_a" type="password" maxlength="20"/>   
            <input name="submit" type="button" value="submit" />
       </form>     
</body>
  
</html>
<?php
mysql_free_result($Recordset1);
?>
