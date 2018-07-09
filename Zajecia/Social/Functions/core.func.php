<?php  
$db = connectToDB('mariadb','elektryk','elektryk','elektryk_pawelwitowski');
function connectToDB($host,$user,$pass,$db){

try{
	$db = new PDO("mysql:host={$host};dbname={$db}",$user,$pass);

	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	return $db;
}catch (PDOExpection $error){
	die('Nie udało się połączyć z bazą danych');
}

	
}
