<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 08/08/2018
 * Time: 11:40
 */

require_once '../support/init.php';

include '../support/kernel.php';

use Controllers\AuthController;

AuthController::logout();

header('Location: ceksession.php');