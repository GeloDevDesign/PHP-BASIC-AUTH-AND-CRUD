<?php

require_once './config.php';
require_once './controllers/AuthController.php';
require_once './controllers/UserController.php';
require_once './controllers/Inventory.php';
require_once './Router.php';
   
// Create a Router instance
$router = new Router();

// Define routes
$router->add('login', AuthController::class, 'login');
$router->add('register', AuthController::class, 'register');
$router->add('users', UserController::class, 'listUsers');
$router->add('delete', UserController::class, 'deleteUser');
$router->add('inventory', InventoryController::class, 'listInventory');
$router->add('inventory_create', InventoryController::class, 'createInventory');
$router->add('inventory_edit', InventoryController::class, 'editInventory');
$router->add('inventory_delete', InventoryController::class, 'deleteInventory');

// Dispatch the request
$action = $_GET['action'] ?? 'login';
$router->dispatch($action);
