<meta charset="utf-8"><?php 

if( isset( $_GET['id'] ) ) { 

  require '../polacz_z_baza.php'; 

  $q = $sql->prepare( 'DELETE FROM `cms` WHERE `id`=?' ); 

  $q->execute( array( $_GET['id'] ) ); 

  if( $q->rowCount() > 0 ) echo 'Podstrona została skasowana!'; 

  else echo 'Podstrona o podanym id nie istnieje!'; 
} 

?><br><br><a href="./">powrót</a>