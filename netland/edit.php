<?php

require_once('services.php');

if (isset($_GET['id'])) {
    $_SESSION['id'] = $_GET['id'];
}

if (isset($_GET['title'])) {
    $_SESSION['title'] = $_GET['title'];
}

if (isset($_GET['mediatype'])) {
    $_SESSION['mediatype'] = $_GET['mediatype'];
}

$id = $_SESSION['id'];
$title = $_SESSION['title'];
$mediatype = $_SESSION['mediatype'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_SESSION['mediatype'] == 'serie') {
        $title = $_POST['title'];
        $has_won_awards = $_POST['has_won_awards'];
        $seasons = $_POST['seasons'];
        $country = $_POST['country'];
        $spoken_in_language = $_POST['spoken_in_language'];
        $rating = $_POST['rating'];
        $summary = $_POST['summary'];
        updateSerieDetails($pdo, $title, $has_won_awards, $seasons, $country, $spoken_in_language, $rating, $summary, $id);
    } else {
        $title = $_POST['title'];
        $length_in_minutes = $_POST['length_in_minutes'];
        $released_at = $_POST['released_at'];
        $country_of_origin = $_POST['country_of_origin'];
        $summary = $_POST['summary'];
        $youtube_trailer_id = $_POST['youtube_trailer_id'];
        updateMovieDetails($pdo, $title, $length_in_minutes, $released_at, $country_of_origin, $summary, $youtube_trailer_id, $id);
    }
    header('Location:detail.php?title=' . $title . '&id=' . $id . '&mediatype=' . $mediatype);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bewerk Netland: <?= $_GET['title']?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h2><?= $_GET['title']?></h2>
    <main>
        <?php if ($_GET['mediatype'] == 'serie') {
            editSerie($mediaseries);
        } else {
            editMovie($mediamovies);
        } ?>
    </main>
</body>
</html>