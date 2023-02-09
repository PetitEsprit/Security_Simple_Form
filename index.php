<?php
	$servname = 'localhost';
	$dbname = 'form';
	$dbuser = 'root';
	$dbpass = 'root';
	
	function connect(PDO $pdo, String $name, String $pass)
	{
		try
		{
			$sql = "SELECT * FROM `users` WHERE `name` = '$name' AND `pass` = '$pass'";
			$res = $pdo->query($sql)->fetch();
			if (!empty($res))
			{
				echo 'Connected as "'. $res['name']. '"';
				return ;
			}
			echo 'Wrong Username/Password...';
		}
		catch(Exception $e)
		{
			echo $e->getMessage(), "\n";
			exit();
		}
	}

	function signup(PDO $pdo, String $name, String $pass)
	{
		try
		{
			//Check that $name not already created
			$sql = "SELECT * FROM `users` WHERE `name` = '$name' AND `pass` = '$pass'";
			$res = $pdo->query($sql)->fetch();
			if (!empty($res))
			{
				echo 'User Already Created...';
				return ;
			}
			//Register $user
			$sql = "INSERT INTO users (name, pass) VALUES (?,?)";
			$pass = hash('sha256', $pass);
			$stmt= $pdo->prepare($sql);
			$stmt->execute([$name, $pass]);
			echo 'New User \''. $name .'\' Created';
		}
		catch(Exception $e)
		{
			echo $e->getMessage(), "\n";
			exit();
		}
	}

	try
	{
		$pdo = new PDO("mysql:host=$servname;dbname=$dbname", $dbuser, $dbpass);
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
		exit();
	}

	$name = "";
	$pass = "";
	if (isset($_POST['signup']) || isset($_POST['login']))
	{
		$name = filter_var($_POST['user'], FILTER_SANITIZE_STRING);
		$pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
		$pass = hash('sha256', $pass);
	}

	//Button action
	if (isset($_POST['signup']))
	{
		if (strlen($_POST['user']) == 0 || strlen($_POST['pass']) == 0)
			echo 'Username/Password empty';
		else
			signup($pdo, $name, $pass);
	}
	else if (isset($_POST['login']))
		connect($pdo, $name, $pass);
	else if (isset($_POST['reset']))
	{
		/* Do Nothing */
	}

	//Main Form
	echo '<form method="post">';
	echo '<img src="logo.png" alt="Logo" width="50" height="50"> ';
	echo '<p>Identifiant : <input type="text" name="user" /></p>';
	echo '<p>Mot de passse : <input type="text" name="pass" /></p>';
	echo '<p><input type="submit" value="Log in" name="login"></p>';
	echo '<p><input type="submit" value="Reset" name="reset"></p>';
	echo '<p><input type="submit" value="Sign Up" name="signup"></p>';
	echo '</form>';
?>
