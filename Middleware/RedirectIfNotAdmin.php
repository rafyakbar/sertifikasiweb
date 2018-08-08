<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 08/08/2018
 * Time: 20:39
 */

namespace Middleware;

use Controllers\AuthController;
use Models\User;

class RedirectIfNotAdmin
{
    public function __construct()
    {
        if (AuthController::cek() && User::find($_SESSION['user'])->role != 'Admin')
            header('Location: ../actions/ceksession.php');
    }
}