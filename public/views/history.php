<?php
// cars.php
session_start();
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/history.css">

    <script src="https://kit.fontawesome.com/965112f277.js" crossorigin="anonymous"></script>
    <title>HISTORY</title>
</head>

<body>
<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    ?>
    <div class="base-container">
        <?php include('menu.php') ?>
        <main>
            <?php include('header.php') ?>
            <section class="history">

                <?php
                if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                if (!empty($expenses)) { ?>

                    <div>
                        <h3>HISTORY</h3>
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
                        <?php endforeach;
                } elseif (is_null($expenses)){
                    echo "<a href='" . '/cars' . "'>You need to select car first!</a>";
                }
                else echo "<a href='" . '/addExpense' . "'>You need to add expense first!</a>"; ?>
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