<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 08/08/2018
 * Time: 13:18
 */

require_once '../support/init.php';

include '../support/kernel.php';

use Models\Barang;

if (isset($_POST)) {
    (new \Controllers\KeranjangController())->add((object)$_POST);

    header(('Location: ../views/store.php?kategori='.Barang::find($_POST['kode'])->kategori));
} else
    header('Location: ../index.php');