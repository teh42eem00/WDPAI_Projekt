<?php

require 'Router.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('expenses', 'DefaultController');
Router::get('cars', 'CarController');
Router::post('register', 'SecurityController');
Router::post('login', 'SecurityController');
Router::post('logout', 'SecurityController');

Router::run($path);