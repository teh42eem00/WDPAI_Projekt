<?php
// cars.php
session_start();
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/expenses.css">

    <script src="https://kit.fontawesome.com/965112f277.js" crossorigin="anonymous"></script>
    <title>Add Expense</title>
</head>

<body>
<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    ?>
    <div class="base-container">
        <?php include('menu.php') ?>
        <main>
            <?php include('header.php') ?>
            <section class="car-form">
                <h1>Add new expense</h1>
                <form class="add-expense" action="addExpense" method="POST">
                    <div class="messages">
                        <?php
                        if (isset($messages)) {
                            foreach ($messages as $message) {
                                echo $message;
                            }
                        }
                        ?>
                    </div>

                    <input name="expense_amount" type="text" placeholder="Expense amount">
                    <input name="mileage" type="text" placeholder="Car's mileage">
                    <input type="date" id="created_at" name="created_at">
                    <select name="expenseCategory" id="expenseCategory">
                        <optgroup label="Expense Categories">
                        <option value="Fuel">Fuel</option>
                        <option value="Service">Service</option>
                        <option value="Expenses">Other</option>
                    </select>
                    <button type="submit">add</button>
                </form>
            </section>
        </main>
    </div>
    <?php
} else {
    echo "Please " . "<a href='login'> login </a>" . " first!";
}
?>
</body>
</html>

