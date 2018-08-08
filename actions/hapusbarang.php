<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 07/08/2018
 * Time: 23:04
 */

require_once '../support/init.php';

include '../support/kernel.php';

use Controllers\BarangController;

(new BarangController())->delete((object)$_POST);