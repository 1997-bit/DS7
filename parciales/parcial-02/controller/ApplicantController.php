<?php
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../model/Applicant.php';

function redirect($url){header('Location: '.$url); exit;}

$action=$_POST['action'] ?? $_GET['action'] ?? '';
if($_SESSION['user_id']??false){
  $uid=$_SESSION['user_id'];
}else{redirect('../view/login.php');}

if($action==='save'){
  if(!validate_csrf($_POST['csrf'] ?? '')){die('Invalid CSRF');}
  $data=[
    'cedula'=>substr(trim($_POST['cedula'] ?? ''),0,50),
    'nombre'=>substr(trim($_POST['nombre'] ?? ''),0,100),
    'apellido'=>substr(trim($_POST['apellido'] ?? ''),0,100),
    'estado_civil'=>substr(trim($_POST['estado_civil'] ?? ''),0,50),
    'genero'=>substr(trim($_POST['genero'] ?? ''),0,20),
    'tipo_sangre'=>substr(trim($_POST['tipo_sangre'] ?? ''),0,10),
    'fecha_nacimiento'=>$_POST['fecha_nacimiento'] ?? null,
    'nacionalidad'=>substr(trim($_POST['nacionalidad'] ?? ''),0,100),
    'telefono'=>substr(trim($_POST['telefono'] ?? ''),0,50),
    'residencia'=>substr(trim($_POST['residencia'] ?? ''),0,1000),
    'correo'=>substr(trim($_POST['correo'] ?? ''),0,255),
  ];
  Applicant::saveOrUpdate($uid,$data);
  $_SESSION['success']='Información guardada';
  redirect('../view/formulario.php');
}

if($action==='change_status'){
  if(($_SESSION['role'] ?? '') !== 'rh'){die('Acceso denegado');}
  $id=(int)($_POST['id'] ?? 0); $status=substr($_POST['status'] ?? '',0,20);
  if(!in_array($status,['no revisado','no considerado','considerado'])){die('Estado inválido');}
  Applicant::changeStatus($id,$status);
  redirect('../view/rh_panel.php');
}
