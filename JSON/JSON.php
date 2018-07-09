<?php
include "pokaz_kod.php";
$JSONfile = __DIR__.'/'."JSON.txt";
$plik = file_get_contents($JSONfile);
$baza = JSON_decode($plik, true);

$modified = false;

// Kod odpowiedzialny za usuwanie rekordu
if (isset($_GET['delete'])) {
	foreach ($baza as $key => $value) {
		if ($value[0] == $_GET['delete'])
			{
				unset($baza[$key]);
				$modified = true;
				break;
			}
	}
}

// Kod odpowiedzialny za zmianę rekordu
if (isset($_POST['modify'])) {
	foreach ($baza as $key => $value) {
		if ($value[0] == $_POST['index'])
			{
				$baza[$key][1] = $_POST['name'];
				$baza[$key][2] = $_POST['lastname'];
				$modified = true;
				break;
			}
	}
}

// Kod odpowiedzialny za dodawanie rekordu
if (isset($_POST['add'])) {

	$index = max(array_column($baza, 0)) + 1;

	array_push($baza, array($index, $_POST['name'], $_POST['lastname']));
	$modified = true;
}
	
if ($modified)
	file_put_contents($JSONfile, json_encode($baza));

// Przygotowanie HTML prezentującego dane
$html = '<table>';

foreach ($baza as $rekord) {
       
        $html.= '<tr>';
        foreach ($rekord as $wartosc)
        {
            $html.= '<td>'.$wartosc.'</td>';
        }
		
		$html.= '<td><a href="'.$_SERVER['PHP_SELF'].'?delete='.$rekord[0].'">X</a></td>';
        $html.= '</tr>';
        
}

$html.="</table>";

?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<title>Baza danych JSON</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<style>
		table {
		   border: 1px solid black;
		   border-collapse: collapse;
		}
		td {
		   border: 1px solid black;
		   padding: 10px;
		   font-size: 15pt;
		   font-family: Tahoma, Verdana, Sans-Serif;
		}
		
		a {
			color: red;
			font-weight: bold;"
		}
		
		[type=submit] { font-size: 12pt; padding: 10px; }
		[type=text] { font-size: 12pt; }
	</style>
</head>

<body>
	Zawartość bazy danych<br><br>

	<?php	echo $html; ?>

	<br>
	Dodaj nowy wiersz<br><br>

	<form action="" method="POST">
	
		<table>
			<tr><td>Imię</td><td>Nazwisko</td></tr>
			<tr>
			<td><input type="text" name="name" style="width: 250px;"></td>
			<td><input type="text" name="lastname" style="width: 250px;"></td>
			</tr>
		</table>
		<br>
		<input type="hidden" name="add">
		<input type="submit" value="Dodaj">
	</form>

	
	<br>
	Modyfikacja wiersza<br><br>

	<form action="" method="POST">
	
		<table>
			<tr><td>Indeks</td><td>Imię</td><td>Nazwisko</td></tr>
			<tr>
			<td><input type="text" name="index" style="width: 50px;"></td>
			<td><input type="text" name="name" style="width: 250px;"></td>
			<td><input type="text" name="lastname" style="width: 250px;"></td>
			</tr>
		</table>
		<input type="hidden" name="modify">
		<br>
		<input type="submit" value="Zmień">
	</form>
<br/>
<br/>
<center><a href="../">Powrót do menu</a></center>	
</body>
</html>
    

