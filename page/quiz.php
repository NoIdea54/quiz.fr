<?php

if(!isset($GLOBALS['auteur_session']['id_auteur']))
{
	echo "Vous devez être connecté en tant que rédacteur pour continuer.";
	return;
}

?>

<!-- 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
-->
<link rel="stylesheet" href="/css/quiz.css" />
<div class="creation_quiz">
	<h1>Création d'un Quiz</h1>
<link rel="stylesheet" type="text/css" href="/modules/bugtracker/css/style.css"/>
<?php

require_once __DIR__ ."/fonctions_bugtracker.php";

$db = connectdb_uf_var();

if(!isset($_GET["nb_page"]))
	$page = 1;
else
	$page = $_GET["nb_page"];
	
if(isset($_GET["order"]) && isset($_GET["type"]))
{
	$tri_html = "?order=$order&type=$type";
	$order = array("id", "date_creation", "titre", "description", "version", 
						"categorie", "etat", "navigateur", "priorite", "severite",
						"type", "votes");
	$type = array("asc", "desc");
	if(in_array(strtolower ($_GET["order"]), $order) && 
			in_array(strtolower($_GET["type"]), $type))
		$tri = true;
	else
		$tri = false;
}
else
{
	$tri = false;
}

$limite = 15;
$page_max = ceil(count_bug($db)/$limite);

?>

<br/>
<input type="button" id="bt_bouton_quiz" style="margin:auto;" name="nouveau_quiz" value="Nouvelle suggestion" onclick="self.location.href='/quiz/nouveau'"/>
<br/>
<br/>
<table id="table_bugtracker">
	<thead>
		<tr>
			<th id="tbt_img">
				
				<a href="/bugtracker/<?php echo $page;?>?order=titre&type=asc"></a>
				<a href="/bugtracker/<?php echo $page;?>?order=titre&type=desc"></a>
			</th>
			<th id="tbt_resume">
				Résumé
				<a href="/bugtracker/<?php echo $page;?>?order=titre&type=asc"><img src="/css/img/fleche_bas.svg"/></a>
				<a href="/bugtracker/<?php echo $page;?>?order=titre&type=desc"><img src="/css/img/fleche_haut.svg"/></a>
			</th>
			<th id="tbt_date">
				date
				<a href="/bugtracker/<?php echo $page;?>?order=date_creation&type=desc"><img src="/css/img/fleche_bas.svg"/></a>
				<a href="/bugtracker/<?php echo $page;?>?order=date_creation&type=asc"><img src="/css/img/fleche_haut.svg"/></a>
			</th>
			<th id="tbt_type">
				Type
				<a href="/bugtracker/<?php echo $page;?>?order=type&type=asc"><img src="/css/img/fleche_bas.svg"/></a>
				<a href="/bugtracker/<?php echo $page;?>?order=type&type=desc"><img src="/css/img/fleche_haut.svg"/></a>
			</th>
			<th id="tbt_categ">
				Catégorie
				<a href="/bugtracker/<?php echo $page;?>?order=categorie&type=asc"><img src="/css/img/fleche_bas.svg"/></a>
				<a href="/bugtracker/<?php echo $page;?>?order=categorie&type=desc"><img src="/css/img/fleche_haut.svg"/></a>
			</th>
			<th id="tbt_etat">
				Etat
				<a href="/bugtracker/<?php echo $page;?>?order=etat&type=asc"><img src="/css/img/fleche_bas.svg"/></a>
				<a href="/bugtracker/<?php echo $page;?>?order=etat&type=desc"><img src="/css/img/fleche_haut.svg"/></a>
			</th>
			<th id="tbt_votes">
				Votes
				<a href="/bugtracker/<?php echo $page;?>?order=votes&type=desc"><img src="/css/img/fleche_bas.svg"/></a>
				<a href="/bugtracker/<?php echo $page;?>?order=votes&type=asc"><img src="/css/img/fleche_haut.svg"/></a>
			</th>
		</tr>
	</thead>
	<tbody>
		
		<?php
			getBugs($db, $page, $page_max, $tri, $limite);
			
		?>
	</tbody>
</table>

<span class="nb_page">
<?php
	echo "page<a href='/bugtracker/1".$tri_html."'> 1 </a>";
	if($page > 4)
		echo "...";
	if($page > 3)
		echo "<a href='/bugtracker/".($page-2).$tri_html."'> ".($page-2)." </a>";
	if($page > 2)
		echo "<a href='/bugtracker/".($page-1).$tri_html."'> ".($page-1)." </a>";
	if($page > 1)
		echo "<a href='/bugtracker/".$page.$tri_html."'> ".$page." </a>";
	if($page_max>$page)
		echo "<a href='/bugtracker/".($page+1).$tri_html."'> ".($page+1)." </a>";
	if($page_max>$page+1)
		echo "<a href='/bugtracker/".($page+2).$tri_html."'> ".($page+2)." </a>";
	if($page+3 < $page_max)
		echo "...";
	if($page+2 < $page_max)
		echo "<a href='/bugtracker/".$page_max.$tri_html."'> ".$page_max." </a>";

?>
</span>
<input type="button" class="bt_bouton fright" name="nouveau_bug" value="Nouvelle suggestion" onclick="self.location.href='/bugtracker/nouveau'"/>

<?php mysqli_close($db); ?>

</div>

