<?php
// cars.php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>CARS</title>
    <script src="https://kit.fontawesome.com/965112f277.js" crossorigin="anonymous"></script>
</head>

<body>
<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    ?>
    <h1>
        CARS
    </h1>
    <section class="cars">
        <?php
        echo $cars->getLicensePlate();
        ?>
    </section>
    <?php
} else {

    echo "Please " . "<a href='login'> login </a>" . " first!";
}
?>
</body>
</html>