<?php
require_once "../config/session.php";
require_once "../model/Recordarme.php";

if(isset($_COOKIE["recuerdame"])){
    $rec = new Recordarme();
    $rec->borrar($_COOKIE["recuerdame"]);
    setcookie("recuerdame","",time()-3600,"/");
}
session_unset();    
session_destroy();  

header("Location: ../view/Login.php");
exit();
?>