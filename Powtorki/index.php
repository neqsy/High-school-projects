<?php
	if (count($_POST)) {
		$input = $_POST['textarea'];
		$text = htmlspecialchars($input);
		file_put_contents( __DIR__ .'/dane.txt', $text );
	}
	$data = file_get_contents( __DIR__ .'/dane.txt' );
	echo '	
		<form action="" method="post">
			<textarea name="textarea">'.$data.'</textarea><br/>
			<input type="submit" value="Wyslij"/>
		</form>
	</body>
	</html>';
?>
<!DOCTYPE html>
<html>
<head>
	<title>POWTORKI</title>
</head>
<body>

		
