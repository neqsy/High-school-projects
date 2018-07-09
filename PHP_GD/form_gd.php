<?php

function kolor( $o, $k ) {
  return imagecolorallocate( $o, hexdec( substr($k,1,2) ),
                                 hexdec( substr($k,3,2) ),
                                 hexdec( substr($k,5,2) )
                           ); };

$colorText = $_POST['colorText'];
$colorBack = $_POST['colorBack'];
$height = $_POST['height'];
$width = $_POST['width'];
$text = $_POST['text'];
$x = $_POST['x'];
$y = $_POST['y'];
$fsize = $_POST['fsize'];

$dst = imagecreatetruecolor( $width,$height );
imagefilledrectangle( $dst, 0,0, $width,$height, kolor( $dst, $colorBack ) );
imagettftext( $dst, $fsize, 0, $x, $y, kolor( $dst, $colorText ),'Lato-Bold.ttf', $text );

header( 'Content-type: image/png' );
imagepng( $dst );
imagedestroy( $dst );

