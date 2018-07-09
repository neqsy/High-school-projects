<?php 

// œcie¿ka URL do g³ównego folderu, w którym umieœciliœmy naszego CMS'a 
$root = rtrim(trim(dirname( $_SERVER['PHP_SELF']),'\\'),'/').'/'; 

// reszta adresu URL wzglêdem g³ównego folderu CMS'a 
$url = substr(rtrim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),'/'),strlen($root)); 

// do³¹czenie skryptu tworz¹cego obiekt klasy PDO po³¹czenia z baz¹ danych => $sql 
require 'polacz_z_baza.php'; 

// utworzenie szablonu zapytania o podstronê o ¿¹danym adresie url 
$q = $sql->prepare( 'SELECT * FROM `cms` WHERE `url`=? LIMIT 1' ); 

// wys³anie zapytania z bezpiecznym podpiêciem adresu url 
$q->execute( array( $url ) ); 

// jeœli strona o ¿¹danym adresie istnieje w bazie, do $w trafi rekord z bazy 
// w przeciwnym razie: $w = false 
$w = $q->fetch( PDO::FETCH_ASSOC ); 

// utworzenie zmiennych pomocniczych o wartoœciach z bazy 
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
