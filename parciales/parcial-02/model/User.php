<?php
require_once __DIR__ . '/../config/conexion.php';

class User{
  public static function findByUsernameOrEmail($u){
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM users WHERE username=:u OR email=:u LIMIT 1');
    $stmt->execute([':u'=>$u]);
    return $stmt->fetch();
  }

  public static function findById($id){global $pdo; $stmt=$pdo->prepare('SELECT * FROM users WHERE id=:id'); $stmt->execute([':id'=>$id]); return $stmt->fetch();}

  public static function register($username,$email,$password){
    global $pdo;
    $stmt=$pdo->prepare('INSERT INTO users (username,email,password) VALUES (:u,:e,:p)');
    $hash=password_hash($password,PASSWORD_DEFAULT);
    $stmt->execute([':u'=>$username,':e'=>$email,':p'=>$hash]);
    return $pdo->lastInsertId();
  }

  public static function authenticate($userOrEmail,$password){
    $user=self::findByUsernameOrEmail($userOrEmail);
    if(!$user) return false;
    if(password_verify($password,$user['password'])) return $user;
    return false;
  }
}
