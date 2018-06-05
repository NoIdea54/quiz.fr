<!DOCTYPE html>
<html lang='fr'>
<head>
	<title>Test Fonction modifQuestion</title>
	<meta charset='latin-8859-1'>
</head>
<body>
<?php
	require_once __DIR__ . "/fonctions_quiz.php";
	// include_spip();
	$db = connectdb_uf_var();
	// id - id_quiz - numero_reponse
	$result = select_reponse($db, 72);
	var_dump($result);

	// id_quiz - id_question - numero_reponse
	$result = delete_reponse($db, X, Y, Z);
	var_dump($result);
	
	// id - id_quiz - numero_reponse	
	$result = select_quiz($db, 72);
	var_dump($result);
?>




</body>
</html>