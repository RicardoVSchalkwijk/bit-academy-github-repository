<?php

require_once('queries.php');

if (empty($msg)) {
    $msg = null;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_SESSION['username'] == $_POST['username']) {
        if ($_SESSION['password'] == $_POST['password']) {
            $_SESSION['loggedInUser'] = $_POST['username'] . $_POST['password'];
            header('Location:index.php');
        } else {
            $msg = "Gebruikersnaam of wachtwoord onjuist";
        }
    } else {
        $msg = "Gebruikersnaam of wachtwoord onjuist";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login bij Netland</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <main>
        <label class='errormsg' for='errormsg'><?php if (!empty($msg)) {
                                                   errorMsg($msg);
                                               } ?></label>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <span><label for='username'>Gebruikersnaam</label><input type='text' name='username'></span>
            <span><label for='password'>Wachtwoord</label><input type='password' name='password'></span>
            <span class="margin"><button type='submit' name='login'>Login</button></span>
        </form>
        <h1>Log in bij netland</h1>
    </main>
</body>
</html>