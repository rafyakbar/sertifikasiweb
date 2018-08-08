<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 08/08/2018
 * Time: 10:19
 */

namespace Controllers;

use Models\User;


class AuthController
{
    public static function cek()
    {
        return isset($_SESSION['user']);
    }

    public static function redirectTo()
    {
        if (self::cek()){
            $user = User::find($_SESSION['user']);

            if ($user->role == 'Admin')
                header('Location: ../views/home.php');
            else
                header('Location: ../views/store.php');
        }
        else
            header('Location: ../views/login.php');
    }

    public static function logout()
    {
        if (self::cek())
            unset($_SESSION['user']);
    }
}