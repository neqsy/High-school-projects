<?php
if( count( $_POST ) ) { // jeśli odebrano coś z formularza... 

  require '../polacz_z_baza.php'; 

  $q = $sql->prepare( 'INSERT INTO `cms` SET `url`=?, `title`=?, `body`=?,`head`=?' ); 

  if( $q->execute( array( $_POST['url'], $_POST['title'], $_POST['body'],$_POST['head'] ) ) ) 
    echo 'Podstrona została utworzona! <a href="./">powrót</a>'; 

  else 
    echo 'Podstrona o podanym adresie istnieje już w bazie! <a href="nowa.htm">Popraw!</a>'; 
}