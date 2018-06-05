<?php
// Controlleur

/*
// ----------------- SECURISATION DE LA PAGE -----------------

// inclusion des fichiers nécessaires à la vérification de l'utilisateur
include("/ecrire/inc_session.php");
include("/ecrire/inc_version.php");


// vérifie si l'utilisateur est connecté en tant que rédacteur
verifier_visiteur();
if(isset($GLOBALS['auteur_session']['id_auteur']))
{
	$categorie_autorisee = array(0, 1);
	$categorie_user = $GLOBALS['auteur_session']['statut'][0];

	if(!in_array($categorie_user, $categorie_autorisee))
		$autorise = false;
	else
		$autorise = true;
}
else
{
	$autorise = false;
}
if(!$autorise)
{
	echo "Vous devez être connecté en tant que rédacteur pour continuer.";
	return;
}

// ----------------- FIN DE SECURISATION DE LA PAGE -----------------
*/
/*    A changer : émumlation spip     */

$GLOBALS['auteur_session']['id_auteur'] = 87;


/**/
include __DIR__ . "/../page/fonctions_quiz.php";

$db = connectdb_uf_var();

if(isset($_POST["requete"]))
{
	if($_POST["requete"] == "nouveau_quiz")
	{
		if(isset($_POST["nb_question"]))
		{
			header('Content-Type: application/json');
			
			$response = generer_quiz($db, $_POST["titre"], $GLOBALS['auteur_session']['id_auteur'], $_POST["nb_question"]);
			echo json_encode($response);	
		}
	}
	elseif($_POST["requete"] == "new_question")
	{
		if(isset($_POST["question_courante"]) && isset($_POST["id_quiz"]) && isset($_POST["text"]) && isset($_POST["multi"]) && isset($_POST["temps_reponse"]))
		{
			// header('Content-Type: application/json');
			// $id_quiz, $numero_question, $text, $multi, $temps_reponse
			$response = create_new_question($db, $_POST["id_quiz"], $_POST["question_courante"], $_POST["text"], $_POST["multi"], $_POST["temps_reponse"]);
			echo $response;	
		}
	}
	elseif($_POST["requete"] == "new_reponse")
	{
		if(isset($_POST["id_quiz"]) && isset($_POST["id_question"]) && isset($_POST["reponse_courante"]) && isset($_POST["text"]) && isset($_POST["bonne_reponse"]))
		{
			// header('Content-Type: application/json');
			// $id_quiz, $numero_question, $text, $multi, $temps_reponse
			$response = create_new_reponse($db, $_POST["id_quiz"], $_POST["id_question"], $_POST["reponse_courante"], $_POST["text"], $_POST["bonne_reponse"]);
			echo $response;	
		}
	}
	
	/*************************** UPDATE QUESTION ************************************/
		
		elseif($_POST["requete"] == "modif_question")
		{
			if(isset($_POST["id"]) && isset($_POST["numero_question"]) && isset($_POST["text"]) && isset($_POST["multi"]) && isBoolean($_POST["multi"]) && isset($_POST["temps_reponse"]))
			{
				$response = modif_question($db, $_POST["id"], $_POST["numero_question"],  $_POST["text"],  $_POST["multi"],  $_POST["temps_reponse"]);
			}
		}	
		
	/*************************** UPDATE REPONSE ************************************/	
		

		elseif($_POST["requete"] == "modif_reponse")
		{
			if(isset($_POST["id_quiz"]) && isset($_POST["id_question"]) && isset($_POST["id_reponse"]))
			{
				$response = modif_question($db, $_POST["id_quiz"], $_POST["id_question"],  $_POST["id_reponse"]);
			}
		}		
		
	/*************************** UPDATE QUIZ ************************************/
		
		elseif($_POST["requete"] == "modif_quiz")
		{
			if(isset($_POST["id"]) && isset($_POST["titre"]) && isset($_POST["nb_question"]))
			{
				$response = modif_question($db, $_POST["id"], $_POST["titre"],  $_POST["nb_question"]);
			}
		}		
		
	/*************************** PUBLIE Y/N ************************************/

		elseif($_POST["requete"] == "publie")
		{
			if(isset($_POST["id"]) && isset($_POST["publie"]))
			{
				$response = publie($db, $_POST["id_quiz"], $_POST["id_question"]);
			}
		}
		
	/*************************** INSERT QUESTION ************************************/	
		
		elseif($_POST["requete"] == "insert_question")
		{
			if(isset($_POST["id_quiz"]) && isset($_POST["numero_question"]) && isset($_POST["text"]) && isset($_POST["multi"]) && isBoolean($_POST["multi"]) && isset($_POST["temps_reponse"]))
			{
				$response = modif_question($db, $_POST["id_quiz"], $_POST["numero_question"],  $_POST["text"],  $_POST["multi"],  $_POST["temps_reponse"]);
			}
		}	
		
	/*************************** INSERT REPONSE ************************************/

		elseif($_POST["requete"] == "insert_reponse")
		{
			if(isset($_POST["id_quiz"]) && isset($_POST["id_question"]) && isset($_POST["numero_reponse"]) && isset($_POST["text"]) && isset($_POST["juste"]) && isBoolean($_POST["juste"]))
			{
				$response = modif_question($db, $_POST["id_quiz"], $_POST["id_question"], $_POST["id_question"],  $_POST["numero_question"],  $_POST["text"],  $_POST["juste"]);
			}
		}	
		
	/*************************** DELETE QUIZ ************************************/

		elseif($_POST["requete"] == "delete_quiz")
		{
			if(isset($_POST["id"]))
			{
				$response = delete_quiz($db, $_POST["id_quiz"]);
			}
		}
		
	/*************************** DELETE QUESTION ************************************/
		
		elseif($_POST["requete"] == "delete_question")
		{
			if(isset($_POST["id_quiz"]) && isset($_POST["numero_question"])) 
			{
				$response = delete_quiz($db, $_POST["id_quiz"], $_POST["numero_question"]);
			}
		}	
		
	/*************************** DELETE REPONSE ************************************/

		elseif($_POST["requete"] == "delete_reponse")
		{
			if(isset($_POST["id_quiz"]) && isset($_POST["id_question"]) && isset($_POST["numero_reponse"])) 
			{
				$response = delete_quiz($db, $_POST["id_quiz"], $_POST["id_question"], $_POST["numero_reponse"]);
			}
		}	
}


