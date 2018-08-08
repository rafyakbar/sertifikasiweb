<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 08/08/2018
 * Time: 10:39
 */

require_once '../support/init.php';

use Models\User;

if (isset($_POST)){
    $request = ((object)$_POST);

    if (!empty($request->nama) && !empty($request->email) && !empty($request->password)){
        if (!User::has($request->email)){
            User::create(
                $request->nama,
                $request->email,
                $request->password,
                'Pembeli'
            );

            $_SESSION['user'] = $request->email;
        }
        else {
            $_SESSION['info'] = 'Email telah terdaftar pada akun lain';
        }
    }
}

header('Location: ceksession.php');