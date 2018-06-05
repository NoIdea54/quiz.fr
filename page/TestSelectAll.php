<?php
	header('Content-Type: application/json');
	// header('Content-Type: text/html; charset=utf-8');
	require_once __DIR__ . "/fonctions_quiz.php";
	// include_spip();
	$db = connectdb_uf_var();
	$result = select_full_quiz($db, 73);
	// var_dump($result);

	$res = json_encode($result, JSON_UNESCAPED_UNICODE);
	echo $res;
	
	
?>