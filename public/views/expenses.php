<?php
// cars.php
session_start();
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/expenses.css">

    <script src="https://kit.fontawesome.com/965112f277.js" crossorigin="anonymous"></script>
    <title>EXPENSES</title>
</head>

<body>
<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    ?>
    <div class="base-container">
        <?php include('menu.php') ?>
        <main>
            <?php include('header.php') ?>
            <section class="expenses">

                <?php
                if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                if (!empty($expenses)) { ?>

                    <div>
                        <h3>LAST EVENTS</h3>
                        <?php foreach ($expenses as $expense): ?>
                            <div id="<?= $expense->getExpenseId(); ?>">
                                <p><i class="fa-solid fa-calendar"></i> <?= $expense->getCreatedAt(); ?></p>
                                <p><i class="fa-solid fa-gauge-high"></i> <?= $expense->getMileage(); ?> km</p>
                                <p><?= $expense->getIcon($expense->getExpenseTypeId()) . ' ' . $expense->getExpenseType(); ?></p>
                                <p><i class="fa-solid fa-dollar-sign"></i> <?= $expense->getExpenseAmount(); ?>PLN</p>

                                <form class="removeExpense" action="removeExpense" method="POST">
                                    <input type="hidden" id="removeExpense" name="removeExpense"
                                           value="<?php echo $expense->getExpenseId(); ?>">
                                    <button type="submit"><i class="fa-solid fa-trash"></i> Remove</button>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div>
                        <h3>SUMMARY</h3>
                        <div class="summary">
                            <p>Total Cost: <?php echo $total ?></p>
                            <p>This Month: <?php echo $this_month ?></p>
                            <div class="percentages">
                                <p><i class="fa-solid fa-gas-pump"></i> <?php echo $percentage_fuel ?>%</p>
                                <p><i class="fa-solid fa-wrench"></i> <?php echo $percentage_service ?>%</p>
                                <p><i class="fa-solid fa-credit-card"></i> <?php echo $percentage_expenses ?>%</p>
                            </div>
                        </div>
                    </div>
                    <?php
                } elseif (is_null($expenses)) {
                    echo "<a href='" . '/cars' . "'>You need to select car first!</a>";
                } else echo "<a href='" . '/addExpense' . "'>You need to add expense first!</a>"; ?>
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