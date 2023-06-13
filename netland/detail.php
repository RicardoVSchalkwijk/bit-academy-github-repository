<?php

require_once('services.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netland: <?= $_GET['title']?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2><?= $_GET['title']?></h2>
    <main>
        <a href="index.php"><< Terug</a>
        <table>
            <tbody>
                <tr>
                    <th>Information</th>
                    <th>Information</th>
                </tr>
                <?php if ($_GET['mediatype'] == 'serie') {
                    serieDetails($mediaseries);
                } else {
                    movieDetails($mediamovies);
                } ?>
            </tbody>
        </table>
    </main>
</body>
</html>