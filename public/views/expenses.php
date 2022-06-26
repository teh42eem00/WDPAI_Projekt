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

                                <form class="expenseRemove" action="expenseRemove" method="POST">
                                    <input type="hidden" id="expenseRemove" name="expenseRemove"
                                           value="<?php echo $expense->getExpenseId(); ?>">
                                    <button type="submit">Remove</button>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <div>
                    <h3>SUMMARY</h3>
                </div>
                    <?php
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