<?php
	//phpinfo();
	//if($_POST["key"] != key)...
	echo "<link rel='stylesheet' type='text/css' href='style.css'>";
	echo "<p>PHP file connected...</p>";
	echo "User: ".get_current_user()." as: ".shell_exec("whoami");
	echo "<br>";
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["zip"]["name"]);
	if(move_uploaded_file($_FILES["zip"]["tmp_name"], $target_file)) 
		echo "<h2> success </h2>";
	else echo "<h2> fail </h2>";
	$extract_dir = substr($target_file, strlen($target_dir), -4);
	$main = $_POST["mainclass"];
	$server_dir = "/var/www/html"; 
	$commands = array(
		0 => "ls -a",
		1 => "sudo mkdir '$server_dir/uploads/extracted/$extract_dir'",
                2 => "sudo unzip '$target_file' -d '$server_dir/uploads/extracted/$extract_dir'",
		3 => "sudo ls '$server_dir/uploads/extracted/$extract_dir' -a", 
		4 => "cd '$server_dir/uploads/extracted/$extract_dir'; ls -a;  sudo javac ".escapeshellarg($main)." -d '$server_dir/uploads/extracted/$extract_dir'", 
		5 => "cd '$server_dir/uploads/extracted/$extract_dir'; zip -r $server_dir/outputs/$extract_dir".".zip"." *" 
         );
	/*check if inputs are null, dont run run()*/
	run($commands,$extract_dir);
	function run($commands, $output_dir) {

		for($i = 0; $i < count($commands); $i++) {
			echo "<p class ='cmd'><b> Running: $commands[$i]</b> </p>";
			$res = shell_exec($commands[$i]);
			echo "<p class='shellres'>$res</p>";
			if($res == NULL) echo "<p class='shellres'>NULL</p>";
			echo "<hr class='breaks'>";
		}
		/* header("Location: http://68.101.98.197:8080/uploads"); */
		echo "<script> function download() {window.open('http://68.101.98.197:8080/outputs/"."$output_dir".".zip');}</script>";
		echo "<img src='fail' onerror='download()' style ='display:none;'/>";
	}
?>

