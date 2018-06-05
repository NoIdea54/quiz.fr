<?php
/*
if(isset($_SERVER['HTTP_REFERER']))
{
    $domain_exploded = explode('/',$_SERVER['HTTP_REFERER']);
    $domain_complete = explode('.',$domain_exploded[2]);
    $domain = $domain_complete[count($domain_complete)-2].'.'.$domain_complete[count($domain_complete)-1];    if($domain == 'actuly.fr' || $domain == 'universfreebox.com' || $domain == 'www.quiz.fr')
    {    
        header("Access-Control-Allow-Origin: ".$domain_exploded[0].'//'.$domain_exploded[2]);
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: DELETE,GET,HEAD,PATCH,POST,PUT');
        header('Access-Control-Allow-Credentials: true');
    }
}
*/
if(isset($_GET["page"]) && !empty($_GET["page"]))
    include __DIR__ . "/" . $_GET["page"];
else if(isset($_GET["step"]) || isset($_POST["step"]))
    include __DIR__ . "/index_wp.php";
else
    echo "ko";
?>