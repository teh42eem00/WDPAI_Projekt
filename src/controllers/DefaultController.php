<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function index()
    {
        $this->render('login');
    }

    public function expenses()
    {
        $this->render('expenses');
    }

    public function cars()
    {
        $this->render('cars');
    }
}