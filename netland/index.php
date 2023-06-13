<?php

require_once('services.php');

$niks = "bit_academy";

if (empty($_SESSION['loggedInUser'])) {
    header('Location:login.php');
}

if (empty($_GET['type'])) {
    $_SESSION['sortdirectionmovies'] = null;
    $_SESSION['sortdirectionseries'] = null;
}

if (empty($_GET['mediatype'])) {
    $_GET['mediatype'] = null;
}

if (isset($_GET['type']) && $_GET['type'] == "serie") {
    if (isset($_SESSION['sortdirectionseries']) && $_SESSION['sortdirectionseries'] == "DESC") {
        $_SESSION['sortdirectionseries'] = "ASC";
        $mediaseries = sortRatingSeries($pdo, "DESC");
        $_SESSION['lastsortdirectionseries'] = "DESC";
    } else {
        $_SESSION['sortdirectionseries'] = "DESC";
        $mediaseries = sortRatingSeries($pdo, "ASC");
        $_SESSION['lastsortdirectionseries'] = "ASC";
    }

    if (!empty($_SESSION['sortdirectionmovies'])) {
        $mediamovies = sortDurationMovies($pdo, $_SESSION['lastsortdirectionmovies']);
    }
}

if (isset($_GET['type']) && $_GET['type'] == "movie") {
    if (isset($_SESSION['sortdirectionmovies']) && $_SESSION['sortdirectionmovies'] == "DESC") {
        $_SESSION['sortdirectionmovies'] = "ASC";
        $mediamovies = sortDurationMovies($pdo, "DESC");
        $_SESSION['lastsortdirectionmovies'] = "DESC";
    } else {
        $_SESSION['sortdirectionmovies'] = "DESC";
        $mediamovies = sortDurationMovies($pdo, "ASC");
        $_SESSION['lastsortdirectionmovies'] = "ASC";
    }

    if (!empty($_SESSION['sortdirectionseries'])) {
        $mediaseries = sortRatingSeries($pdo, $_SESSION['lastsortdirectionseries']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netland!</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <a class="right" href="logout.php">Logout</a>
    <main class="column">
    <h1>Welkom op het <?=$dbname?> beheerders paneel</h1>
    <span>
        <a class="margin" href="index.php?type=&mediatype=series">Series</a>
        <a class="margin" href="index.php?type=&mediatype=movies">Films</a>
    </span>
        <?php if ($_GET['mediatype'] == 'series') {
            echo "<h2>Series</h2>";
            echo "<table><tbody><th>Title</th>";
            echo "<th><a href='index.php?type=serie&mediatype=series'>Rating</a></th><th>Bekijk details</th>";
            mediaTableSeries($mediaseries);
            echo "</tbody></table>";   
        } else {
            echo "";
        } 
        if ($_GET['mediatype'] == 'movies') {
            echo "<h2>Films</h2>";
            echo "<table><tbody><th>Title</th>";
            echo "<th><a href='index.php?type=movie&mediatype=movies'>Duur</a></th><th>Bekijk details</th>";
            mediaTableMovies($mediamovies);
            echo "</tbody></table>";
        } else {
            echo "";
        } ?>
        <div class="centerdiv"><a href="insert.php">Media toevoegen</a></div>
    </main>
</body>
</html>