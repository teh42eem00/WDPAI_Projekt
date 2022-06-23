<?php
// expenses.php
session_start();
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/expenses.css">

    <script src="https://kit.fontawesome.com/723297a893.js" crossorigin="anonymous"></script>
    <title>PROJECTS</title>
</head>

<body>
<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    ?>
    <div class="base-container">
        <nav>
            <img src="public/img/logo.svg">
            <ul>
                <li>
                    <i class="fas fa-project-diagram"></i>
                    <a href="#" class="button">Home</a>
                </li>
                <li>
                    <i class="fas fa-project-diagram"></i>
                    <a href="#" class="button">History</a>
                </li>
                <li>
                    <i class="fas fa-project-diagram"></i>
                    <a href="#" class="button">Add</a>
                </li>
                <li>
                    <i class="fas fa-project-diagram"></i>
                    <a href="#" class="button">Logout</a>
                </li>
            </ul>
        </nav>

        <main>
            <header>
                <div class="search-bar">
                    <form>
                        <input placeholder="search history">
                    </form>
                </div>
                <div class="add-project">
                    <i class="fas fa-plus"></i> Honda Accord
                </div>
                <div class="add-project">
                    <i class="fas fa-plus"></i> Add Vehicle
                </div>
            </header>
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