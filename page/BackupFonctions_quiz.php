<?php
// Modèle
require_once __DIR__ . "/../modules/inc-connectdb.php";

define("NB_QUESTION_MAX", 30);

if(!defined("CHEMIN_ABSOLU_SITE"))
{
	$OS = strtoupper(substr(php_uname('s'), 0, 3));
	if ($OS == "WIN")
		define("CHEMIN_ABSOLU_SITE","D:/www/freezone/");
	else
		define("CHEMIN_ABSOLU_SITE","/home/mediadsl/freezone.fr/htdocs/");
}
/*
require_once CHEMIN_ABSOLU_SITE.'includes/lib_sql.php';
require_once CHEMIN_ABSOLU_SITE.'includes/obj_membre.php';
*/
if(!isset($_SESSION['id_membre_freezone']))
	$_SESSION['id_membre_freezone'] = 0;

function init_etats_quiz($db, $id = false)
{
	if(!$id)
	{
		print_nb_question_form();
		print_titre_form();
		
	}
	else
	{
		tabToMultiSelect($db, get_assoc_db($db, "quiz_etat"), "Etat", "quiz_etat", "&Eacute;tat",  $id);
		tabToMultiSelect($db, triCateg(get_assoc_db($db, "quiz_categorie", "id","libelle", "sous-categorie")), "Catégorie", "quiz_categorie", "Cat&eacute;gorie",  $id);
		tabToMultiSelect($db, get_assoc_db($db, "quiz_navigateur"), "Navigateur", "quiz_navigateur", "Navigateur",  $id);
		tabToMultiSelect($db, get_assoc_db($db, "quiz_priorite"), "Priorité", "quiz_priorite", "Priorit&eacute;",  $id);
		tabToMultiSelect($db, get_assoc_db($db, "quiz_severite"), "Sévérité", "quiz_severite", "S&eacute;v&eacute;rit&eacute;",  $id);
		tabToMultiSelect($db, get_assoc_db($db, "quiz_type"), "Type", "quiz_type", "Type",  $id);
	}
}
function print_nb_question_form($nb_question_max = 15)
{
	if($nb_question_max > 0 && $nb_question_max < NB_QUESTION_MAX)
	{
		echo "<div>Nombre de questions :";
		echo '<select name="quiz_nb_question" id="quiz_nb_question">';
		$compteur = 0;
		echo "";
		while($compteur++ < $nb_question_max)
		{
			echo '<option value="'. $compteur .'" class="">'. $compteur .'</option>';
		}
		echo '</select>';
		echo "</div>";
	}
}
function print_titre_form()
{
	
	echo "<div>Titre de votre Quiz :";
	echo '<textarea name="quiz_titre" id="quiz_titre">';
	
	echo '</textarea>';
	echo "</div>";
}

