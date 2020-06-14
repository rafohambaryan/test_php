<?php


namespace app\controllers\app\Components;


trait Views
{
    protected $permission;

    private $file;

    private $data;

    protected $title = 'site';

    private $public;

    protected function view($file, $data = [])
    {
        $this->public = PUBLIC_PATH . $this->permission;
        $this->file = $file;
        $this->data = $data;
        return @require_once VIEWS . $this->permission . 'app.php';
    }

    protected function back($url = null)
    {
        if ($url) {
            header("Location:" . ORIGIN . $url, true, 301);
        } elseif (isset($_SERVER['HTTP_REFERER'])) {
            header("Location:{$_SERVER['HTTP_REFERER']}", true, 301);
        } else {
            header("Location:" . ORIGIN, true, 301);
        }
        die;
    }

}