<?php
// cars.php
session_start();
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/expenses.css">

    <script src="https://kit.fontawesome.com/723297a893.js" crossorigin="anonymous"></script>
    <title>CARS</title>
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
                <?php foreach ($cars as $car): ?>
                    <div id="<?= $car->getIdCar(); ?>">
                        <div>
                            <h2><?= $car->getBrand() . " " . $car->getModel(); ?></h2>
                            <h3><?= $car->getProductionYear(); ?></h3>
                            <p><?= $car->getLicensePlate(); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
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