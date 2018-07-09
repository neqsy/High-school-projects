<?php
include 'pokaz_kod.php';

try {
  if( $sql = new PDO(
      'mysql:host=mariadb;dbname=elektryk_pawelwitowski;encoding=utf-8;port=3306',
      'elektryk',
      'elektryk'
    ) ) echo '<br>';

} catch( PDOException $e ) { die( 'Nie połączono z bazą "baza"' ); }

$html = <<<END
<body style="margin: 0;">
    <div style="font-family: Verdana, Sans-Serif; font-size: 12pt; width: 100%; text-align: center; margin: 200px 0 300px 0; padding:20px 0 20px 0; background-color: gray">
<div>
<h3>REJESTRACJA NOWEGO KONTA</h3>
<form action="" method="post">
Login: <input  type="text" name="login" required><br/><br/>
Haslo: <input  type="password" name="haslo" required><br/><br/>
Email: <input  type="text"	name="email" required><br/><br/>

<input type="hidden" name="register">
<br/>
<input type="submit" value="Zarejestruj">
</form><br/><br/>

</div>
END;

echo $html;
if (isset($_POST['register'])){
$user = $sql -> prepare( 'SELECT * FROM `uzytkownicy` WHERE `login`=?' );
$user -> execute( array( $_POST['login'] ) );
$len = 20;
$r = substr(sha1(rand(1,10000)),0,$len);


	if( $user -> rowCount() == 0 ){

		 $user = $sql -> prepare( 'SELECT * FROM `uzytkownicy` WHERE `email`=? LIMIT 1' );
         $user -> execute( array( $_POST['email'] ) );

         }if( $user -> rowCount() == 0 ){
		
		$sql->prepare( 'INSERT INTO `uzytkownicy` (`login`, `haslo`,`email`,`autoryzacja` ) VALUES(?,?,?,?)' )
		->execute(array( $_POST['login'],$_POST['haslo'],$_POST['email'],$r));
		echo "Gratulacje! Udało Ci się zarejestrować konto :)";
		
		echo "Na email przesłaliśmy link aktywacyjny.";

		mail($_POST['email'],"Kod aktywacyjny",'Link aktywacyjny:https://platform.reculazy.com/pawelwitowski/Autoryzacja/activation.php?kod1='.$r);


	  	}else{

	  		echo('Taki login lub email już istnieje :)');

     }
} 
echo "<br/><br/>";
echo '<a href="index.html">Powróć do strony logowania</a>';