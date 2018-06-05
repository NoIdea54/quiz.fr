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
	$result = warning_question($db, 40, 1);
	var_dump($result);
	
	if($result != NULL)
	{
		?>
		<script>alert("<?php echo htmlspecialchars('Il existe deja une question similaire', ENT_QUOTES); ?>")</script>
		<?php
	}
?>




</body>
</html>