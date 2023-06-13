<?php

require_once('db-connect.php');

$sqlmediamovies = "SELECT * FROM media WHERE media_type = 'movie'";
$stmtmediamovies = $pdo->prepare($sqlmediamovies);
$stmtmediamovies->execute();
$mediamovies = $stmtmediamovies->fetchAll();

$sqlmediaseries = "SELECT * FROM media WHERE media_type = 'serie'";
$stmtmediaseries = $pdo->prepare($sqlmediaseries);
$stmtmediaseries->execute();
$mediaseries = $stmtmediaseries->fetchAll();

$sqlusername = "SELECT username FROM gebruikers";
$stmtusername = $pdo->prepare($sqlusername);
$stmtusername->execute();
$username = $stmtusername->fetch();
$_SESSION['username'] = $username['username'];

$sqlpassword = "SELECT password FROM gebruikers";
$stmtpassword = $pdo->prepare($sqlpassword);
$stmtpassword->execute();
$password = $stmtpassword->fetch();
$_SESSION['password'] = $password['password'];


function updateSerieDetails($pdo, $title, $has_won_awards, $seasons, $country, $spoken_in_language, $rating, $summary, $id)
{
    $sqlupdateseries = "UPDATE media
    SET title = :title, 
    has_won_awards = :has_won_awards, 
    seasons = :seasons, 
    country = :country, 
    spoken_in_language = :spoken_in_language, 
    rating = :rating,
    summary = :summary 
    WHERE id = :id";

    $stmtupdateseries = $pdo->prepare($sqlupdateseries);

    $stmtupdateseries->execute(['title' => $title, 
    'has_won_awards' => $has_won_awards, 
    'seasons' => $seasons, 
    'country' => $country, 
    'spoken_in_language' => $spoken_in_language,
    'rating' => $rating,
    'summary' => $summary,
    'id' => $id]);
}

function addSerie($pdo, $title, $has_won_awards, $seasons, $country, $spoken_in_language, $rating, $summary, $media_type)
{
    $sqladdseries = "INSERT INTO media(title, has_won_awards, seasons, country, spoken_in_language, rating, summary, media_type)
    VALUES(:title, :has_won_awards, :seasons, :country, :spoken_in_language, :rating, :summary, :media_type)";

    $stmtaddseries = $pdo->prepare($sqladdseries);
    
    $stmtaddseries->execute(['title' => $title, 
    'has_won_awards' => $has_won_awards, 
    'seasons' => $seasons, 
    'country' => $country, 
    'spoken_in_language' => $spoken_in_language,
    'rating' => $rating,
    'summary' => $summary,
    'media_type' => $media_type]);
}

function updateMovieDetails($pdo, $title, $length_in_minutes, $released_at, $country_of_origin, $summary, $youtube_trailer_id, $id)
{
    $sqlupdatemovies = "UPDATE media
    SET title = :title, 
    length_in_minutes = :length_in_minutes, 
    released_at = :released_at, 
    country_of_origin = :country_of_origin, 
    summary = :summary, 
    youtube_trailer_id = :youtube_trailer_id
    WHERE id = :id";

    $stmtupdatemovies = $pdo->prepare($sqlupdatemovies);

    $stmtupdatemovies->execute(['title' => $title, 
    'length_in_minutes' => $length_in_minutes, 
    'released_at' => $released_at, 
    'country_of_origin' => $country_of_origin, 
    'summary' => $summary,
    'youtube_trailer_id' => $youtube_trailer_id,
    'id' => $id]);
}

function addMovie($pdo, $title, $length_in_minutes, $released_at, $country_of_origin, $summary, $youtube_trailer_id, $media_type)
{
    $sqladdmovies = "INSERT INTO media(title, length_in_minutes, released_at, country_of_origin, summary, youtube_trailer_id, media_type)
    VALUES(:title, :length_in_minutes, :released_at, :country_of_origin, :summary, :youtube_trailer_id, :media_type)";

    $stmtaddmovies = $pdo->prepare($sqladdmovies);
    
    $stmtaddmovies->execute(['title' => $title, 
    'length_in_minutes' => $length_in_minutes, 
    'released_at' => $released_at, 
    'country_of_origin' => $country_of_origin, 
    'summary' => $summary,
    'youtube_trailer_id' => $youtube_trailer_id,
    'media_type' => $media_type]);
}

function errorMsg($msg)
{
    if (empty($msg)) {
        return;
    } else {
        echo $msg;
    }
}

?>