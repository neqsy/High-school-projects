<?php

if (isset($_GET['kod'])) {
	highlight_file(__FILE__);
	exit;
}
$back =<<<END
<br/>
<br/>
<center><a href="../">Powrót do menu</a></center>
END;
$header = <<<END
	<!DOCTYPE html>
	<html lang="pl">
	<head>
		<title>Szukanie maksymalnej liczby</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
	<body style="margin: 0;">
END;

$form = <<<END
	<div style="font-family: Verdana, Sans-Serif; font-size: 12pt; width: 100%; text-align: center; margin: 40px 0 50px 0; padding: 20px 0 20px 0; background-color: green">
	<form method="post" action="">
		<p style="margin-bottom: 20px;">Podaj dowolną ilość liczb oddzielając je przecinkami</p>
		<p><input style="font-size: 14pt;" type="text" name="numbers" style="width:200px"></p>
		<input style="margin-top: 20px; font-size: 12pt;" type="submit" value="Sprawdź wynik">
	</form>
	</div>
END;

$errorMessage = <<<END
	<div style="color: white; background-color: red; width: 500px; margin: 20px auto 0 auto; padding: 10px; text-align: center;">message</div>
END;

$resultMessage = <<<END
	<div style="color: black; background-color: #F0F0FF; width: 500px; margin: 20px auto 0 auto; padding: 10px; text-align: center;">message</div>
END;

$footer = <<<END
	</body>
	</html>
END;

$numberContainer = <<<END
	<div style="margin: 50px auto 20px auto; padding: 20px; background-color: green; text-align: center; font-family: Verdana, Sans-Serif;">
	Podane liczby<br>
	<div style="margin: 10px auto 0 auto; font-size: 18pt;">numbers</div>
	</div>
END;

$singleNumber = '<span style="display:inline-block; width: 7px;"></span>number<span style="display:inline-block; width: 7px;"></span>';


function showMessage($message, $html) {
	echo str_replace('message' , $message, $html);
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
		showMessage("Nie podałeś żadnej liczby", $errorMessage);
		echo $form;
		echo $footer;
		exit;
	}
	
	// zamiana łańcucha znaków na tablicę
	$numbers = explode(",", $sendNumbers);

	// zmienna zawierająca kod html
	$html = "";
	
	// przygotuj kod html do przesłania przeglądarce
	foreach ($numbers as $number)
		$html .= str_replace('number', $number, $singleNumber);
		
	// prześlij do przeglądarki wylosowane 20 liczb
	echo str_replace('numbers', $html, $numberContainer);

	// algorytm - przykład 1.11
	
	// pobrane liczby znajdują się w zmiennej numbers
	// tablica jest indeksowana od 0
	$max = $numbers[0];
	
	for ($i=1; $i<count($numbers); $i++) {
		if ($max<$numbers[$i])
			$max = $numbers[$i];
	}
	
	showMessage("Największa podana liczba to: <b>$max</b>", $resultMessage);
}


// przesłanie stopki strony
echo $footer;
echo $back;

?>