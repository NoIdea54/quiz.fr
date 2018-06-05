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
	
	
	$result = select_question($db, 1, 1);
	var_dump($result);

	// id_quiz - numero_question - text - multi - temps_reponse
	$result = modif_question($db, 1, 5, "Suramar", 1, 3900);
	var_dump($result);
	
	$result = select_question($db, 1, 1);
	var_dump($result);
?>




</body>
</html>