<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 09/08/2018
 * Time: 10:44
 */

require_once '../Middleware/RedirectIfAuthenticated.php';

use Middleware\RedirectIfAuthenticated;

(new RedirectIfAuthenticated());