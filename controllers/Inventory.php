<?php
require_once '../models/Inventory.php';

class InventoryController {
    private $inventoryModel;

    public function __construct() {
        $this->inventoryModel = new Inventory();
    }

    public function listInventory() {
        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=login");
            exit;
        }
        $userId = $_SESSION['user']['id'];
        $inventory = $this->inventoryModel->getAllInventory($userId);
        require '../views/inventory_list.php';
    }

    public function createInventory() {
      session_start();
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $userId = $_SESSION['user']['id'];
          $itemName = $_POST['item_name'];
          $quantity = $_POST['quantity'];
          $description = $_POST['description'];
  
          if ($this->inventoryModel->addInventory($userId, $itemName, $quantity, $description)) {
              header("Location: index.php?action=inventory");
              exit;
          } else {
              echo "Failed to add inventory.";
          }
      }
  }
  

    public function editInventory($id) {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $itemName = $_POST['item_name'];
            $quantity = $_POST['quantity'];
            $description = $_POST['description'];

            if ($this->inventoryModel->updateInventory($id, $itemName, $quantity, $description)) {
                header("Location: index.php?action=inventory");
            } else {
                echo "Failed to update inventory.";
            }
        } else {
            $inventory = $this->inventoryModel->getInventoryById($id);
            require '../views/inventory_edit.php';
        }
    }

    public function deleteInventory($id) {
      if ($this->inventoryModel->deleteInventory($id)) {
          header("Location: index.php?action=inventory");
          exit;
      } else {
          echo "Failed to delete inventory.";
      }
  }
  
}
