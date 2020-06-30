<?php


namespace app\core;

use DOMDocument;

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
        $url = str_replace('\\', '/', CONTROLLER . $this->controller . '.php');
        if (file_exists($url)) {
            require_once $url;
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
                $headers = [];
                foreach ($_SERVER as $name => $value) {
                    if ($name != 'HTTP_MOD_REWRITE' && (substr($name, 0, 5) == 'HTTP_' || $name == 'CONTENT_LENGTH' || $name == 'CONTENT_TYPE')) {
                        $name = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', str_replace('HTTP_', '', $name)))));
                        if ($name == 'Content-Type') $name = 'Content-type';
                        $headers[$name] = $value;
                    }
                }
                if (isset($headers['Data-Ajax'])) {
                    $data = str_replace('\\', '', $data);
                    $data = preg_split('/<body>|<\/body>/', html_entity_decode($data));

                    $title = preg_split('/<title>|<\/title>/', html_entity_decode(htmlentities($data[0])))[1];

                    echo json_encode(base64_encode(json_encode(['data' => $data[1], 'title' => $title])));
                    die;
                } else {
                    echo html_entity_decode($data);
                    die;
                }
        }
    }
}