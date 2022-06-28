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

    public function getSessionCarId(): int
    {
        session_start();
        return $_SESSION['selectedCarId'];
    }

    public function expenses()
    {
        $car_id = $this->getSessionCarId();
        if (isset($car_id)) {
            $expenses = $this->expenseRepository->getExpensesLimit($car_id, 3);
        } else {
            $expenses = null;
        }
        $this->render('expenses', [
            'expenses' => $expenses,
            'total' => $this->expenseRepository->getTotalExpenses($car_id),
            'this_month' => $this->expenseRepository->getThisMonthExpenses($car_id),
            'percentage_fuel' => $this->expenseRepository->getPercentage($car_id, 1),
            'percentage_service' => $this->expenseRepository->getPercentage($car_id, 2),
            'percentage_expenses' => $this->expenseRepository->getPercentage($car_id, 3),
        ]);
    }

    public function history()
    {
        $car_id = $this->getSessionCarId();
        if (isset($car_id)) {
            $expenses = $this->expenseRepository->getExpensesLimit($car_id, null);
        } else {
            $expenses = null;
        }
        $this->render('history', ['expenses' => $expenses]);
    }


    public function addExpense()
    {
        if ($this->isPost()) {
            $car_id = $this->getSessionCarId();
            $expense_type_id = $this->expenseRepository->getExpenseTypeId($_POST['expenseCategory']);
            $expense = new Expense(0, $expense_type_id, $car_id, $_POST['expense_amount'],
                $expense_type_id, $_POST['mileage'], $_POST['created_at']);
            $this->expenseRepository->addExpense($expense);
            return $this->render('expenses', [
                'messages' => ['You succesfully added new expense!'],
                'expenses' => $this->expenseRepository->getExpensesLimit($car_id, 3),
                'total' => $this->expenseRepository->getTotalExpenses($car_id),
                'this_month' => $this->expenseRepository->getThisMonthExpenses($car_id)
            ]);
        }
        return $this->render('add-expense', ['messages' => $this->message]);
    }

    public function removeExpense()
    {
        if ($this->isPost()) {
            $car_id = $this->getSessionCarId();
            $this->expenseRepository->removeExpense($_POST['removeExpense']);
            return $this->render('expenses', [
                'messages' => ['You succesfully removed expense!'],
                'expenses' => $this->expenseRepository->getExpensesLimit($car_id, 3),
                'total' => $this->expenseRepository->getTotalExpenses($car_id),
                'this_month' => $this->expenseRepository->getThisMonthExpenses($car_id)
            ]);
        }
    }

}