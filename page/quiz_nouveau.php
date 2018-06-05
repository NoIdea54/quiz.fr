<?php
//vue
/*
if(!isset($GLOBALS['auteur_session']['id_auteur']))
{
	echo "Vous devez être connecté en tant que rédacteur pour continuer.";
	return;
}
*/
header('Content-Type: text/html; charset=latin-8859-1');
?>

<script type="text/javascript" src="/js/jquery.browser.min.js"></script>
<script type="text/javascript" src="/js/quiz.js"></script>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<?php
require_once __DIR__ . "/fonctions_quiz.php";
// include_spip();
$db = connectdb_uf_var();
?>

<div>
	<h3 class="bt_fields">Création d'un quiz</h3>
	</br>
	<div id="quiz_div">
		<div id="nb_question">
				<?php init_etats_quiz($db); ?>
		</div>
		<input type="button" id="bt_bouton_quiz" style="margin:auto;" name="nouveau_quiz" value="Créer le quiz" onclick="generer_nouveau_quiz();"/>
	</div>
</div>

<div>
	<div id="quiz_app">
	</div>
</div>
</br>
<input type="button" class="bt_bouton fleft" name="retour_quiz" value="Accueil ToDo Box" onclick="generer_nouveau_quiz()"/>
<input type="button" onclick="verif_nouveau_bug();return false;" class="bt_bouton fright" value="Soumettre"/>

<?php
mysqli_close($db);
?>
