<?php
class Inventory {
    private $db;

    public function __construct() {
        $this->db = Config::connect();
    }

    public function getAllInventory($userId) {
        $stmt = $this->db->prepare("SELECT * FROM inventory WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addInventory($userId, $itemName, $quantity, $description) {
        $stmt = $this->db->prepare("INSERT INTO inventory (user_id, item_name, quantity, description) 
                                    VALUES (:user_id, :item_name, :quantity, :description)");
        $stmt->execute([
            'user_id' => $userId,
            'item_name' => $itemName,
            'quantity' => $quantity,
            'description' => $description
        ]);
        return $stmt->rowCount() > 0;
    }

    public function getInventoryById($id) {
        $stmt = $this->db->prepare("SELECT * FROM inventory WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateInventory($id, $itemName, $quantity, $description) {
        $stmt = $this->db->prepare("UPDATE inventory SET item_name = :item_name, quantity = :quantity, description = :description WHERE id = :id");
        $stmt->execute([
            'item_name' => $itemName,
            'quantity' => $quantity,
            'description' => $description,
            'id' => $id
        ]);
        return $stmt->rowCount() > 0;
    }

    public function deleteInventory($id) {
        $stmt = $this->db->prepare("DELETE FROM inventory WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount() > 0;
    }
}
