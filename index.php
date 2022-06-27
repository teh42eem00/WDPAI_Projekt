<?php

require 'Router.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('expenses', 'ExpenseController');
Router::get('history', 'ExpenseController');
Router::get('expensesTotal','ExpenseController');
Router::get('cars', 'CarController');
Router::post('carSelect', 'CarController');
Router::post('addCar', 'CarController');
Router::post('addExpense', 'ExpenseController');
Router::post('removeExpense', 'ExpenseController');
Router::post('register', 'SecurityController');
Router::post('login', 'SecurityController');
Router::post('logout', 'SecurityController');

Router::run($path);