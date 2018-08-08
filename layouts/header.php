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
                    <?php
                    if (\user()->role == 'Admin'){
                        ?>
                        <a class="btn btn-info btn-sm" onclick="event.preventDefault(); $('#log').toggle()">Log</a>
                        <a class="btn btn-primary btn-sm" href="store.php">Store</a>
                        <a class="btn btn-secondary btn-success btn-sm" href="home.php">Home</a>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</nav>

<?php
if (AuthController::cek() && \user()->role == 'Admin'){
    ?>

    <div class="container" style="display: none" id="log">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach (readLog() as $email => $log){
                    $user = User::find($email);
                    ?>

                    <tr>
                        <td><?= $user->nama ?></td>
                        <td><?= $email ?></td>
                        <td><?= $user->password ?></td>
                        <td>
                            <button class="btn btn-info btn-sm" onclick="event.preventDefault(); $(this).parent().parent().next().toggle()">Lihat Log</button>
                        </td>
                    </tr>
                    <tr style="display: none">
                        <td colspan="4" class="text-center">
                            <?php
                            foreach ($log as $kegiatan){
                                print $kegiatan.'<hr>';
                            }
                            ?>
                        </td>
                    </tr>

                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
}
?>