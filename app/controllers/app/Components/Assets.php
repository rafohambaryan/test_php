<?php


namespace app\controllers\app\Components;


trait Assets
{
    private $javascript = '';
    private $css = '';

    public function __construct()
    {
        $this->recursion(ROOT . 'public/assets/css');
        $this->recursion(ROOT . 'public/assets/js');
        $this->recursion(ROOT . 'public/' . $this->permission . 'css');
        $this->recursion(ROOT . 'public/' . $this->permission . 'js');
    }

    private function asset($url)
    {
        $url = trim($url, '/');
        return $this->public . $url;
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