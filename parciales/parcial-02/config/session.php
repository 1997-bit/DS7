<?php
if(session_status()===PHP_SESSION_NONE){
  ini_set('session.cookie_httponly',1);
  ini_set('session.use_strict_mode',1);
  session_start();
  if(empty($_SESSION['created'])){session_regenerate_id(true); $_SESSION['created']=time();}
  if(empty($_SESSION['csrf_token'])){$_SESSION['csrf_token']=bin2hex(random_bytes(24));}
}

function csrf_token(){return $_SESSION['csrf_token'] ?? '';} 
function validate_csrf($t){return hash_equals($_SESSION['csrf_token'] ?? '', $t);} 
