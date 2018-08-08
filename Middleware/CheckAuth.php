<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 08/08/2018
 * Time: 19:53
 */

namespace Middleware;

use Controllers\AuthController;

class CheckAuth
{
    public function __construct()
    {
        if (!AuthController::cek())
            header('Location: ../actions/ceksession.php');
    }
}