<?php

use app\controllers\app\FrontController;
use app\define\Request;
use app\define\Send;

class UserController extends FrontController
{

    public function index_get()
    {
        $this->title = 'aaa';
        return $this->view('index');
    }

    public function experience_get()
    {
        $this->title = 'aaa';
        return $this->view('experience');
    }
    public function education_get()
    {
        $this->title = 'aaa';
        return $this->view('education');
    }
    public function skills_get()
    {
        $this->title = 'aaa';
        return $this->view('skills');
    }
    public function interests_get()
    {
        $this->title = 'aaa';
        return $this->view('interests');
    }
    public function awards_get()
    {
        $this->title = 'aaa';
        return $this->view('awards');
    }
    public function contact_get()
    {
        $this->title = 'contact';
        return $this->view('contact');
    }

    public function index_post()
    {
        return 122;
    }

}