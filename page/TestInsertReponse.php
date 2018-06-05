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

	// id_quiz - id_question - numero_reponse - text - juste
	$result = insert_reponse($db, 71, 2, 3, "Test insert rep", 0);
	var_dump($result);
		
?>




</body>
</html>