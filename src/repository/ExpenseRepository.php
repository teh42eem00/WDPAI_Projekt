<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Expense.php';

class ExpenseRepository extends Repository
{
    public function getExpensesLimit(int $id_car, $limit): array
    {
        $result = [];
        $stmt = $this->database->connect()->prepare('select * from expenses_with_types WHERE id_car = :id_car limit :limit');
        $stmt->bindParam(':id_car', $id_car, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
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

    public function getExpenseTypeId(string $expense_type)
    {
        $stmt = $this->database->connect()->prepare('SELECT expense_type_id FROM public.expense_types 
                    WHERE expense_type= :expense_type');
        $stmt->bindParam(':expense_type', $expense_type);
        $stmt->execute();
        $expense_type_id = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$expense_type_id) {
            return null;
        }

        return $expense_type_id['expense_type_id'];
    }

    public function addExpense(Expense $expense): void
    {
        $stmt = $this->database->connect()->prepare('INSERT INTO expenses(expense_type_id, expense_amount, id_car, mileage, created_at)
        VALUES (?, ?, ?, ?, ?)');
        $expense_type_id = $expense->getExpenseTypeId();
        $expense_amount = $expense->getExpenseAmount();
        $id_car = $expense->getIdCar();
        $mileage = $expense->getMileage();
        $created_at = $expense->getCreatedAt();
        $stmt->execute([$expense_type_id, $expense_amount, $id_car, $mileage, $created_at]);
    }

    public function removeExpense($expense_id): void
    {
        $stmt = $this->database->connect()->prepare('DELETE from expenses where expense_id=:expense_id');
        $stmt->bindParam(':expense_id', $expense_id);
        $stmt->execute([$expense_id]);
    }

    public function getTotalExpenses($id_car): ?float
    {
        $stmt = $this->database->connect()->prepare('SELECT SUM (expense_amount) as total FROM expenses WHERE id_car = :id_car;');
        $stmt->bindParam(':id_car', $id_car);
        $stmt->execute();
        $total = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$total) {
            return 0;
        }

        return $total['total'];
    }

    public function getThisMonthExpenses($id_car): ?float
    {
        $stmt = $this->database->connect()->prepare('SELECT SUM (expense_amount) as this_month FROM expenses WHERE id_car = :id_car and 
                                                         extract (month from created_at) = extract(month from current_date)');
        $stmt->bindParam(':id_car', $id_car);
        $stmt->execute();
        $this_month = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$this_month) {
            return 0;
        }

        return $this_month['this_month'];
    }

    public function getPercentage($id_car, $expense_type_id): ?float
    {
        $stmt = $this->database->connect()->prepare('SELECT get_expense_category_percentage(:idcar,:expensetypeid)');
        $stmt->bindParam(':idcar', $id_car);
        $stmt->bindParam(':expensetypeid', $expense_type_id);
        $stmt->execute();
        $percentage = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$percentage) {
            return 0;
        }

        return $percentage['get_expense_category_percentage'] * 100;
    }


}
