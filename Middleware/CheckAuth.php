<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 08/08/2018
 * Time: 19:53
 */

namespace Middleware;

use Controllers\AuthController;
use Models\User;

class CheckAuth
{
    public function __construct()
    {
        if (!AuthController::cek())
            print "<script>window.location = '../actions/ceksession.php'</script>";
    }
}