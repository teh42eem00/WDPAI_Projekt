<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Expense.php';
require_once __DIR__ . '/../repository/ExpenseRepository.php';

class ExpenseController extends AppController
{
    public function expenses()
    {
        $this->render('expenses');
    }
}