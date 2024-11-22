<?php
require_once './models/User.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function listUsers() {
      session_start();
      if (!isset($_SESSION['user'])) {
          header("Location: index.php?action=login");
          exit;
      }
      $users = $this->userModel->getAllUsers();
      require './views/users.php';
  }

    public function deleteUser($id) {
        $this->userModel->deleteUser($id);
        header("Location: index.php?action=users");
    }
}
