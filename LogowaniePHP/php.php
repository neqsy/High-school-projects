<?php
session_start(); 
include 'tajne.php';
include 'pokaz_kod.php';
$body = <<<END
<body style="margin: 0;">
END;
$html = <<<END

<div style="font-family: Verdana, Sans-Serif; font-size: 12pt; width: 100%; text-align: center; margin: 200px 0 300px 0; padding:20px 0 20px 0; background-color: gray">

END;
echo $body;

	

		if(($_POST['login']==$login) && ($_POST['haslo']==$haslo)){
			$_SESSION['autoryzacja']=$login;
			$html.='Witaj '.$login.'! Udało ci się zalogować, przejdź dalej.</br><a href="plik.php"> Przejdź</a>';
		}
		else {
			$html.='Błędny login lub hasło.</br><a href="index.html"> Spróbuj ponownie</a>';
		}
echo $html;
?>