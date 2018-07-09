<?php 
require_once 'core.func.php';
function activate($code){

	global $db;

	$stmt = $db->prepare('SELECT * FROM `activation` WHERE `code` = ?');
	if(!$stmt->execute([$code])){
		die('Błąd podczas aktywacji');
	}
	$result = $stmt->fetch();
	$userID = $result['user_id'];
	$stmt = $db->prepare('UPDATE `users` SET `active` =1 WHERE `id`=?');

	if(!$stmt->execute([$userID])){
		die('Błąd podczas aktywacji');
	}

	$db->exec("DELETE FROM `activation` WHERE `id` = {$result['id']}");
	header ('Location:login.php');
}


 ?>