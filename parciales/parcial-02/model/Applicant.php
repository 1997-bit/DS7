<?php
require_once __DIR__ . '/../config/conexion.php';

class Applicant{
  public static function findByUserId($user_id){global $pdo;$s=$pdo->prepare('SELECT * FROM applicants WHERE user_id=:uid LIMIT 1');$s->execute([':uid'=>$user_id]);return $s->fetch();}

  public static function saveOrUpdate($user_id,$data){global $pdo;
    $existing=self::findByUserId($user_id);
    if($existing){
      $stmt=$pdo->prepare('UPDATE applicants SET cedula=:ced,nombre=:nom,apellido=:ape,estado_civil=:ec,genero=:gen,tipo_sangre=:ts,fecha_nacimiento=:fn,nacionalidad=:na,telefono=:tel,residencia=:res,correo=:cor WHERE user_id=:uid');
      $stmt->execute([':ced'=>$data['cedula'],':nom'=>$data['nombre'],':ape'=>$data['apellido'],':ec'=>$data['estado_civil'],':gen'=>$data['genero'],':ts'=>$data['tipo_sangre'],':fn'=>$data['fecha_nacimiento'],':na'=>$data['nacionalidad'],':tel'=>$data['telefono'],':res'=>$data['residencia'],':cor'=>$data['correo'],':uid'=>$user_id]);
      return true;
    }else{
      $stmt=$pdo->prepare('INSERT INTO applicants (user_id,cedula,nombre,apellido,estado_civil,genero,tipo_sangre,fecha_nacimiento,nacionalidad,telefono,residencia,correo) VALUES (:uid,:ced,:nom,:ape,:ec,:gen,:ts,:fn,:na,:tel,:res,:cor)');
      $stmt->execute([':uid'=>$user_id,':ced'=>$data['cedula'],':nom'=>$data['nombre'],':ape'=>$data['apellido'],':ec'=>$data['estado_civil'],':gen'=>$data['genero'],':ts'=>$data['tipo_sangre'],':fn'=>$data['fecha_nacimiento'],':na'=>$data['nacionalidad'],':tel'=>$data['telefono'],':res'=>$data['residencia'],':cor'=>$data['correo']]);
      return $pdo->lastInsertId();
    }
  }

  public static function getAll(){global $pdo;$s=$pdo->query('SELECT a.*, u.username FROM applicants a JOIN users u ON a.user_id=u.id ORDER BY a.updated_at DESC');return $s->fetchAll();}

  public static function changeStatus($id,$status){global $pdo;$s=$pdo->prepare('UPDATE applicants SET estado=:st WHERE id=:id');return $s->execute([':st'=>$status,':id'=>$id]);}
}
