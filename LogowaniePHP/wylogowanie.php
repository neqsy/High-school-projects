<?php
session_start();
session_destroy();

include 'pokaz_kod.php';
$body = <<<END
<body style="margin: 0;">
END;
$html = <<<END

<div style="font-family: Verdana, Sans-Serif; font-size: 12pt; width: 100%; text-align: center; margin: 200px 0 300px 0; padding:20px 0 20px 0; background-color: gray">

END;
echo $body;
echo $html.="Wylogowałeś się.</br><a href=index.html>Wróć do strony logowania</a>";
?>