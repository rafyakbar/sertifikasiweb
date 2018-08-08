<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 08/08/2018
 * Time: 10:17
 */

include '../layouts/header.php';

?>

    <div class="container">
        <?php include 'info.php' ?>
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">
                        <form action="../actions/register.php" method="post">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <button class="btn btn-success">Register</button>
                        </form>
                        <br>
                        <p>Sudah punya akun? <a href="login.php">login sekarang</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>

<?php

include '../layouts/footer.php';