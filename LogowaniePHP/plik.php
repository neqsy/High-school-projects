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

	if (isset($_SESSION['autoryzacja'])){
	$html.='Witaj '.$login.'. Udało się uzyskać dostęp do pliku.</br><a href="wylogowanie.php"> Wyloguj się</a>';
	}
	else {
	$html.='Nie masz dostępu do pliku.</br><a href="index.html"> Zaloguj sie ponownie</a>';
	}
echo $html;
?>