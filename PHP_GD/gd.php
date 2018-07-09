<?php 


// utworzenie zasobu obrazka o romiarach 800x600px
$dst = imagecreatetruecolor( 1000,800 );

// domyślne tło będzie przezroczyste
// imagecolortransparent( $dst, kolor( $dst, '000000' ) );

imagefilledrectangle( $dst, 0,0, 1000,800, kolor( $dst, 'ffffff' ) );

$czarny = imagecolorallocate( $dst, 1, 1, 1 );
$szary = imagecolorallocate( $dst, 255, 255, 0 );
$czerwony = imagecolorallocate( $dst, 255, 0, 0 );
$bialy = imagecolorallocate( $dst, 255, 255, 255 );

ImageFilledEllipse($dst,500,400,600,600,$szary);
ImageFilledEllipse($dst,500,570,200,200,$czarny);
ImageFilledEllipse($dst,500,605,130,130,$czerwony);
ImageFilledEllipse($dst,400,300,130,130,$czarny);
ImageFilledEllipse($dst,600,300,130,130,$czarny);



ImageString($dst,5,850,780,"Pawel Witowski",$czarny);


// nagłówek typu danych i wysłanie wygenerowanego obrazka do przeglądarki
header( 'Content-type: image/png' );
imagepng( $dst );

// zwolnienie pamięci z zasobu generowanego obrazka
imagedestroy( $dst );



// własna funkcja konwertująca kod html koloru na potrzeby imagecolorallocate
function kolor( $o, $k ) {
  return imagecolorallocate( $o, hexdec( substr($k,0,2) ),
                                 hexdec( substr($k,2,2) ),
                                 hexdec( substr($k,4,2) )
                           ); };








 ?>