elseif(isset($_GET["requete"]))
{	
	/*************************** SELECT FULL QUIZ ***********************************/

		if($_GET["requete"] == "select_full_quiz")
		{
			if(isset($_GET["id"]))
			{
				$response = select_full_quiz($db, $_GET["id"]);
			}
			echo json_encode($reponse);
		}

	/*************************** SELECT QUESTION ************************************/

		if($_GET["requete"] == "select_question")
		{
			if(isset($_GET["id_quiz"])  && isset($_GET["numero_question"]))
			{
				$response = select_question($db, $_GET["id_quiz"], $_GET["numero_question"]);
			}
			echo $reponse;
		}
		
	/*************************** SELECT REPONSE ************************************/

		elseif($_GET["requete"] == "select_reponse")
		{
			if(isset($_GET["id_quiz"])  && isset($_GET["id_question"]) && isset($_GET["id_reponse"]))
			{
				$response = select_question($db, $_GET["id_quiz"], $_GET["id_question"], $_GET["id_reponse"]);
			}
		}

	/*************************** SELECT QUIZ ************************************/
		
		elseif($_GET["requete"] == "select_quiz")
		{
			if(isset($_GET["id"]))
			{
				$response = select_quiz($db, $_GET["id"]);
			}
			var_dump($response);
		}

	/*************************** WARNING QUESTION ************************************/

		elseif($_GET["requete"] == "warning_question")
		{
			if(isset($_GET["id_quiz"]) && isset($_GET["numero_question"]))
			{
				$response = warning_question($db, $_GET["id_quiz"], $_GET["numero_question"]);
			}
		}	
		
	/*************************** WARNING REPONSE ************************************/

		elseif($_GET["requete"] == "warning_reponse")
		{
			if(isset($_GET["id_quiz"]) && isset($_GET["id_question"]) && isset($_GET["numero_reponse"]))
			{
				$response = warning_question($db, $_GET["id_quiz"], $_GET["id_question"], $_GET["numero_reponse"]);
			}
		}		
}	
	
	// pour POST mettre dans le premier if 
	// Else if pour les GET 
	// GET utilisateur reçois. POST utilisateur envoie (DELETE post). PUT update des données 
	
	
	
	
mysqli_close($db);
?>