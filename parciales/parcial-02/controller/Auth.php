<?php
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../model/User.php';

function redirect($url){header('Location: '.$url); exit;}

$action=$_POST['action'] ?? $_GET['action'] ?? '';
if($action==='register'){
  if(!validate_csrf($_POST['csrf'] ?? '')){die('Invalid CSRF');}
  $username=trim($_POST['username'] ?? '');
  $email=trim($_POST['email'] ?? '');
  $password=$_POST['password'] ?? '';
  if(strlen($password) < 15) { $_SESSION['error']='Contraseña muy corta'; redirect('../view/register.php'); }
  if(!preg_match('/[0-9]/',$password) || !preg_match('/[a-zA-Z]/',$password) || !preg_match('/[^a-zA-Z0-9]/',$password)){ $_SESSION['error']='Contraseña insegura'; redirect('../view/register.php'); }
  if(User::findByUsernameOrEmail($username) || User::findByUsernameOrEmail($email)){ $_SESSION['error']='Usuario o email ya existe'; redirect('../view/register.php'); }
  $uid=User::register($username,$email,$password);
  $_SESSION['user_id']=$uid; $_SESSION['username']=$username; $_SESSION['role']='applicant';
  redirect('../view/formulario.php');
}

if($action==='login'){
  if(!validate_csrf($_POST['csrf'] ?? '')){die('Invalid CSRF');}
  $u=$_POST['user'] ?? ''; $p=$_POST['password'] ?? '';
  $user=User::authenticate($u,$p);
  if(!$user){ $_SESSION['error']='Credenciales inválidas'; redirect('../view/login.php'); }
  $_SESSION['user_id']=$user['id']; $_SESSION['username']=$user['username']; $_SESSION['role']=$user['role'];
  redirect('../view/formulario.php');
}

if($action==='logout'){
  session_unset(); session_destroy(); redirect('../view/login.php');
}
