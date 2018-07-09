<?php

require_once 'Functions/register.func.php';

	if (!empty($_POST)) {
		

		$login = $_POST['login'];
		$pass = $_POST['pass'];
		$email = $_POST['email'];
		$passRepeat = $_POST['password_repeat'];


		$error = validateRegistrationData($login,$email,$pass,$passRepeat);
		if (empty($error)) {
		register($login,$email,$pass);
		header('Location:login.php');
		}
		}
		
	

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Rejestracja</title>
</head>
<body>
	<form action=""	method="post">
		
	<input type="text" name="login" placeholder="Podaj login" required>
	<input type="email" name="email" placeholder="Podaj email" required>
	<input type="password" name="pass" placeholder="Podaj hasło" required>
	<input type="password" name="password_repeat" placeholder="Podaj hasło ponownie" required>
	<input type="submit" value="Wyślij">


	</form>
	<div class="errors">

	<?php 

		if (isset($error) && !empty($error)) {
			echo $error;
		}

	 ?>
		

	</div>
</body>
</html>