<?php

require_once('queries.php');

function mediaTableSeries($mediaseries)
{
    foreach ($mediaseries as $media) {
        echo "<tr>";
        echo "<td>" . $media['title'] . "</td>";
        echo "<td>" . $media['rating'] . "</td>";
        echo "<td><a href='detail.php?title=" . $media['title'] . "&id=" . $media['id'] . "&mediatype=" . $media['media_type'] . "'>Bekijk details</a></td>";
        echo "</tr>";
    }
}

function mediaTableMovies($mediamovies)
{
    foreach ($mediamovies as $media) {
        echo "<tr>";
        echo "<td>" . $media['title'] . "</td>";
        echo "<td>" . $media['length_in_minutes'] . "</td>";
        echo "<td><a href='detail.php?title=" . $media['title'] . "&id=" . $media['id'] . "&mediatype=" . $media['media_type'] . "'>Bekijk details</a></td>";
        echo "</tr>";
    }
}

function sortRatingSeries($pdo, $sortdirection)
{
    return $pdo->query("SELECT * FROM media WHERE media_type = 'serie' ORDER BY rating $sortdirection")->fetchAll();
}

function sortDurationMovies($pdo, $sortdirection)
{
    return $pdo->query("SELECT * FROM media WHERE media_type = 'movie' ORDER BY length_in_minutes $sortdirection")->fetchAll();
}

function movieDetails($mediamovies)
{
    foreach ($mediamovies as $media) {
        if ($media['id'] == $_GET['id']) {
            echo "<tr><td>Datum van uitkomst</td><td>" . $media['released_at'] . "</td></tr>";
            echo "<tr><td>Land van uitkomst</td><td>" . $media['country_of_origin'] . "</td></tr>";
            echo "<tr><td>Duur</td><td>" . $media['length_in_minutes'] . "</td></tr>";
            echo "<p><a href='edit.php?title=" . $media['title'] . "&id=" . $media['id'] . "&mediatype=" . $media['media_type'] . "'>Bewerk film</a></p>";
            echo "<div>" . $media['summary'] . "</div><h2>Beschijving:</h2>";
        }
    }
}

function serieDetails($mediaseries)
{
    foreach ($mediaseries as $media) {
        if ($media['id'] == $_GET['id']) {
            echo "<tr><td>Awards</td><td>"; 
            if ($media['has_won_awards'] > 0) {
                echo "Ja";
            } else {
                echo "Nee";
            }"</td></tr>";
            echo "<tr><td>Seasons</td><td>" . $media['seasons'] . "</td></tr>";
            echo "<tr><td>Country</td><td>" . $media['country'] . "</td></tr>";
            echo "<tr><td>Language</td><td>" . $media['spoken_in_language'] . "</td></tr>";
            echo "<tr><td>Rating</td><td>" . $media['rating'] . "</td></tr>";
            echo "<p><a href='edit.php?title=" . $media['title'] . "&id=" . $media['id'] . "&mediatype=" . $media['media_type'] . "'>Bewerk serie</a></p>";
            echo "<div>" . $media['summary'] . "</div><h2>Beschrijving:</h2>";
        }    
    }
}

function editSerie($mediaseries)
{
    foreach ($mediaseries as $media) {
        if ($media['id'] == $_GET['id']) {
            echo "<form action=" . $_SERVER['PHP_SELF'] . " method='post'>";
            echo "<a href='detail.php?title=" . $_GET['title'] . "&id=" . $_GET['id'] . "&mediatype=" . $_GET['mediatype'] . "'><< Terug</a>";
            echo "<span><label for='title'>Titel</label><input type='text' name='title' value='" . inputPlaceholderSeries($mediaseries, 'title') . "'></span>";
            echo "<span><label for='has_won_awards'>Awards</label><input type='text' name='has_won_awards' value='" . inputPlaceholderSeries($mediaseries, 'has_won_awards') . "'></span>";
            echo "<span><label for='seasons'>Seasons</label><input type='text' name='seasons' value='" . inputPlaceholderSeries($mediaseries, 'seasons') . "'></span>";
            echo "<span><label for='country'>Country</label><input type='text' name='country' value='" . inputPlaceholderSeries($mediaseries, 'country') . "'></span>";
            echo "<span><label for='spoken_in_language'>Language</label><input type='text' name='spoken_in_language' value='" . inputPlaceholderSeries($mediaseries, 'spoken_in_language') . "'>";
            echo "</span>";
            echo "<span><label for='rating'>Rating</label><input type='text' name='rating' value='" . inputPlaceholderSeries($mediaseries, 'rating') . "'></span>";
            echo "<span><label for='summary'>Beschrijving</label><textarea type='text' name='summary'>" . inputPlaceholderSeries($mediaseries, 'summary') . "</textarea></span>";
            echo "<button type='submit' name='save'>Opslaan</button>";
            echo "</form>";
        }
    }
}

function inputPlaceholderSeries($mediaseries, $column) 
{
    foreach ($mediaseries as $media) {
        if ($media['id'] == $_GET['id']) {
            $value = $media[$column];
            return $value;
        }
    }
}

function editMovie($mediamovies)
{
    foreach ($mediamovies as $movie) {
        if ($movie['id'] == $_GET['id']) {
            echo "<form action=" . $_SERVER['PHP_SELF'] . " method='post'>";
            echo "<a href='detail.php?title=" . $_GET['title'] . "&id=" . $_GET['id'] . "&mediatype=" . $_GET['mediatype'] . "'><< Terug</a>";
            echo "<span><label for='title'>Titel</label><input type='text' name='title' value='" . inputPlaceholderMovies($mediamovies, 'title') . "'></span>";
            echo "<span><label for='length_in_minutes'>Duur</label><input type='text' name='length_in_minutes' value='" . inputPlaceholderMovies($mediamovies, 'length_in_minutes') . "'></span>";
            echo "<span><label for='released_at'>Datum van uitkomst</label><input type='text' name='released_at' value='" . inputPlaceholderMovies($mediamovies, 'released_at') . "'></span>";
            echo "<span><label for='country_of_origin'>Land van uitkomst</label><input type='text' name='country_of_origin' 
            value='" . inputPlaceholderMovies($mediamovies, 'country_of_origin') . "'></span>";
            echo "<span><label for='summary'>Omschrijving</label><textarea type='text' name='summary'>" . inputPlaceholderMovies($mediamovies, 'summary') . "</textarea></span>";
            echo "<span><label for='youtube_trailer_id'>YouTube trailer ID</label><input type='text' name='youtube_trailer_id'
            value='" . inputPlaceholderMovies($mediamovies, 'youtube_trailer_id') . "'></span>";
            echo "<button type='submit' name='save'>Opslaan</button>";
            echo "</form>";
        }
    }
}

function inputPlaceholderMovies($mediamovies, $column) 
{
    foreach ($mediamovies as $media) {
        if ($media['id'] == $_GET['id']) {
            $value = $media[$column];
            return $value;
        }
    }
}

?>