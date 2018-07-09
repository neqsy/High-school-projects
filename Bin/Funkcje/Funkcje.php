<html>
	<head>
		<title>Funkcje</title>
	</head>
<body>
	
	<?php
	//strlen
	$a='qwewqewqa';
	echo $a ."=".strlen($a);
	echo "<br/>".htmlspecialchars('<br/>') ;
	//substr
	echo substr("Hellasasa world",6);
	echo "<br/>";
	//strpos
	echo strpos("I love php, I love php too!","php");
	echo "<br/>";
	//strstr
	echo strstr("Hello world!","ll");
	echo "<br/>";
	//stristr
	echo stristr("Hello world!","WORLD");
	echo "<br/>";
	//explode
	$str = "Hello world. It's a beautiful day.";
	print_r (explode(" ",$str));
	echo "<br/>";
	//print_r(str_split("Hello"));
	print_r(str_split("Hello"));
	echo "<br/>";
	//chr
	echo chr(52) . "<br>"; // Decimal value
	echo chr(052) . "<br>"; // Octal value
	echo chr(0x52) . "<br>"; // Hex value
	echo "<br/>";
	//ord
	echo ord("h")."<br>";
	echo ord("hello")."<br>";
	echo "<br/>";
	//htmlspecialchars
	$str = "This is some <b>bold</b> text.";
	echo htmlspecialchars($str);
	echo "<br/>";
	echo nl2br("One line.\nAnother line.");
	?>
</body>
<html>