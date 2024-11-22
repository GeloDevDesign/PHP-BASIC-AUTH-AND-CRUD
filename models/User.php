<?php
class User {
  private $db;

  public function __construct()
  {
    $this->db = Config::connect();
  }

  public function register($username,$password){
    $stmt = $this->db->prepare("INSERT INTO users (username,password) VALUES (:username, :password)");
    $stmt->execute(['username' => $username, 'password' =>password_hash($password,PASSWORD_BCRYPT)]);
    return $stmt->rowCount() > 0;
  }

  public function login($username,$password){
    $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
      return $user;
    }

    return false;
  }

  public function getAllUsers(){
    $stmt = $this->db->query("SELECT * FROM users");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

 
  public function deleteUser($id){
      $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
      $stmt->execute(['id' => $id]);
      return $stmt->rowCount() > 0;
  }


}