<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 09/08/2018
 * Time: 10:42
 */

namespace Middleware;

use Controllers\AuthController;

class RedirectIfAuthenticated
{
    public function __construct()
    {
        if (AuthController::cek())
            print "<script>window.location = '../actions/ceksession.php'</script>";
    }
}