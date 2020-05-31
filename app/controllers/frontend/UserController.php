<?php

use app\controllers\app\FrontController;
use app\define\Request;
use app\define\Send;

class UserController extends FrontController
{

    public function index_get()
    {
        $this->title = 'aaa';
        $user = $this->model('User');
        if (!$user->where('`email` = "a8a@dd.ss"', 'first')) {
            var_dump($user->create([
                'name' => 'aaaa',
                'email' => 'a8a@dd.ss',
                'password' => 'sdfdf'
            ]));
        }
        return $this->view('index');
    }

    public function index_post()
    {
        return 122;
    }

}