<?php

if (isset($_GET['kod'])) {
	highlight_file(__FILE__);
	exit;
}

$back = <<<END
<br/>
<br/>
<center><a href="../">Powrót do menu</a></center>
END;
$header = <<<END
	<!DOCTYPE html>
	<html lang="pl">
	<head>
		<title>Multi-multi</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
	<body style="margin: 0;">
END;

$form = <<<END
	<div style="font-family: Verdana, Sans-Serif; font-size: 12pt; width: 100%; text-align: center; margin: 40px 0 50px 0; padding:20px 0px 20px 0px; background-color: yellow">
	<form method="post" action="">
		<p style="margin-bottom: 20px;">Podaj od 1 do 10 liczb z przedziału od 1 do 80 oddzielając je przecinkami</p>
		<p><input style="font-size: 14pt;" type="text" name="numbers" style="width:200px"></p>
		<input style="margin-top: 20px; font-size: 12pt;" type="submit" value="Sprawdź wynik">
	</form>
	</div>
END;

$errorMessage = <<<END
	<div style="color: white; background-color: red; width: 500px; margin: 20px auto 0 auto; padding: 10px; text-align: center;">message</div>
END;

$footer = <<<END
	</body>
	</html>
END;

$numberContainer = <<<END
	<div style="margin: 50px auto 20px auto; padding: 20px; background-color: yellow; text-align: center; font-family: Verdana, Sans-Serif;">
	Wylosowane liczby<br>
	<div style="margin: 10px auto 0 auto; font-size: 18pt;">numbers</div>
	</div>
END;

$numberHitContainer = <<<END
	<div style="margin: 50px auto 20px auto; padding: 20px; background-color: yellow; text-align: center; font-family: Verdana, Sans-Serif;">
	Trafione liczby<br>
	<div style="margin: 10px auto 0 auto; font-size: 18pt;">numbers</div>
	</div>
END;

$singleNumber = '<span style="display:inline-block; width: 7px;"></span>number<span style="display:inline-block; width: 7px;"></span>';


function showMessage($message) {
	global $errorMessage;
	echo str_replace('message' , $message, $errorMessage);
}

// przesłanie nagłówka strony
echo $header;

// jeżeli nie został przesłany formularz, wyświetl go
if (!isset($_POST['numbers']))
	echo $form;
else {

	$sendNumbers = trim(get_magic_quotes_gpc() ? stripslashes($_POST['numbers']) : $_POST['numbers']);

	// sprawdzenie czy podane zostały jakieś dane
	if (strlen($sendNumbers) == 0) {
		showMessage("Nie podałeś żadnej liczby");
		echo $form;
		echo $footer;
		exit;
	}

	$numbers = explode(",", $sendNumbers);

	// sprawdzenie ile liczb zostało podanych
	if (count($numbers) < 1 || count($numbers) > 10) {
		showMessage("Podałeś niewłaściwą ilość liczb");
		echo $form;
		echo $footer;
		exit;
	}

	// tablica zawierająca losowe liczby
	$randomNumbers = array();
	
	// zmienna zawierająca kod html
	$html = "";
	
	// pętla losująca 20 liczb
	for($i=0; $i<20; $i++) {
		// losuj liczbę dopóki występuje w tablicy 
		// - zakończ po wylosowaniu niewystępującej do tej pory liczby
		while (in_array($randomNumber=rand(1, 80), $randomNumbers));
		
		// dodaj ją do tablicy
		$randomNumbers[$i] = $randomNumber;
	}
	
	// posortowanie tablicy z liczbami losowymi od njamniejszej do największej
	sort($randomNumbers);
	
	// przygotuj kod html do przesłania przeglądarce
	foreach ($randomNumbers as $number)
		$html .= str_replace('number', $number, $singleNumber);
	
	// prześlij do przeglądarki wylosowane 20 liczb
	echo str_replace('numbers', $html, $numberContainer);
	
	// tablica do przechowania liczb trafionych
	$hitNumbers = array();
	
	// sprawdź które ze wskazanych liczb przez użytkownika, znajdują się wśród losowych
	foreach($numbers as $number)
		if (in_array($number, $randomNumbers))
			array_push($hitNumbers, $number);
	
	// przygotuj kod html i prześlij go do przeglądarki
	$html = "";
	foreach ($hitNumbers as $number)
		$html .= str_replace('number', $number, $singleNumber);	
	
	echo str_replace('numbers', $html, $numberHitContainer);
}

// przesłanie stopki strony
echo $footer;
echo $back;

?>