/** Permet de générer les pages du quiz lors de sa création
	nb_page_max : Est le nombre de questions que va contenir le quiz
	question_courante : le numéro de la question courante, si false alors début de quiz
	si == nb_question_max alors on est à la dernière page
*/
function generer_quiz($db, $titre, $id_membre, $nb_question_max, $question_courante = false)
{
	if($question_courante == false && $nb_question_max > 0 && $nb_question_max < NB_QUESTION_MAX)
	{
		$id_quiz = create_new_quiz($db, $titre, $id_membre, $nb_question_max);
		
		if($id_quiz == null)
		{
			return "nok";
		}
		else
		{
			$html = '<div class="quiz">';
			$html .= generer_question_form($nb_question_max);
			$html .= generer_reponse_form();
			$html .= '</div>';
			$html .= '<textarea name="quiz_text_area" id="quiz_text_area"></textarea>';
			$html .= '<input type="button" id="bouton_quiz_question" style="margin:auto;" name="bouton_quiz_question" value="Valider la question" onclick="send_new_question();"/>';
			$html .= '<input type="button" id="bouton_quiz_reponse" style="margin:auto;" name="bouton_quiz_reponse" value="Valider la réponse" onclick="send_new_reponse();"/>';
			$html .= '<input type="button" id="bouton_quiz_fin_reponse" style="margin:auto;" name="bouton_quiz_fin_reponse" value="Valider la réponse et la question" onclick="send_reponse_fin();"/>';
			$response = array("html"=>$html, "id_quiz" => $id_quiz);
			return $response;
		}
	}
}
function generer_question_form($nb_question_max, $question_courante = 1)
{
	$compteur = 0;
	$html = '<div id="numero_question">Question n°';
	$html .= '<select name="quiz_numero_question" id="quiz_numero_question">';
	// $html .= '<input id="reponse_muliple" type="checkbox">';
	
	
	
	while($compteur++ < $nb_question_max)
	{
		$html .= '<option value="'. $compteur .'" class=""';
		if($compteur == $question_courante)
		{
			$html .= ' selected=""';
		}
		$html .= '>'. $compteur .'</option>';
	}
	$html .= '</select>';
	$html .= '<label for="reponse_muliple">Réponse multiple</label>';
	$html .= '<input id="reponse_muliple" type="checkbox">';
	$html .= '<label for="temps_reponse">Durée de la question</label>';
	$html .= '<input id="temps_reponse" name="temps_reponse" value="0" type="number"> secondes';
	$html .= '</div>';
	return $html;
}
function generer_reponse_form($nb_reponse_max = 1, $reponse_courante = 1)
{
	$compteur = 0;
	$html = '<div id="numero_reponse">Réponse n°';
	$html .= '<select name="quiz_numero_reponse" id="quiz_numero_reponse">';
	
	if($reponse_courante == false)
		$html .= '<option value="'. $compteur .'" class="" selected="">'. $compteur .'</option>';
	while($compteur++ < $nb_reponse_max)
	{
		$html .= '<option value="'. $compteur .'" class=""';
		if($compteur == $reponse_courante )
		{
			$html .= ' selected=""';
		}
		$html .= '>'. $compteur .'</option>';
	}
	$html .= '</select>';
	$html .= 'Bonne réponse : <input id="reponse_juste" type="checkbox">';
	$html .= '</div>';
	return $html;
}
function create_new_quiz($db, $titre, $id_membre, $nb_question)
{
	if($nb_question > 0 && $nb_question < NB_QUESTION_MAX)
	{
		$query = "INSERT INTO `quiz` (`titre`, `id_membre`, `nb_question`) VALUES ('" . $titre . "', '" . $id_membre . "', '" . $nb_question . "')";

		$result= mysqli_query($db, $query);
		// récupère le dernier ID généré en base via l'auto-incrément d'un insert
		$id = mysqli_insert_id($db);
		if($result)
		{
			return $id;
		}
		else
		{
			return null;
		}
	}
}
function create_new_question($db, $id_quiz, $numero_question, $text, $multi, $temps_reponse)
{
	if($text != "" && $numero_question > 0)
	{
		if($multi === "true")
			$multi = 1;
		else
			$multi = 0;
		$query = 	"INSERT INTO `quiz_question` (`id_quiz`, `numero_question`, `text`, `multi`, `temps_reponse`) 
					VALUES ('" . $id_quiz . "', '" . $numero_question . "', '" . $text . "', '" . $multi . "', '" . $temps_reponse . "')";

		$result= mysqli_query($db, $query);
		// récupère le dernier ID généré en base via l'auto-incrément d'un insert
		$id = mysqli_insert_id($db);
		if($result)
		{
			return $id;
		}
		else
		{
			return "nok";
		}
	}
}
function create_new_reponse($db, $id_quiz, $id_question, $numero_reponse, $text, $juste)
{
	if($text != "" && $numero_reponse > 0)
	{
		$query = 	"INSERT INTO `quiz_reponse` (`id_quiz`, `id_question`, `numero_reponse`, `text`, `juste`) 
					VALUES ('" .$id_quiz . "', '"  . $id_question . "', '" . $numero_reponse . "', '" . $text . "', " . $juste . ")";
		$result= mysqli_query($db, $query);
		// récupère le dernier ID généré en base via l'auto-incrément d'un insert
		$id = mysqli_insert_id($db);
		if($result)
		{
			return $id;
		}
		else
		{
			return "nok";
		}
	}
}

