<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Expense.php';
require_once __DIR__ . '/../repository/ExpenseRepository.php';

class ExpenseController extends AppController
{
    private array $message = [];
    private ExpenseRepository $expenseRepository;

    public function __construct()
    {
        parent::__construct();
        $this->expenseRepository = new ExpenseRepository();
    }

    public function expenses()
    {
        session_start();
        $car_id = $_SESSION['selectedCarId'];
        $expenses = $this->expenseRepository->getExpensesLimit($car_id);
        $this->render('expenses', ['expenses' => $expenses]);
    }
}