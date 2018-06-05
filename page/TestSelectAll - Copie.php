<!DOCTYPE html>
<html lang='fr'>
<head>
	<title>Test Fonction modifQuestion</title>
	<meta charset='UTF-8'>
</head>
<body>
<?php
	require_once __DIR__ . "/fonctions_quiz.php";
	// include_spip();
	$db = connectdb_uf_var();
	$result = select_full_quiz($db, 73);
	var_dump($result);
	
	header('Content-Type: application/json');
	$res = json_encode($result, JSON_UNESCAPED_UNICODE);
	echo($res)
	?>




</body>
</html>