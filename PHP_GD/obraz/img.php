<?php

// ścieżka dostępu do pliku graficznego
$obr = __DIR__.'/zrzut.png';

// pobranie parametrów obrazka z pliku $obr
$dane = getimagesize( $obr );

//print_r($dane); exit;

// utworzenie zasobu obrazka z istniejącego pliku
$src = imagecreatefromjpeg( $obr );

$dst = imagecreatetruecolor( 200,200 );

// skopiowanie z przeskalowaniem zawartości obrazka $src do obrazka $dst
imagecopyresampled( $dst, $src, 0,0,($dane[0]-$dane[1])/2,0, 200,200, $dane[0],$dane[0] );

// zapis wygenerowanego obrazka do pliku na serwerze
imagepng( $dst, __DIR__.'/obrazek.png' );



