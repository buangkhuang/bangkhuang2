<?php

namespace App\Core;

class Router {
    
    protected $routes = [];
    protected $defaultRoute = 'DashboardController@index';

    // Phương thức thêm định tuyến
    public function add($method, $route, $action) {
        $this->routes[] = compact('method', 'route', 'action');
    }

    // Phương thức xử lý yêu cầu
    public function dispatch($url, $method) {
        foreach ($this->routes as $route) {
            // Match routes with dynamic parameters (e.g., /edit/{id})
            $pattern = preg_replace('/{[a-zA-Z_][a-zA-Z0-9_]*}/', '(\d+)', $route['route']);
            if (preg_match('#^' . $pattern . '$#', $url, $matches) && $route['method'] == $method) {
                // Extract parameters from URL
                $params = [];
                preg_match_all('#{([a-zA-Z_][a-zA-Z0-9_]*)}#', $route['route'], $paramNames);
                foreach ($paramNames[1] as $index => $paramName) {
                    $params[$paramName] = $matches[$index + 1];
                }
                // Call the action with parameters
                $this->callAction($route['action'], $params);
                return;
            }
        }
        
        // If no match found, call default route
        $this->callAction($this->defaultRoute);
    }

    // Phương thức gọi hành động (controller và method)
    private function callAction($action, $params = []) {
        list($controller, $method) = explode('@', $action);
        $controller = "App\\Controllers\\$controller";
        
        if(class_exists($controller)) {
            $controllerObj = new $controller();
            
            if(method_exists($controllerObj, $method)) {
                // Pass parameters to the controller method
                call_user_func_array([$controllerObj, $method], $params);
            } else {
                echo "Method $method not found in $controller.";
            }
        } else {
            echo "Controller $controller not found.";
        }
    }
}
?>
