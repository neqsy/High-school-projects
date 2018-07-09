<?php
$db = array(

      'host' => 'mariadb'
,
      'port' => 3306
,
      'user' => 'elektryk'
,
      'pass' => 'elektryk'
,
      'baza' => 'elektryk_pawelwitowski'
,
 'kodowanie' => 'utf8'
,
    'silnik' => 'InnoDB'
);
try {
  if( $sql = new PDO(
      'mysql:host=mariadb;dbname=elektryk_pawelwitowski;encoding=utf-8;port=3306',
      'elektryk',
      'elektryk'
    ) ) echo '<br>';

    $sql -> exec( 'use '. $db['baza'] );

  	$sql -> exec( 'set storage_engine='. $db['silnik'] );

  	$sql -> exec( 'set names '. $db['kodowanie'] );

} catch( PDOException $e ) { die( 'Nie połączono z bazą "baza"' ); }