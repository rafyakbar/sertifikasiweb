<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 07/08/2018
 * Time: 20:26
 */

require_once '../support/init.php';

include '../support/kernel.php';
include '../support/ifnotadmin.php';

use Controllers\BarangController;

(new BarangController())->add((object)$_POST, (object)$_FILES['gambar']);