<?php
$uploads_dir = __DIR__.'/foto/';
foreach ($_FILES["file"]["error"] as $key => $error) {
	if ($error == UPLOAD_ERR_OK) {
		$tmp_name = $_FILES["file"]["tmp_name"][$key];
		$name = basename($_FILES["file"]["name"][$key]);
		move_uploaded_file($tmp_name, "$uploads_dir/$name");
	   
}
}
/*foreach (glob("*.jpg") as $image) {
			echo '<img src="'.$image.'">';
		}*/
$r = 200; // bok miniatury 

$f = __DIR__ . '/foto/'; // die( '$f = "'. $f .'";' ); 

$oo = glob( $f . '*.jpg' ); // die( '<pre>'.print_r( $oo, 1 ) ); 

if( count( $oo ) ) { // jeśli istnieją jakieś zdjęcia, to: 

    foreach( $oo as $o ) { // die( $o ); 

        $x = end( explode( '/', $o ) ); // die( $x ); 
         
        $y = 'miniatury_2/' . $x; 
         
        $m = __DIR__ . '/' . $y; 

        if( ! file_exists( $m ) ) { // jeśli nie istnieje miniatura, to: 

            list( $src_w, $src_h ) = getimagesize( $o ); // die( '$src_w = '. $src_w .'; $src_h = '. $src_h .';' ); 

            $s = $src_w / $src_h; // s>1 => poziomy, s<1 => pionowy 

            $kr = $s>1   ?   $r / $s   :   $r * $s; // krótszy bok wklejanego zdjęcia do miniatury 

            $p = ( $r - $kr ) / 2; // szerokość szarych pasków na miniaturze 

            $dst = imagecreatetruecolor( $r, $r ); // stwórz pustą miniaturę 

            imagefilledrectangle( $dst, 0, 0, $r, $r, imagecolorallocate( $dst, 128, 128, 128 ) ); // wypełnij całą miniaturę kolorem szarym 
             
            imagecopyresampled( // wytnij całe zdjęcie i wklej przeskalowane do miniatury
                $dst, imagecreatefromjpeg( $o ), // pobierz obraz z pliku 
                $s>1 ? 0 : $p, $s>1 ? $p : 0, 
                0, 0, 
                $s>1 ? $r : $kr, $s>1 ? $kr : $r, 
                $src_w, $src_h 
            ); 

          imagejpeg( $dst, $m ); // zapisz miniaturę na serwerze 
           
          imagedestroy( $dst ); // zwolnij pamięć 
        } 

        echo '<a href="foto/'. $x .'" title="'. $x .'"><img src="'. $y .'"></a> &#160; ';
    } 

} else echo 'Brak zdjęć'; 

?></body></html>