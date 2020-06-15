<?php


namespace app\controllers\app\Components;


trait Assets
{
    private $javascript = '';
    private $css = '';
    protected $auto_load = 'auto-load';

    public function __construct()
    {
//        if (file_exists(ROOT . 'public/assets/js/jquery-3.5.1.min.js')) {
//            $this->javascript .= "<script src='" . PUBLIC_PATH . "assets/js/jquery-3.5.1.min.js' type='text/javascript'></script>";
//        }
        $this->recursion(ROOT . 'public/assets');
        $this->recursion(ROOT . 'public/' . $this->permission . $this->auto_load);
    }

    private function asset($url)
    {
        $url = trim($url, '/');
        return $this->public . $url;
    }

    private function js($url)
    {
        $url = trim($url, '/');
        if (file_exists(ROOT . 'public/' . $this->permission . $url) && pathinfo($url, PATHINFO_EXTENSION) === 'js') {
            return "<script src='" . PUBLIC_PATH . $this->permission . $url . "' type='text/javascript'></script>";
        }
        return "<script>console.error('Error 404: js file not fount " . PUBLIC_PATH . $this->permission . $url . "')</script>";
    }

    private function css($url)
    {
        $url = trim($url, '/');
        if (file_exists(ROOT . 'public/' . $this->permission . $url) && pathinfo($url, PATHINFO_EXTENSION) === 'css') {
            return "<link rel='stylesheet' href='" . PUBLIC_PATH . $this->permission . $url . "' type='text/css'/>";
        }
        return "<script>console.error('Error 404: css file not fount " . PUBLIC_PATH . $this->permission . $url . "')</script>";
    }

    private function recursion($dir): void
    {
        $recurse = glob($dir . '/*');
        foreach ($recurse as $index => $item) {
            if (is_dir($item)) {
                $this->recursion($item);
            } else {
                switch (pathinfo($item, PATHINFO_EXTENSION)) {
                    case 'js':
                        $this->javascript .= "<script src='" . PUBLIC_PATH . @end(@preg_split('/\/public\//', $item)) . "'></script>";
                        break;
                    case 'css':
                        $this->css .= "<link rel='stylesheet' href='" . PUBLIC_PATH . @end(@preg_split('/\/public\//', $item)) . "'/>";
                        break;
                }
            }
        }
    }
}