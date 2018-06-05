<?php
	if (!function_exists('connectdb_uf_var')) {	
		function connectdb_uf_var()
		{
			//les parametres pour la connexion
			$host="localhost";//Adresse serveur sql (ex:sql.free.fr);
			$login="root";
			$passe="";//Mot de passe sql
			$base="spip2";//Base (=login chez free)
			$db = mysqli_connect($host, $login, $passe, $base);
			return $db;
		}
	}
?>