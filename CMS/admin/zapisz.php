<meta charset="utf-8"><?php 

if( count( $_POST ) ) { 

  require '../polacz_z_baza.php'; 

  $q = $sql->prepare( 'UPDATE `cms` SET `url`=?, `title`=?, `body`=?, `head`=? WHERE `id`=?' ); 

  if( $q->execute( array( $_POST['url'], $_POST['title'], $_POST['body'], $_POST['head'], $_POST['id'] ) ) ) 
    echo 'Zmiany zapisano!'; 

  else 
    echo 'Podstrona nie istnieje!'; 
} 

?><br><br><a href="./">powrót</a>