<!DOCTYPE html>
<html lang='fr'>
<head>
	<title>Test Fonction modifQuestion</title>
	<meta charset='latin-8859-1'>
</head>
<body>

	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<?php
	
	require_once __DIR__ . "/fonctions_quiz.php";
	// include_spip();
	$db = connectdb_uf_var();

	if(warning_reponse($db, 49, 2, 3) !== False)
	{
		?>
		<script>alert("<?php echo htmlspecialchars('Il existe deja une reponse similaire !', ENT_QUOTES); ?>")</script>	
		<?php
	}
	else
	{
		// id_quiz - id_question - numero_reponse - text - juste
		$result = insert_reponse($db, 49, 2, 3, "Test insert rep", 0);
		var_dump($result);
		echo("réponse ajouté");
	}
	
	?>
	
	</br></br></br><center><input type=button value='Delete' onClick="valid_delete()"><center>
	
	<script type="text/javascript">
	<?php
	function valid_delete()
	{
		if(confirm('Voulez supprimez le(s) doublons ?'))
		{
			$resultat = delete_reponse($db, 71, 2, 3, "Test insert rep", 0);
			echo("ca marche");
		}
		else
		{
			echo("ca marche pas");
		}	
	}
	
	?>
	</script>


</body>
</html>	