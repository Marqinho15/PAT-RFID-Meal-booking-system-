<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>

<body>
<pre><br />$username = &quot;root&quot;;<br />$password = &quot;&quot;;<br />$host = &quot;localhost&quot;;<br />$database = &quot;rfid&quot;;<br /><br />$link = mysql_connect($host, $username, $password);<br />if (!$link) {<br />die('Could not connect: ' . mysql_error());<br />}<br /><br />mysql_select_db ($database);<br />
</pre>
</body>
</html>
