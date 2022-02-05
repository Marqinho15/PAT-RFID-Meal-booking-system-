<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php

if ($_POST['submit'])
 {
	$oldpassword = $_POST['oldpassword'];
	$newpassword = $_POST['newpassword'];
	$rnewpassword = $_POST['rnewpassword'];
	if(strlen($newpassword) < 6){
		die("ERROR: password is too short");
	}
	$conn = @mysql_connect("localhost", "root", "") or die ("Problemas na conexão.");
	mysql_select_db("rfid") or die ("Problemas na conexão");
	if($tipo=="aluno")
	{
		$queryget = mysql_query("SELECT password FROM alunos WHERE n_proc='".$user."'") or die ("erro al");
		$row = mysql_fetch_assoc($queryget);
		$oldpassworddb = $row['password'];
		if ($oldpassword == $oldpassworddb)
		{
			if($newpassword==$rnewpassword)
			{
				$querychange = mysql_query(" 
									   UPDATE alunos SET password='".$newpassword."' WHERE n_proc='".$user."'
									   ");
				session_destroy();
				die("A Palavra passe foi alterada corretamente. <br> volte a iniciar sessão <br> ".$tipo." <a href='index.php'>Return</a>");
			}
			else
			die("A Palavra passe nova não coincide.");
		}
		else
		die("A Palavra passe antiga incorreta");
		}
	if($tipo=="prof")
	{
		$queryget2 = mysql_query("SELECT password FROM professores WHERE id_prof='".$user."'") or die ("erro pr ");
		$row2 = mysql_fetch_assoc($queryget2);
		$oldpassworddb = $row2['password'];
			if ($oldpassword == $oldpassworddb)
		{
		if($newpassword==$rnewpassword)
		{
			$querychange = mysql_query(" 
									   UPDATE professores SET password='".$newpassword."' WHERE id_prof='".$user."'
									   ");
			session_destroy();
			die("A palavra passe foi alterada corretamente. <br> volte a iniciar sessão <br> ".$tipo." <a href='index.php'>Return</a>");
		}
		else
		die("A Palavra passe nova não coincide");
		
		
	}
	else
	die("Palavra Passe antiga incorreta");
	}
	if($tipo=="func")
	{
		$queryget3 = mysql_query("SELECT password FROM funcionarios WHERE id_func='".$user."'") or die ("erro fn");
		$row3 = mysql_fetch_assoc($queryget3);
		$oldpassworddb = $row3['password'];
			if ($oldpassword == $oldpassworddb)
		{
		if($newpassword==$rnewpassword)
		{
			$querychange = mysql_query(" 
									   UPDATE funcionarios SET password='".$newpassword."' WHERE id_func='".$user."'
									   ");
			session_destroy();
			die("A palavra passe foi alterada corretamente. <br> volte a iniciar sessão <br> ".$tipo." <a href='index.php'>Return</a>");
		}
		else
		die("Palavra passe nova não coincide.");
		
		
	}
	else
	die("Palavra passe antiga incorreta");
	 }
	}


 session_start();
 


 $tipo = $_SESSION['tipo'];
 $user = $_SESSION['MM_Username'];
if ($user)
 {
	 echo"
	 
	 <form action='mudapass.php' method='POST'>
	 		Password Antiga: <input type='password' name='oldpassword'><p>
			Password Nova: <input type='password' name='newpassword'><p>
	 		Repita a nova Password	: <input type='password' name='rnewpassword'><p>
			<input type='submit' name='submit' value='Confirmar'><p>
			</form>
			";
			
 }
 else
			die ( "Não tem sessão iniciada, inicie sessão <a href=http://localhost/index.php > aqui</a>") ;


	
	
	

 ?>
 

</body>
</html>