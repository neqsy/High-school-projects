<html>
	<head>
		<title>Kalkulator</title>
	</head>
<body>

	<form method="post" action="">
	Podaj pierwszą liczbę: <input type="text" name="1">
	Podaj drugą liczbę:    <input type="text" name="2">
	<input type="submit" value="dodaj">
	</form>
	
	<?php
	$a=$_POST['1'];
	$b=$_POST['2'];
	echo $a."+".$b."=".($a+$b);
	<a href="">powrot</a>;
	?>
</body>
<html>