<?php 
$html = "";
$a = file_get_contents(__DIR__."/index3.txt");
$records = explode("\n",$a);

foreach ($records as $b){
    $pola = explode("\t",$b);
    $html .= '<tr>';
    foreach ($pola  as $pole) $html .='<td>'.$pole.'</td>';
    $html .= '</tr>';
}
echo '<meta charset="utf-8"><table border>'.$html.'</table>';
?>