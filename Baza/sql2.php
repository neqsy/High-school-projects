<?php
include "pokaz_kod.php";

try {
  if( $sql = new PDO(
      'mysql:host=mariadb;dbname=elektryk_pawelwitowski',
      'elektryk',
      'elektryk'
    ) ) echo 'Połączono z bazą.<br>';

} catch( PDOException $e ) { die( $e->getMessage() ); }


// Kod odpowiedzialny za zmianę rekordu
if (isset($_POST['modify'])) {

	if (!$sql->prepare( 'UPDATE `tabela_33` SET `imie`=?,`nazwisko`=? WHERE `id`=?' )
		->execute(array( $_POST['name'],$_POST['lastname'],$_POST['index'])))
		echo('Nie udało się zmodyfikować rekordu w "tabela_33"');
}

// Kod odpowiedzialny za dodawanie rekordu
if (isset($_POST['add'])) {

	if (!$sql->prepare( 'INSERT into `tabela_33` (`imie`, `nazwisko`) VALUES(?,?)' )
		->execute(array( $_POST['name'],$_POST['lastname'])))
		echo('Nie udało się dodać rekordu w "tabela_33"');
}

// Kod odpowiedzialny za usunięcie rekordu
if (isset($_POST['delete'])) {

	if (!$sql->prepare( 'DELETE FROM `tabela_33` WHERE `id`=?' )
		->execute(array($_POST['index'])))
		echo('Nie udało się usunąć rekordu w "tabela_33"');
}

// Przygotowanie HTML prezentującego dane
$html = '<table>';

$a = $sql->query( 'select id,imie,nazwisko FROM `tabela_33`' )
	?? die('Nie udało się pobrać rekordów');
	
$rekordy = $a->fetchAll( PDO::FETCH_ASSOC ); // FETCH_ASSOC => pola tylko z nazwami kolumn

foreach ($rekordy as $rekord) {
       
        $html.= '<tr>';
        foreach ($rekord as $wartosc)
        {
            $html.= '<td>'.$wartosc.'</td>';
        }
		
		//$html.= '<td><a href="'.$_SERVER['PHP_SELF'].'?delete='.$rekord[0].'">X</a></td>';
        $html.= '</tr>';
}

$html.="</table>";

?>



<!DOCTYPE html>
<html lang="pl">
<head>
	<title>Baza danych MySQL</title>
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

	<br>
	Usunięcie wiersza<br><br>

	<form action="" method="POST">
	
		<table>
			<tr><td>Indeks</td><td><input type="text" name="index" style="width: 50px;"></td></tr>
		</table>
		<input type="hidden" name="delete">
		<br>
		<input type="submit" value="Usuń">
	</form>	
	
	<br><br>
	<center><a href="../">Powrót do menu</a></center>
</body>
</html>