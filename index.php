<?php

//require_once __DIR__.'/controllers/DashboardController.php';
require 'Router.php';

$path = trim($_SERVER['REQUEST_URI'], '/');

Router::get('', 'DashboardController');
Router::get('dashboard', 'DashboardController');
Router::get('projects', 'ProjectsController');
Router::run($path);