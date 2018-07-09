<?php 

$html = <<<END
<body style="margin: 0;">
    <div style="font-family: Verdana, Sans-Serif; font-size: 12pt; width: 100%; text-align: center; margin: 200px 0 300px 0; padding:20px 0 20px 0; background-color: gray">
END;
if (!count($_GET)) { 
  header('Location: index.html'); 
  exit; 
} 
else { 

  try { 

      if( $sql = new PDO('mysql:host=mariadb;dbname=elektryk_pawelwitowski;encoding=utf8;port=3306', 'elektryk', 'elektryk')) {

        $kod=$_GET['kod1']; 
        $status=1; 

        $s = $sql -> prepare( 'SELECT * FROM `uzytkownicy` WHERE `status`=? AND `autoryzacja`=?' ); 
        $c = $sql -> prepare( 'SELECT * FROM `uzytkownicy` WHERE `autoryzacja`=?' ); 
        $s -> execute ( array( $status, $kod ) ); 
        $c -> execute ( array( $kod ) ); 

        if ($s -> rowCount() == 1) { 
          echo $html.='Twoje konto jest już aktywowane! <br/><a href="index.html">Wróć na stronę logowania</a>'; 
        } 
        else { 

         if ($c -> rowCount() == 1) { 

            $a = $sql -> prepare( 'UPDATE `uzytkownicy` SET `status`=?'); 
            $a -> execute ( array( $status ) ); 

            echo $html.='Twoje konto zostało aktywowane <br/><a href="index.html">Wróć na stronę logowania</a>'; 
         } 
        } 
      } 

    }  
  catch(PDOException $e) {  
      die('Nie połączono z bazą'); 
  } 
} 
include 'pokaz_kod.php';
?>