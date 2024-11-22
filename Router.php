<?php

class Router {
    private $controllerMap = [];
    

    public function add($action, $controllerClass, $method) {
        $this->controllerMap[$action] = [$controllerClass, $method];
    }

    public function dispatch($action) {
    if (array_key_exists($action, $this->controllerMap)) {
        [$controllerClass, $method] = $this->controllerMap[$action];
        $controller = new $controllerClass();

        // Pass query parameters if needed
        $id = $_GET['id'] ?? null;

        // Check if the method requires an argument
        $reflection = new ReflectionMethod($controller, $method);
        if ($reflection->getNumberOfParameters() > 0) {
            $controller->$method($id);
        } else {
            $controller->$method();
        };

    } else {
        header("Location: index.php?action=login");
    }
}

}
