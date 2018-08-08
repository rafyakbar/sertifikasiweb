<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 08/08/2018
 * Time: 19:21
 */

include '../layouts/header.php';
include '../support/kernel.php';

use Models\Barang;

?>

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Pembelian yang harus anda bayar</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Gambar</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (!isset($_SESSION['keranjang']))
                            $_SESSION['keranjang'][''] = 0;

                        $tagihan = 0;
                        foreach ($_SESSION['keranjang'] as $kode => $jumlah) {
                            if ($kode != ''){
                                $barang = Barang::find($kode);
                                ?>

                                <tr>
                                    <td><?= $barang->kode ?></td>
                                    <td><?= $barang->nama ?></td>
                                    <td><img src="<?= getGambar($barang->kode) ?>" class="img-responsive"></td>
                                    <td><?= $barang->kategori ?></td>
                                    <td><?= $jumlah ?></td>
                                    <td>Rp <?= rupiah($barang->harga) ?></td>
                                </tr>

                                <?php
                                $tagihan += ($barang->harga * $jumlah);
                            }
                        }
                        ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right">Total</td>
                            <td><b>Rp <?= rupiah($tagihan) ?></b></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php

include '../layouts/footer.php';
