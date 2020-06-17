<?php

use app\controllers\app\FrontController;
use app\define\Request;
use app\define\Send;

class UserController extends FrontController
{

    public function index_get()
    {
        $this->title = 'aaa';
        $model = new \app\Models\UserAdmin();
       var_dump($model->all());
        return $this->view('index');
    }

    public function index_post()
    {
        return 122;
    }

}