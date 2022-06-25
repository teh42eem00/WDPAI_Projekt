<?php

class Expense
{
    private int $expense_id;
    private int $expense_type_id;
    private int $id_car;
    private float $expense_amount;
    private string $expense_type;

    /**
     * @param int $expense_id
     * @param int $expense_type_id
     * @param int $id_car
     * @param float $expense_amount
     * @param string $expense_type
     */
    public function __construct(int $expense_id, int $expense_type_id, int $id_car, float $expense_amount, string $expense_type)
    {
        $this->expense_id = $expense_id;
        $this->expense_type_id = $expense_type_id;
        $this->id_car = $id_car;
        $this->expense_amount = $expense_amount;
        $this->expense_type = $expense_type;
    }

    /**
     * @return int
     */
    public function getExpenseId(): int
    {
        return $this->expense_id;
    }

    /**
     * @param int $expense_id
     */
    public function setExpenseId(int $expense_id): void
    {
        $this->expense_id = $expense_id;
    }

    /**
     * @return int
     */
    public function getExpenseTypeId(): int
    {
        return $this->expense_type_id;
    }

    /**
     * @param int $expense_type_id
     */
    public function setExpenseTypeId(int $expense_type_id): void
    {
        $this->expense_type_id = $expense_type_id;
    }

    /**
     * @return int
     */
    public function getIdCar(): int
    {
        return $this->id_car;
    }

    /**
     * @param int $id_car
     */
    public function setIdCar(int $id_car): void
    {
        $this->id_car = $id_car;
    }

    /**
     * @return float
     */
    public function getExpenseAmount(): float
    {
        return $this->expense_amount;
    }

    /**
     * @param float $expense_amount
     */
    public function setExpenseAmount(float $expense_amount): void
    {
        $this->expense_amount = $expense_amount;
    }

    /**
     * @return string
     */
    public function getExpenseType(): string
    {
        return $this->expense_type;
    }

    /**
     * @param string $expense_type
     */
    public function setExpenseType(string $expense_type): void
    {
        $this->expense_type = $expense_type;
    }


}

