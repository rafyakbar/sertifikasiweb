<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 08/08/2018
 * Time: 20:42
 */

require_once '../Middleware/RedirectIfNotAdmin.php';

use Middleware\RedirectIfNotAdmin;

(new RedirectIfNotAdmin());