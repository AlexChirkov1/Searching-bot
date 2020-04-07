<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search bot</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" href="./style.css">
</head>
<?php

$page = basename($_SERVER['PHP_SELF']);
$showNavbar = false;
session_start();

if ($page !== "index.php") {
    $showNavbar = true;
    if ($_SESSION['valid'] !== true && $_SESSION = ['username'] != 'admin') {
        header("Location: ./index.php");
        exit;
    }

}

if (isset($_GET['logout'])) {
    logout();
}

function logout()
{
    session_unset();
    session_destroy();
    header("Location: ./index.php");
}
?>

<body>
    <div class="nav-bottom-border <?php echo $showNavbar != false ? '' : 'hide'?>">
        <div class="container">
            <div class=row>
                <nav class="navbar navbar-expand-lg navbar-light">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link  <?php if ($page == 'savedsearch.php') {echo ' disabled active';}?>"
                                    href="./savedsearch.php">Saved searches</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if ($page == 'search.php') {echo ' disabled active';}?>"
                                    href="./search.php">Search </a>
                            </li>

                            <li class="nav-item to-right">
                                <a class="nav-link" href="?logout">Logout</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                </row>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">