<?php

require_once('queries.php');

if (empty($_GET['mediatype'])) {
    $_GET['mediatype'] = null;
}

if (isset($_GET['mediatype'])) {
    $_SESSION['mediatype'] = $_GET['mediatype'];
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_SESSION['mediatype'] == 'serie') {
        $title = $_POST['title'];
        $has_won_awards = $_POST['has_won_awards'];
        $seasons = $_POST['seasons'];
        $country = $_POST['country'];
        $spoken_in_language = $_POST['spoken_in_language'];
        $rating = $_POST['rating'];
        $summary = $_POST['summary'];
        $media_type = $_POST['media_type'];
        addSerie($pdo, $title, $has_won_awards, $seasons, $country, $spoken_in_language, $rating, $summary, $media_type, $id);
    } else {
        $title = $_POST['title'];
        $length_in_minutes = $_POST['length_in_minutes'];
        $released_at = $_POST['released_at'];
        $country_of_origin = $_POST['country_of_origin'];
        $summary = $_POST['summary'];
        $youtube_trailer_id = $_POST['youtube_trailer_id'];
        $media_type = $_POST['media_type'];
        addMovie($pdo, $title, $length_in_minutes, $released_at, $country_of_origin, $summary, $youtube_trailer_id, $media_type, $id);
    }
    header('Location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netland: Media toevoegen</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Media toevoegen</h2>
    <main>
    <?php if ($_GET['mediatype'] == 'serie') {
        echo "<form action=" . $_SERVER['PHP_SELF'] . " method='post'>";
        echo "<a href='index.php'><< Terug</a>";
        echo "<span><label for='title'>Titel</label><input type='text' name='title'></span>";
        echo "<span><label for='has_won_awards'>Awards</label><input type='text' name='has_won_awards'></span>";
        echo "<span><label for='seasons'>Seasons</label><input type='text' name='seasons'></span>";
        echo "<span><label for='country'>Country</label><input type='text' name='country'></span>";
        echo "<span><label for='spoken_in_language'>Language</label><input type='text' name='spoken_in_language'></span>";
        echo "<span><label for='rating'>Rating</label><input type='text' name='rating'></span>";
        echo "<span><label for='summary'>Beschrijving</label><textarea type='text' name='summary'></textarea></span>";
        echo "<span><label for='media_type'>Mediatype</label><select name='media_type'><option value='serie'>Serie</option><option value='movie'>Film</option></select></span>";
        echo "<button type='submit' name='save'>Opslaan</button></form>";
        echo "<h3>Serie toevoegen:</h3>";
    } else {
        echo "";
    }

    if ($_GET['mediatype'] == 'movie') {
        echo "<form action=" . $_SERVER['PHP_SELF'] . " method='post'>";
        echo "<a href='index.php'><< Terug</a>";
        echo "<span><label for='title'>Titel</label><input type='text' name='title'></span>";
        echo "<span><label for='length_in_minutes'>Duur</label><input type='text' name='length_in_minutes'></span>";
        echo "<span><label for='released_at'>Datum van uitkomst</label><input type='text' name='released_at'></span>";
        echo "<span><label for='country_of_origin'>Land van uitkomst</label><input type='text' name='country_of_origin'></span>";
        echo "<span><label for='summary'>Omschrijving</label><textarea class='large' type='text' name='summary'></textarea></span>";
        echo "<span><label for='youtube_trailer_id'>YouTube trailer ID</label><input type='text' name='youtube_trailer_id'></span>";
        echo "<span><label for='media_type'>Mediatype</label><select name='media_type'><option value='serie'>Serie</option><option value='movie'>Film</option></select></span>";
        echo "<button type='submit' name='save'>Opslaan</button></form>";
        echo "<h3>Film toevoegen:</h3>";
    } else {
        echo "";
    } ?>
    <span>
            <a class="margin" href="insert.php?mediatype=serie">Serie details invulformulier</a>
            <a class="margin" href="insert.php?&mediatype=movie">Film details invulformulier</a>
    </span>
    </main>
</body>
</html>