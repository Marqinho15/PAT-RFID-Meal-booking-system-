<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_login_alunos = "localhost";
$database_login_alunos = "rfid";
$username_login_alunos = "root";
$password_login_alunos = "";
$login_alunos = mysql_pconnect($hostname_login_alunos, $username_login_alunos, $password_login_alunos) or trigger_error(mysql_error(),E_USER_ERROR); 
?>