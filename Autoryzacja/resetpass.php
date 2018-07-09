<html>
  <head>
    <meta charset="UTF-8">
    <title>Resetowanie hasła</title>
  </head>
    <body style="margin: 0;">
    <div style="font-family: Verdana, Sans-Serif; font-size: 12pt; width: 100%; text-align: center; margin: 200px 0 300px 0; padding:20px 0 20px 0; background-color: gray">
    <h2>Resetowanie</h2>
    <form action="" method="post" required>
      <div style="padding:10px;">
        Podaj nowe hasło: <input type=text name="haslo" required>
      </div>
      <div>
        
      <input type="submit" value="Zatwierdź">

      </div>
      </form>

        <div>
        
        <a href="index.html">Powrót do strony logowania</a>
      
      </div>

    </body>
  </div>
</html>

<?php 
$html = <<<END
<body style="margin: 0;">
    <div style="font-family: Verdana, Sans-Serif; font-size: 12pt; width: 100%; text-align: center; margin: 200px 0 300px 0; padding:20px 0 20px 0; background-color: gray">
END;
include "pokaz_kod.php";
if (!count($_GET)) { 
  header('Location: index.html'); 
}

if ($_POST){
    try { 

          if( $sql = new PDO('mysql:host=mariadb;dbname=elektryk_pawelwitowski;encoding=utf8;port=3306', 'elektryk', 'elektryk')) {
              
              $reset=$_GET['reset']; 
              $haslo = $_POST['haslo'];
              
              /*
              $salt = sha1(md5($haslo)); 
              $haslo = md5($haslo.$salt); 
              */
        $a = $sql -> prepare( 'SELECT * FROM `uzytkownicy` WHERE `resetowanie`=?'); 
        $a -> execute(array($reset)); 

        if ($a -> rowCount() == 1 ) { 

          $b = $sql -> prepare( 'UPDATE `uzytkownicy` SET `haslo`=? WHERE `resetowanie`=?' ); 
          $b -> execute(array($haslo, $reset )); 

          if ($b -> rowCount() == 1 ) { 
          echo $html.='Twoje hasło zostało zmienione pomyślnie<br/><br/><a href="index.html">Powrót do strony logowania</a>'; 
          } 
          
        }
      } 
      } 
    catch(PDOException $e) {  
          die('Nie połączono z bazą'); 
    } 
}

?>