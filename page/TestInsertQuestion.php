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

	// id_quiz - numero_question - text - multi - temps_reponse
	$result = insert_question($db, 73, 2, "Tresni tset", 0, 33333);
	var_dump($result);
		
?>




</body>
</html>