<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 08/08/2018
 * Time: 10:30
 */

include '../layouts/header.php';
include '../support/ifauthenticated.php';

?>

    <div class="container">
        <?php include 'info.php' ?>
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">
                        <form action="../actions/login.php" method="post">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <button class="btn btn-success">Login</button>
                        </form>
                        <br>
                        <p>Belum punya akun? <a href="register.php">daftar sekarang</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>

<?php

include '../layouts/footer.php';
