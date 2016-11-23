<?php
	//phpinfo();
	echo "<p>PHP file connected...</p>";
	echo "User: ".get_current_user()." as: ".shell_exec("whoami");
	echo "<br>";
	var_dump($_FILES);
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["zip"]["name"]);
	echo "<h1>$target_file</h1>";
	if(move_uploaded_file($_FILES["zip"]["tmp_name"], $target_file)) 
		echo "<h2> success </h2>";
	else echo "<h2> fail </h2>";
	 $commands = array(
                0 => "cd uploads",
		1 => "rm -rf ./extracted/"
                1 => "unzip $target_file -d /var/www/html/uploads/extracted/",

         );

	run($commands);
	function run($commands) {

		for($i = 0; $i < count($commands); $i++) {
			echo "Running: $commands[$i]";
			$res = shell_exec($commands[$i]);
			echo "<p>$res</p>";
		}
	}
?>

