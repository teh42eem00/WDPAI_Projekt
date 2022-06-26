<?php
// cars.php
session_start();
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/expenses.css">

    <script src="https://kit.fontawesome.com/965112f277.js" crossorigin="anonymous"></script>
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
            <section class="car-form">
                <h1>Add new car</h1>
                <form action="addCar" method="POST">
                    <div class="messages">
                        <?php
                        if (isset($messages)) {
                            foreach ($messages as $message) {
                                echo $message;
                            }
                        }
                        ?>
                    </div>

                    <input name="brand" type="text" placeholder="Brand">
                    <input name="model" type="text" placeholder="Model">
                    <input name="production_year" type="text" placeholder="Production Year">
                    <input name="license_plate" type="text" placeholder="License Plate">

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