/*************************** SELECT*UPDATE QUESTION ************************************/

function select_question($db, $id_quiz, $numero_question)
{
	if($id_quiz != "" )
	{
		$query = "SELECT * FROM quiz_question";
				
		if($numero_question != "") 
		{
			$query = "SELECT * FROM quiz_question";
		}
	}
	elseif($numero_question != "")
	{
		$query = "SELECT * FROM quiz_question";
	}
	else
	{
		return "nok";
	}
	$query .= " WHERE id_quiz = ".$id_quiz." AND numero_question = ".$numero_question.";";
	$result = mysqli_query($db, $query);
	$result = mysqli_fetch_row ($result);
	
	return $result;
}
// ne modifie pas le text 
function modif_question($db, $id_quiz, $numero_question, $text, $temps_reponse)
{
	if($text != "")
	{
		$query = "UPDATE quiz_question 	
				SET text = '".$text."'";
	
		if($temps_reponse != "")
		{
			$query = "UPDATE `quiz_question`
				SET temps_reponse = '".$temps_reponse."'";
		}
	}
	elseif($temps_reponse != "")
	{
		$query = "UPDATE `quiz_question`
				SET temps_reponse = '".$temps_reponse."'";
	}
	else
	{
		return "nok";
	}
	$query .= " WHERE id_quiz = ".$id_quiz." AND numero_question = ".$numero_question.";";
	$result = mysqli_query($db, $query);
	return $query;
}

/*************************** SELECT*UPDATE REPONSE ************************************/

function select_reponse($db, $id, $id_quiz, $numero_reponse)
{
	if($id_quiz != "" )
	{
		$query = "SELECT * FROM quiz_reponse";
				
		if($numero_reponse != "") 
		{
			$query = "SELECT * FROM quiz_reponse";
		}
	}
	elseif($numero_reponse != "")
	{
		$query = "SELECT * FROM quiz_reponse";
	}
	else
	{
		return "nok";
	}
	$query .= " WHERE id= ".$id." AND id_quiz = ".$id_quiz." AND numero_reponse = ".$numero_reponse.";";
	$result = mysqli_query($db, $query);
	$result = mysqli_fetch_row ($result);
	
	return $result;
}

//numero_question ne se modifie pas	
function modif_reponse($db, $id_quiz, $id_question, $numero_reponse, $text, $juste)
{
	//Premier if avec les 3 test
	if($id_quiz != "")
	{
		$query = "UPDATE quiz_reponse
				SET numero_reponse = '".$numero_reponse."'";
	
		if($text != "")
		{
			$query = "UPDATE `quiz_reponse`
					SET text = '".$text."'";
			if($juste != "")
			{
				$query = "UPDATE `quiz_reponse`
						SET juste = '".$juste."'";
			}
		}
	}
	//Else if avec 2 test
	elseif($text != "")
	{
		$query = "UPDATE `quiz_reponse`
				SET text = '".$text."'";
		if($juste != "")
		{
			$query = "UPDATE `quiz_reponse`
					SET juste = '".$juste."'";		
		}
	}
	//Else if 1 test
	elseif($juste != "")
	{
		$query = "UPDATE `quiz_reponse`
				SET juste = '".$juste."'";
	}
	else
	{
		return "nok";
	}
	$query .= " WHERE id_quiz = ".$id_quiz." AND id_question = ".$id_question." ;";
	$result = mysqli_query($db, $query);
	return $query;
}

