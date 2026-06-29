<?php
// app/core/App.php

class App {
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $url = $this->parseUrl();
        
        // Enforce global authentication
        $firstSegment = !empty($url[0]) ? strtolower($url[0]) : 'home';
        $allowed_public_routes = ['auth', 'home'];
        
        if (!in_array($firstSegment, $allowed_public_routes) && !isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        // [0] = controller
        if (!empty($url[0]) && file_exists('../app/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]);
        }

        require_once '../app/controllers/' . $this->controller . 'Controller.php';
        $controllerClass = $this->controller . 'Controller';
        $this->controller = new $controllerClass;

        // [1] = method
        if (!empty($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
            }
        }

        // [2+] = params
        $this->params = !empty($url[2]) ? array_slice($url, 2) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            $url = filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return [];
    }
}
