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
	$result = select_quiz($db, 1);
	var_dump($result);

	$result = modif_quiz($db, 1, "Val sharah", 9);
	var_dump($result);
	
	$result = select_quiz($db, 1);
	var_dump($result);
?>




</body>
</html>