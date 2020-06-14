<?php


namespace app\core;

class App
{
    private $controller;
    private $method;
    private $param;
    public $page_404 = false;

    public function __construct(string $controller, string $method, array &$param = [])
    {
        $this->controller = $controller;
        $this->method = $method;
        $this->param = $param;
    }

    public function __destruct()
    {
        if (file_exists(CONTROLLER . $this->controller . '.php')) {
            require_once CONTROLLER . $this->controller . '.php';
            $className = $this->controller;
            if (strpos($className, '\\')) {
                $className = @end(@explode('\\', $className));
            }
            $class = new $className;
            if (class_exists($className) and method_exists($class, $this->method)) {
                $this->run($class);
            } else {
                $this->page_404 = true;
            }
        } else {
            echo json_encode(['success' => '404', 'message' => "[ {$this->controller} ]  not fount"]);
            die;
        }
    }

    public function run($class): void
    {
        $data = call_user_func_array(array($class, $this->method), $this->param);
        if (METHOD !== 'GET' and $this->controller !== 'ErrorController') {
            echo json_encode($data);
            die;
        }
        switch ($data) {
            case 1:
                $this->page_404 = false;
                break;
            default:
                $this->page_404 = true;
        }
    }
}