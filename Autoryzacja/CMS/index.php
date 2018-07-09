<?php
session_start();
if(isset($_SESSION['login'])){

// ocie?ka URL do g3ównego folderu, w którym umieociliomy naszego CMS'a 
$root = rtrim(trim(dirname( $_SERVER['PHP_SELF']),'\\'),'/').'/'; 

// reszta adresu URL wzgledem g3ównego folderu CMS'a 
$url = substr(rtrim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),'/'),strlen($root)); 

// do31czenie skryptu tworz1cego obiekt klasy PDO po31czenia z baz1 danych => $sql 
require 'polacz_z_baza.php'; 

// utworzenie szablonu zapytania o podstrone o ?1danym adresie url 
$q = $sql->prepare( 'SELECT * FROM `cms` WHERE `url`=? LIMIT 1' ); 

// wys3anie zapytania z bezpiecznym podpieciem adresu url 
$q->execute( array( $url ) ); 

// jeoli strona o ?1danym adresie istnieje w bazie, do $w trafi rekord z bazy 
// w przeciwnym razie: $w = false 
$w = $q->fetch( PDO::FETCH_ASSOC ); 

// utworzenie zmiennych pomocniczych o wartoociach z bazy 
$head = $w['head'];
$title = $w['title']; 
$body = $w === false ? 'Nie ma takiej strony' : $w['body']; 

// wygenerowanie kodu HTML podstrony z podstawieniem zmiennych pomocniczych 
echo <<<EOL
<!DOCTYPE><html lang="pl"> 
<head>$head<meta charset="utf-8"> 
<title>$title</title></head> 
<body>$body</body></html>
EOL;
}