<?php
require_once './models/User.php';

class AuthController
{
  private $userModel;

  public function __construct()
  {
    $this->userModel = new User();
  }

  public function login()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $user = $this->userModel->login($username, $password);

      if ($user) {
        session_start();
        $_SESSION['user'] = $user;
        header("Location: index.php?action=inventory");
      } else {
        echo "Invalid Credentials";
      }
    }

    require './views/login.php';
  }

  public function register()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $username = $_POST['username'];
      $password = $_POST['password'];

      if ($this->userModel->register($username, $password)) {
        header("Location: index.php?action=login");
      } else {
        echo "Registration Unsucessfull";
      }
    }

    require './views/register.php';
  }
}