/*************************** SELECT*UPDATE QUIZ ************************************/

function select_quiz($db, $id)
{
	if($id != "" )
	{
		$query = "SELECT * FROM quiz";
	}
	else
	{
		return "nok";
	}
	$query .= " WHERE id = ".$id." ";
	$result = mysqli_query($db, $query);
	$result = mysqli_fetch_row ($result);
	
	return $result;
}

function modif_quiz($db, $id, $titre, $nb_question)
{
	if($id != "")
	{
		$query = "UPDATE quiz 	
				SET titre = '".$titre."',
				nb_question = '".$nb_question."'";
		
	}
	else
	{
		return "nok";
	}
	$query .= " WHERE id= ".$id." ";
	$result = mysqli_query($db, $query);
	return $result;
}

/*************************** PUBLIE Y/N ************************************/

function publie($db, $id, $publie)
{
	if($id != "")
	{
		$query = "UPDATE quiz 	
				SET publie = '".$publie."' ";
	}
	else
	{
		return "nok";
	}
	$query .= " WHERE id= ".$id." ";
	$result = mysqli_query($db, $query);
	return $result;
}

/*************************** WARNING QUESTION ************************************/

function warning_question($db, $id_quiz, $numero_question)
{
	$query = "SELECT * FROM quiz_question WHERE (id_quiz,numero_question) IN (SELECT id_quiz,numero_question FROM quiz_question WHERE id_quiz = ".$id_quiz." GROUP BY 1,2 HAVING count(*)>1) ";
	// $query = "SELECT * FROM quiz_question WHERE id_quiz GROUP BY 1 HAVING count(*)>1) ";
	$result = mysqli_query($db, $query);
	$result = mysqli_fetch_row ($result);
	
	return $result;
}

/*************************** WARNING REPONSE ************************************/

function warning_reponse($db, $id_quiz, $id_question, $numero_reponse)
{
	$query = "SELECT * FROM quiz_reponse WHERE (id_quiz,id_question,numero_reponse) IN (SELECT id_quiz,id_question,numero_reponse FROM quiz_reponse WHERE id_quiz = ".$id_quiz." AND id_question = ".$id_question." GROUP BY 1,2, 3 HAVING count(*)>1) ";
	// $query = "SELECT * FROM quiz_question WHERE id_quiz GROUP BY 1 HAVING count(*)>1) ";
	$result = mysqli_query($db, $query);
	$result = mysqli_fetch_row ($result);
	
	return $result;
}

/*************************** DELETE QUIZ ************************************/

function delete_quiz($db, $id)
{
	if($id != 0)
	{
		$query = "DELETE FROM quiz WHERE id = ".$id." ;
				DELETE FROM quiz_question WHERE id_quiz = ".$id.";
				DELETE FROM quiz_reponse WHERE id_quiz = ".$id." ;";
	}
	$result = mysqli_query($db, $query);
	// $result = mysqli_fetch_row ($result);
	
	return $query;
}

/*************************** DELETE QUESTION ************************************/

function delete_question($db, $id_quiz, $numero_question)
{
	if(id_quiz != 0)
	{
		$query = "DELETE FROM quiz_question WHERE id_quiz = ".$id_quiz." AND numero_question = ".$numero_question." ;
				DELETE FROM quiz_reponse WHERE id_quiz = ".$id_quiz." AND id_question = ".$numero_question." ;";
	}
	
	$result = mysqli_query($db, $query);
	return $query;
}

/*************************** DELETE REPONSE ************************************/

function delete_reponse($db, $id_quiz, $id_question, $numero_reponse)
{
	if(id_quiz != 0)
	{
		$query = "DELETE FROM quiz_reponse WHERE id_quiz = ".$id_quiz." AND id_question = ".$id_question." AND numero_reponse = ".$numero_reponse." ";
	}
}

?>