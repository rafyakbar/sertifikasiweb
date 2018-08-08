<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 07/08/2018
 * Time: 22:42
 */

require_once '../support/init.php';

include '../support/kernel.php';
include '../support/ifnotadmin.php';

use Controllers\BarangController;

if (isset($_POST))
    (new BarangController())->edit((object)$_POST, (object)$_FILES['gambar']);
else
    header('Location: ceksession.php');