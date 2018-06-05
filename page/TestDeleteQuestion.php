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
	// id quiz - numero question
	$result = select_question($db, 43, 1);
	var_dump($result);

	// id du quiz - num.Question
	$result = delete_question($db, X, Y);
	var_dump($result);
	
	// id quiz - numero question
	$result = select_question($db, 43, 1);
	var_dump($result);
?>




</body>
</html>