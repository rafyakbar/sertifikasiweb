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
    /**
     * cek apakah telah login
     *
     * @return bool
     */
    public static function cek()
    {
        return isset($_SESSION['user']);
    }

    /**
     * redirect sesuai hak akses
     */
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

    /**
     * logout
     */
    public static function logout()
    {
        session_destroy();
    }
}