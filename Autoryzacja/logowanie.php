<?php
session_start();
// header('Location: logout.php');
include 'pokaz_kod.php';

$body = <<<END
<body style="margin: 0;">
END;
$html = <<<END

<div style="font-family: Verdana, Sans-Serif; font-size: 12pt; width: 100%; text-align: center; margin: 200px 0 300px 0; padding:20px 0 20px 0; background-color: gray">

END;



try {
  if( $sql = new PDO(
      'mysql:host=mariadb;dbname=elektryk_pawelwitowski;encoding=utf-8;port=3306',
      'elektryk',
      'elektryk'
    ) ) echo '';

} catch( PDOException $e ) { die( 'Nie po��czono z baz�' ); }

$login = $_POST['login'];

 
$user = $sql->prepare( 'SELECT * FROM `uzytkownicy` WHERE `login`=? AND `haslo`=? LIMIT 1' );
$user -> execute( array( $_POST['login'], $_POST['haslo']));

if( $user -> rowCount() == 1 ){
			
			$html.='Witaj '.$login.'! Uda�o ci si� zalogowa�</br><a href="logout.php"> Wyloguj si�</a><br/><a href="CMS/admin/index.php">Przejd� do panelu admina</a>';
			$fetch = $sql -> prepare ('SELECT * FROM `dane` WHERE `login`=?');
			$fetch -> execute (array ($_POST['login'])); 
            $data = $fetch -> fetchAll (PDO::FETCH_ASSOC);
            $_SESSION['login']=$login;
			       
    
		}
		else {

			$html.='B��dny login lub has�o.</br><a href="index.html"> Spr�buj ponownie</a>';
			
		}
echo $body;
echo $html;

?>