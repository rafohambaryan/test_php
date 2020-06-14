<?php


namespace app\core;

use app\core\App;

class Route
{
    private $PARAM = [];

    private $DATA = [];

    public function __construct()
    {
        $_URL = $this->appendRequest();

        foreach (glob(ROOT . 'route/*.php') as $item) {
            $routes = require_once($item);
            if (is_array($routes)) {
                foreach ($routes as $i => $route) {
                    $content = preg_split('/@/', $route);
                    $isParam = false;
                    if (preg_match('/\/{param}/', $i)) {
                        $myRoute = explode('/', $i);
                        $clientRoute = explode('/', $_URL);
                        if (count($myRoute) === count($clientRoute)) {
                            $newPath = '';
                            for ($i = 0, $j = 0; $i < count($myRoute), $j < count($clientRoute); $i++, $j++) {
                                if ($myRoute[$i] !== '{param}' and $myRoute[$i] === $clientRoute[$j]) {
                                    $isParam = true;
                                    $newPath .= '/' . $clientRoute[$j];
                                } else if ($myRoute[$i] === '{param}' and $myRoute[$i] !== $clientRoute[$j]) {
                                    $isParam = true;
                                    $newPath .= '/' . $clientRoute[$j];
                                    array_push($this->PARAM, $clientRoute[$j]);
                                } else {
                                    goto init;
                                }

                            }
                            if ($isParam) {
                                $i = '/' . ltrim($newPath, '/');
                            }
                        }
                    }
                    if (count($content) === 2 and $_URL === $i) {
                        $this->DATA['controller'] = $content[0];
                        $this->DATA['method'] = $content[1] . '_' . strtolower(METHOD);
                        goto init;
                    }
                }
            }
        }
        init:
        $this->initError();
    }

    private function appendRequest(): string
    {
        if (METHOD !== 'GET') {
            $request = json_decode(file_get_contents('php://input', FILE_USE_INCLUDE_PATH), true);
            if (is_array($request)) {
                foreach ($request as $index => $item) {
                    $_REQUEST[$index] = $item;
                }
            }
        }
        $_URL = URL;
        if (preg_match('/[?]/', $_URL)) {
            $_URL = preg_split('/[?]/', $_URL)[0];
        }
        return (string)$_URL;
    }

    private function initError():void
    {
        if (empty($this->DATA)) {
            $this->DATA['controller'] = 'ErrorController';
            $this->DATA['method'] = 'index';
        }
    }

    public function __destruct()
    {
        $get = new App($this->DATA['controller'], $this->DATA['method'], $this->PARAM);
        if ($get->page_404) {
            return new App('ErrorController', 'index');
        }
        return true;
    }
}