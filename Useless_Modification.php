<!DOCTYPE html>
<html lang="fr">

	<head>	
		<meta charset="utf8" />
		<title>Modification</title>
	</head>
	
	<body>
		
		<h1>Selection de la question à modifier :</h1><br><br>
	
		<?php
			if (isset($_POST['choix']))
			{			
				try
				{
					
				}
				catch (Exception $e)
				{
					die ('Erreur : ' . $e->getMessage());
				}
				
				while(
				{
					$id = $tranche['id'];
					$id_quiz = $tranche['id_quiz'];
					$numero_question = $tranche['numero_question'];
					$text = $tranche['text']; 
					$multi = $tranche['multi'];
					$temps_reponse= $tranche['temps_reponse'];
				}
				
				?>
				
					<form method="post">
					
						<input type="text" id="ID" name="IDD" value=""<?php echo $id; ?>" size="21" />
						<label for="ID">ID :</label>
						<input type="text" id="IdQuiz" name="IDQuiz" value="<?php echo $id_quiz; ?>" required /><br>
						<label for="IdQuiz">ID quiz :</label>
						<input type="text" id="NumQuestion" name="NumeroQuestion" value="<?php echo $numero_question; ?>" required /><br>
						<label for="NumQuestion">Num. question :</label>
						<input type="text" id="Texxt" name="Texxxt" value="<?php echo $text; ?>" required /><br>
						<label for="Texxt">Text :</label>
						<input type="checkbox" id="Multipl" name="Multiple" value="<?php echo $multi; ?>" required /><br>
						<label for="Multipl">Multi ? </label>
						<input type="text" id="Trep" name="Treponse" value="<?php echo $temps_reponse; ?>" required /><br>
						<label for="Trep">Temps réponse :</label>
						
						<div class="btn-modif">
							<center>
							<br><br><input class="button" type="submit" value="Valider la modification" name="Envoyer" required />
						</div>
						
					</form>
					
				<?php
			}
			

			elseif(1)
			{
				try
				{
					//$bdd = new PDO( 'mysql:host=localhost;dbname=spip2;charset=utf8', 'root', '' );
				}
				catch (Exception $e)
				{
					die ('Erreur : ' . $e->getMessage());
				}
				
				//$req = $bdd->prepare('UPDATE quiz_question SET id = :ID, id_quiz = :IdQuiz, numero_question = :NumQuestion, text = :Texxt, multi = :Multipl, temps_reponse = :Trep WHERE id='.$_POST['id'].';');
				//$req -> execute(array('ID' => $_POST['ID'],'IdQuiz' => $_POST['IdQuiz'],'NumQuestion' => $_POST['NumQuestion'],'Texxt' => $_POST['Texxt'],'Multipl' => $_POST['Multipl'],'Trep' => $_POST['Trep']));
				
				echo"<h2>Vous avez bien modifié la question</h2>";
				
			}
			
			elseif(1)
			{
		?>
				<form method="post">
		
					<select name="choix">
			
						<?php
				
							try
							{
								$bdd = new PDO( 'mysql:host=localhost;dbname=spip2;charset=utf8', 'root', '' );
							}
							catch (Exception $e)
							{
								die ('Erreur : ' . $e->getMessage());
							}
					
							$query = 'SELECT * FROM quiz_question WHERE id;';
							$reponse = $bdd->query($query);
					
							while ($tranche=$reponse->fetch())
							{
								echo '<option value=\'' .$tranche['id']. '\'>' .$tranche['id'].' '.$tranche['id_quiz'].' né le '.$tranche['numero_question'].' habite à '.$tranche['text'].' Pseudo : '.$tranche['PSEUDO'].' </option>';
							}					
						?>
			
					</select>
			
					<input class="btn-ok" type="submit" value="OK" name="OK" required />
		
				</form>
		
		<?php
			}
		?>
		
		<div class="btn-retour">
			<center>
			<br><br><input class="button" type="button" value="Retour à la creation de quiz" name="Retour" OnClick="window.location.href='quiz_nouveau.php' " />
		</div>
		
	</body>
	
</html>		