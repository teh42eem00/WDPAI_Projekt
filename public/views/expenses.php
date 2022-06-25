<?php
// expenses.php
session_start();
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/expenses.css">

    <script src="https://kit.fontawesome.com/723297a893.js" crossorigin="anonymous"></script>
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
            <section class="projects">
                <div id="project-1">
                    <img src="public/img/oil.svg">
                    <div>
                        <h2>Expense 1</h2>
                        <p>description</p>
                        <div class="social-section">
                            <i class="fas fa-heart"> 600</i>
                            <i class="fas fa-minus-square"> 121</i>
                        </div>
                    </div>
                </div>
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