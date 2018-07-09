<?php

 require '../polacz_z_baza.php'; 


$html = '<meta charset="utf-8"> 

         <style> 
            table { table-layout: } 
            th,td { padding: 5px; background: #ddd; } 
            th { border-bottom: 1px solid; } 
            td+td,th+th { border-left: 1px solid; } 
         </style> 

         <h1>Zaplecze administracyjne</h1> 

         <a href="nowa.htm">dodaj</a><br><br>'; 


$cms = $sql->query( 'SELECT `id`,`url`,`title`,`head` FROM `cms`' ) 
                 ->fetchAll( PDO::FETCH_NUM ); 


if( count( $cms ) ) { 

    $html .= '<table> 
                <tr><th>id</th><th>adres URL</th><th>tytuł</th><th>komendy</th></tr>'; 
     
    foreach( $cms as list( $id, $url, $title ) ) 
         
        $html .=    "
                    <tr><td>$id</td><td>$url</td><td>$title</td><td> 
                    <a href=\"../$url\" target=\"_blank\">podgląd</a> | 
                    <a href=\"edytuj.php?id=$id\">edytuj</a> | 
                    <a href=\"skasuj.php?id=$id\">skasuj</a></td></tr>"; 

    $html .= '</table>'; 

} else $html .= 'Brak podstron :-('; 


echo $html;