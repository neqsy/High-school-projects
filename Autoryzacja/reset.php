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
<h3>Zmiana hasła</h3>
<form action="" method="post">

Podaj swój email: <input  type="text"	name="email" required><br/><br/>
<input type='submit' value='Wyślij'>
<input type="hidden" name="reset">

</form><br/><br/>

</div>
END;


echo $html;
$email = $_POST['email'];
$len = 20;
$r = substr(sha1(rand(1,10000)),0,$len);

if (isset($_POST['reset'])){
$user = $sql -> prepare( 'SELECT * FROM `uzytkownicy` WHERE `email`=? LIMIT 1');
$user -> execute( array( $_POST['email'] ) );


	if( $user -> rowCount() == 1 ){
 		
		$sql->prepare( 'UPDATE `uzytkownicy` SET `resetowanie`=? WHERE `email`=?' )
		->execute(array($r,$_POST['email']));

		mail($email,'Resetowanie hasła','Link do resetowania hasła:https://platform.reculazy.com/pawelwitowski/Autoryzacja/resetpass.php?reset='.$r);
		
		echo "Wysłaliśmy link do resetowania hasła";

	}else{

		echo "Taki email nie istnieje w bazie danych";

	}
	
}

echo "<br/><br/>";
echo '<a href="index.html">Powróć do strony logowania</a>';