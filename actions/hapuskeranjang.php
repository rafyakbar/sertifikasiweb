<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 08/08/2018
 * Time: 19:06
 */

require_once '../support/init.php';

include '../support/kernel.php';

use Controllers\KeranjangController;

if (isset($_GET))
    (new KeranjangController())->delete($_GET['kode']);

header('Location: ../index.php');