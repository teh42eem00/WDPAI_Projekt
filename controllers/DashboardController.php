<?php

require_once 'AppController.php';

class DashboardController extends AppController{
    public function dashboard(){
        $hello = 'Welcome on Dashboard page!';
        return $this->render('dashboard',['greetings' => $hello]);
        // TODO return and render display.html
    }
}