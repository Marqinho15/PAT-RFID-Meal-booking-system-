<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Marcação Almoços</title>
<link href="estilo.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
session_start();

$conn = @mysql_connect("localhost", "root", "") or die ("Problemas na conexão.");
$db = @mysql_select_db("rfid", $conn) or die ("Problemas na conexão");
$tipo = $_SESSION['tipo'];
$user = $_SESSION['MM_Username'];
$nome = $_SESSION['nome'];
		IF($user)
		{

?>
<div id="box">
   
   <div id="header">
		
        <div id="logo">
        <img src="../images/logo.jpg" />
        </div>
	
      </div>
    
      <div id="menu">
	  <a href="painel.php"> Início</a>
      <img src="../images/divisor_menu2.jpg" />
      <a href="/senhas/index.php"> Ver Calendário</a>
      <img src="../images/divisor_menu2.jpg" />
      <a href="regl.php">Regulamento</a>
      <img src="images/divisor_menu2.jpg" />
      <a href="logout.php"> Sair</a>
      <img src="images/divisor_menu2.jpg" /><!--vai para "logout com sucesso" e de seguida inedmaia.com-->

      </div>
    <div id="spacer">  
    </div>
    <div id="content">
    
    	<div id="conteudo">
        <?php
		$sem = date('W');

		
       	 	echo "<h1>Bem-vindo " .$nome. "</h1>";
        	echo "<h2>Histórico de refeições</h2>";
        	echo "<p> Verifique aqui todas as Refeições Marcadas</p>";
        	echo "<p> Senhas <m> falhadas </m>: (Data e Numero de requisição) </p>";
       		IF($tipo == "aluno")
			{
				$query = "SELECT n_req, dia, mes, ano FROM req_almocos WHERE n_proc='".$user."' AND almocou='0' AND n_semana < '".$sem."'"; 
				$query2 = "SELECT n_req, dia, mes, ano FROM req_almocos WHERE n_proc='".$user."' AND almocou='1' AND n_semana < '".$sem."'"; 
				$query_result = mysql_query($query) or die(mysql_error());
				$query_result2 = mysql_query($query2) or die(mysql_error());
				while($info = mysql_fetch_array($query_result))
				{
					$dias = $info['dia'];
					$meses = $info['mes'];
					$anos = $info['ano'];
					$nreq = $info['n_req'];
					echo "<p>". $dias. "-" .$meses. "-" .$anos.  " &nbsp &nbsp &nbsp &nbsp  " .$nreq. "</p>";
					}
					echo "<p> Senhas <g> validadas </g>: (Data e Numero de requisição) </p>";
					while($info = mysql_fetch_array($query_result2))
					{
						$dias = $info['dia'];
						$meses = $info['mes'];
						$anos = $info['ano'];
						$nreq = $info['n_req'];
						echo "<p>". $dias. "-" .$meses. "-" .$anos.  " &nbsp &nbsp &nbsp &nbsp  " .$nreq. "</p>";
					}
			}
			
			IF($tipo == "prof")
			{
				$query = "SELECT n_req, dia, mes, ano FROM req_almocos WHERE id_prof='".$user."' AND almocou='0' AND n_semana < '".$sem."'"; 
				$query2 = "SELECT n_req, dia, mes, ano FROM req_almocos WHERE id_prof='".$user."' AND almocou='1' AND n_semana < '".$sem."'"; 
				$query_result = mysql_query($query) or die(mysql_error());
				$query_result2 = mysql_query($query2) or die(mysql_error());
				while($info = mysql_fetch_array($query_result))
				{
					$dias = $info['dia'];
					$meses = $info['mes'];
					$anos = $info['ano'];
					$nreq = $info['n_req'];
					echo "<p>". $dias. "-" .$meses. "-" .$anos.  " &nbsp &nbsp &nbsp &nbsp  " .$nreq. "</p>";
					}
					echo "<p> Senhas <g> validadas </g>: (Data e Numero de requisição) </p>";
					while($info = mysql_fetch_array($query_result2))
					{
						$dias = $info['dia'];
						$meses = $info['mes'];
						$anos = $info['ano'];
						$nreq = $info['n_req'];
						echo "<p>". $dias. "-" .$meses. "-" .$anos.  " &nbsp &nbsp &nbsp &nbsp  " .$nreq. "</p>";
					}
			}
			IF($tipo == "func")
			{
				$query = "SELECT n_req, dia, mes, ano FROM req_almocos WHERE id_prof='".$user."' AND almocou='0' AND n_semana < '".$sem."'"; 
				$query2 = "SELECT n_req, dia, mes, ano FROM req_almocos WHERE id_prof='".$user."' AND almocou='1' AND n_semana < '".$sem."'"; 
				$query_result = mysql_query($query) or die(mysql_error());
				$query_result2 = mysql_query($query2) or die(mysql_error());
				while($info = mysql_fetch_array($query_result))
				{
					$dias = $info['dia'];
					$meses = $info['mes'];
					$anos = $info['ano'];
					$nreq = $info['n_req'];
					echo "<p>". $dias. "-" .$meses. "-" .$anos.  " &nbsp &nbsp &nbsp &nbsp  " .$nreq. "</p>";
				}
				echo "<p> Senhas <g> validadas </g>: (Data e Numero de requisição) </p>";
				while($info = mysql_fetch_array($query_result2))
				{
					$dias = $info['dia'];
					$meses = $info['mes'];
					$anos = $info['ano'];
					$nreq = $info['n_req'];
					echo "<p>". $dias. "-" .$meses. "-" .$anos.  " &nbsp &nbsp &nbsp &nbsp  " .$nreq. "</p>";
				}
			}
		}
		else
		{
			die ( "Não tem sessão iniciada, inicie sessão <a href=http://localhost/index.php > aqui</a>") ;
		}
		?>
		
		
		
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
<div id="footer3"></div>
</div>

</body>
</html>