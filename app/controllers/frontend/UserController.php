<?php

use app\controllers\app\FrontController;
use app\define\Request;
use app\define\Send;

class UserController extends FrontController
{

    public function index_get()
    {
        $this->title = 'aaa';
//        \app\Models\UserAdmin::create([
//            'name' => 'sdf'
//        ]);
        $user = \app\Models\UserAdmin::findOne(1);
        $user->name = 123;
        echo "<pre>";
        var_dump($user->app->save($user));
        return $this->view('index');
    }

    public function index_post()
    {
        return 122;
    }

}