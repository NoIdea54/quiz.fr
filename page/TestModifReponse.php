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
	// WHERE id=id id_quiz=id_quiz et num.Question=Num.reponse
	$result = select_reponse($db, 14, 53);
	var_dump($result);

	// WHERE id_quiz = $id_quiz et id_question = $id_question -- numero_reponse -- text -- juste
	$result = modif_reponse($db, 53, 1, 2, "aaaaaaaaaaah", 0);
	var_dump($result);
	
	$result = select_reponse($db, 14, 53, 1);
	var_dump($result);
?>




</body>
</html>