<?php
	//echo "<p> hi </p>";
	//var_dump($_POST);
	if(strcmp($_POST["password"], "niwhsa9") == 0)  {
		header("Location: http://68.101.98.197:8080/application.html");
		exit;
	}
	else echo "<p>incorrect password</p>";
?> 
