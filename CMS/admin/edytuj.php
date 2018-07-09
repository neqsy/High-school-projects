<meta charset="utf-8"><?php 

if( isset( $_GET['id'] ) ) { 

    require '../polacz_z_baza.php'; 
     
    $q = $sql->prepare( 'SELECT * FROM `cms` WHERE `id`=? LIMIT 1' ); 

    $q->execute( array( $_GET['id'] ) ); 
     
    if( $q->rowCount() ) list( $id, $url, $title, $body, $head ) = $q->fetch(PDO::FETCH_NUM); 
     
    else die( 'Nie ma takiej strony! <a href="./">powrót</a>' ); 
} 

?> 

<style> 
    table { width: 50%; } 
    th { text-align: right; vertical-align: top; } 
    table input,textarea { width: 100%; } 
    textarea { height: 400px; } 
</style> 

<form action="zapisz.php" method="post"> 
    <table> 
        
        <tr><th>adres:</th><td><input name="url" value="<?=$url?>"></td></tr> 
        <tr><th>head:</th><td><textarea name="head"><?=$head?></textarea></td></tr>
        <tr><th>tytuł:</th><td><input name="title" value="<?=$title?>"></td></tr> 
        <tr><th>treść:</th><td><textarea name="body"><?=$body?></textarea></td></tr>
    </table> 
     
    <input type="hidden" name="id" value="<?=$id?>"> 
    <input type="submit" value="zapisz"> 
</form>