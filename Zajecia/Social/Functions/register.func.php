<?php 
 
require_once "core.func.php";

function validateRegistrationData($login, $email, $pass, $passRepeat){
	global $db;
 	
 	if (empty($login) || (empty($email)) || (empty($pass)) || (empty($passRepeat))) {

 		return "Uzupełnij wszystkie pola";
 		
 	}
 	if ((mb_strlen($pass)) > 25){

 		return "Nick nie może mieć więcej niż 25 znaków";
 	}

 	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
 		
 		return "Podaj poprawny email";

 	}

 	if (mb_strlen($pass) < 4) {

 		return "Hasło musi być dłuższe niż 4 znaki";
 		
 	}
 	if ($pass != $passRepeat) {

 		return "Hasła muszą być takie same";

 	}
 	$stmt = $db->prepare('SELECT * FROM `users` WHERE `login`=? OR `email`= ? ');

 	$stmt->execute([$login,$email]);

 	if ($stmt->rowCount() !=0 ){

 		return "Taki nick lub email już istnieje";
 	}


 	return '';

}

 

 function register($login,$email,$pass){

 	global $db;
 	$pass = password_hash($pass, PASSWORD_DEFAULT);

 	
 	$stmt = $db->prepare('INSERT INTO `users`(`login`,`email`,`pass`) VALUES (?,?,?)');
 	if(!$stmt->execute([$login,$email,$pass])){
 	die('Wystąpił błąd podczas rejestracji użytkownika');
}

 	$userID = $db->lastInsertId();
 	$hash = createActivationLink($userID);
 	sendRegistrationMail($email,$hash);
 }
 function createActivationLink ($userID){
 	global $db;
 	$hash = md5(rand());
 	$stmt = $db->prepare('INSERT INTO `activation` (`user_id`,`code`) VALUES (?,?)');

 	if(!$stmt->execute([$userID,$hash])){
 		die('Wystąpił błąd podczas rejestracji');
 	}
 	return $hash;
 }

 function sendRegistrationMail($email,$hash){


 	$url = "https://platform.reculazy.com:4430/pawelwitowski/public/Zajecia/Social/activation.php?code=$hash";
 	mail($email, 'Rejestracja - PW', $url);


 }

