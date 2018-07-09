<?php

$html = <<<END
<form method="post" action="">
Podaj url:
<input type="text" name="url">
Podaj tytuł:
<input type="text" name="tytul">
Podaj treść:
<input type="text" name="tresc">
<input type="submit" value="Wyślij">
<input type="hidden" name="cms">
</form>
END;

try {
  if( $sql = new PDO(
      'mysql:host=mariadb;dbname=elektryk_pawelwitowski;encoding=utf-8;port=3306',
      'elektryk',
      'elektryk'
    ) ) echo '<br>';

} catch( PDOException $e ) { die( 'Nie połączono z bazą "baza"' ); }


		if(isset($_POST['cms'])) {


				$url = $_POST['url'];
				$tytul = $_POST['tytul'];
				$tresc = $_POST['tresc'];

				$sql -> prepare( 'INSERT INTO `cms` (`url`,`tytul`,`tresc`) VALUES(?,?,?)'  ) 
          		-> execute(array($url,$tytul,$tresc));
          		echo "Zaktualizowano rekordy";
		}else{
			echo 'Nie udało się zaktualizować rekordów';
		}
echo $html;