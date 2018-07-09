<?php
include "pokaz_kod.php";
try {
  if( $sql = new PDO(
      'mysql:host=localhost;dbname=elektryk;encoding=utf-8;port=3306',
      'elektryk',
      'elektryk'
    ) ) echo 'Połączono z bazą.<br>';

} catch( PDOException $e ) { die( 'Nie połączono z bazą "baza"' ); }

$sql->query( 'DROP table `tabela_33`' );

if( ! $sql->query( 'CREATE TABLE `tabela_33` ( `id` int(4) AUTO_INCREMENT,`imie` text, `nazwisko` text, PRIMARY KEY(id) ) DEFAULT CHARSET=utf8' ) )
    die('Nie udało się utworzyć tabeli "tabela_33"');
echo '<p>Utworzono tabelę "tabela_33"</p>';

if( $a = $sql->prepare( 'INSERT INTO `tabela_33` SET `imie`=?,`nazwisko`=?' ) ) {

  $a->execute($index($_POST['name'], $_POST['lastname']));
  echo 'Wstawiono rekord o id='. $sql->lastInsertId() .'<br>';

  $a->execute($index($_POST['name'], $_POST['lastname']));
  echo 'Wstawiono rekord o id='. $sql->lastInsertId() .'<br>';

  $a->execute($index($_POST['name'], $_POST['lastname']));
  echo 'Wstawiono rekord o id='. $sql->lastInsertId() .'<br>';

} else die( 'Nie udało się utworzyć nowych rekordów' );

$sql->prepare( 'UPDATE `tabela_33` SET `imie`=?,`nazwisko`=? WHERE `id`=2' )->execute( array( 'Adam','Wojtuś' ) ) ?? die('Nie udało się zauktualizować rekordu');
echo '<p>Zaktualizowano rekord</p>';

if( 0 == $l = $sql->exec( 'DELETE FROM `tabela_33` where `id`<3' ) ) die('Nie udało się usunąć rekordu');
echo '<p>Usunięto '. $l .' rekordy</p>';


$a = $sql->query( 'SELECT * FROM `tabela_33`' )
?? die('Nie udało się pobrać rekordów');

// $rekordy = $a->fetchAll( PDO::FETCH_ASSOC ); // FETCH_ASSOC => pola tylko z nazwami kolumn
foreach( $a as $rekord ) echo '<pre>'.print_r( $rekord, 1 ).'</pre>';
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
	
</body>
</html>