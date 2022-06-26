<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Expense.php';

class ExpenseRepository extends Repository
{
    public function getExpensesLimit(int $id_car): array
    {
        $result = [];
        $stmt = $this->database->connect()->prepare('select * from expenses_with_types WHERE id_car = :id_car limit 3');
        $stmt->bindParam(':id_car', $id_car, PDO::PARAM_INT);
        $stmt->execute();
        $expenses = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($expenses as $expense) {
            $result[] = new Expense(
                $expense['expense_id'],
                $expense['expense_type_id'],
                $expense['id_car'],
                $expense['expense_amount'],
                $expense['expense_type'],
                $expense['mileage'],
                $expense['created_at']
            );
        }
        return $result;
    }
}