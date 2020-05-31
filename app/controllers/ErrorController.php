<?php

use app\controllers\app\FrontController;

class ErrorController extends FrontController
{
    public function index()
    {
        $this->title = 'error';
        return $this->view('error');
    }
}