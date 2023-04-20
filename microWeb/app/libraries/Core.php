<?php
/**
 * App Core Class
 * Creates URL & Loads core controller
 * URL FORMAT - /controller/method/params
 */ 
class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->getUrl();
        // Check if url has value and
        // look in controllers if the controller exists
        if ($url != null && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            // If exists set as controller
            $this->currentController = ucwords($url[0]);
            
            unset($url[0]);
        }

        // Require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';

        // Instantiate controller class
        $this->currentController = new $this->currentController();

        // Check for second part of url, the method that will be called
        if (isset($url[1])) {
            $method = $url[1];
            // Check to see if method exists in controller
            if (method_exists($this->currentController, $method)) {
                $this->currentMethod = $method;
            }
            unset($url[1]);
        }

        // Get parmaters if null set empty
        $this->params = $url ? array_values($url) : [];

        // Call Controller->Method with parameters
        call_user_func([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
