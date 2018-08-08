<?php

require_once '../support/init.php';

use Controllers\AuthController;
use Models\User;
use Controllers\KeranjangController;

(new KeranjangController())->cek();

?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>SmadShop</title>

    <style>
        .logout {
            margin-top: 10px;
        }

        img {
            max-height: 100px;
            max-width: 100px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/sertifikasiweb">
                SmadShop
                <?php
                if (AuthController::cek())
                    print '(' . User::find($_SESSION['user'])->nama . ' sebagai <b>'. User::find($_SESSION['user'])->role .'</b>)';
                ?>
            </a>
            <?php
            if (AuthController::cek()) {
                ?>
                <div class="btn-group logout">
                    <a class="btn btn-danger btn-sm" href="../actions/logout.php">
                        Keluar
                    </a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</nav>