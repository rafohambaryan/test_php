<?php

use app\controllers\app\BackendController;

class AdminController extends BackendController
{
    public function index_get()
    {
       return $this->view('index');
    }
}