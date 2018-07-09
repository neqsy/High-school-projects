<?php 

// �cie�ka URL do g��wnego folderu, w kt�rym umie�cili�my naszego CMS'a 
$root = rtrim(trim(dirname( $_SERVER['PHP_SELF']),'\\'),'/').'/'; 

// reszta adresu URL wzgl�dem g��wnego folderu CMS'a 
$url = substr(rtrim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),'/'),strlen($root)); 

// do��czenie skryptu tworz�cego obiekt klasy PDO po��czenia z baz� danych => $sql 
require 'polacz_z_baza.php'; 

// utworzenie szablonu zapytania o podstron� o ��danym adresie url 
$q = $sql->prepare( 'SELECT * FROM `cms` WHERE `url`=? LIMIT 1' ); 

// wys�anie zapytania z bezpiecznym podpi�ciem adresu url 
$q->execute( array( $url ) ); 

// je�li strona o ��danym adresie istnieje w bazie, do $w trafi rekord z bazy 
// w przeciwnym razie: $w = false 
$w = $q->fetch( PDO::FETCH_ASSOC ); 

// utworzenie zmiennych pomocniczych o warto�ciach z bazy 
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
