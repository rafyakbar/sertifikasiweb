<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 08/08/2018
 * Time: 10:24
 */

include '../layouts/header.php';
include '../support/kernel.php';

use Models\Barang;

?>

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                Keranjang anda
            </div>
            <div class="panel-body">
                <div class="alert alert-info">
                    Klik barang pada keranjang anda untuk menghapus barang yang ada di keranjang
                </div>
                <?php
                if (!isset($_SESSION['keranjang']))
                    $_SESSION['keranjang'][''] = 0;

                $tagihan = 0;
                foreach ($_SESSION['keranjang'] as $kode => $jumlah) {
                    if ($kode != ''){
                        $barang = Barang::find($kode);
                        ?>
                        <a href="../actions/hapuskeranjang.php?kode=<?= $kode ?>" type="button" class="btn btn-warning">
                            <?= $kode ?> (<?= $barang->nama ?>) <span class="badge badge-light"><?= $jumlah ?></span>
                        </a>
                        <?php
                        $tagihan += ($barang->harga * $jumlah);
                    }
                }
                ?>

                <br><br>

                Tagihan yang harus dibayar : <b>Rp <?= rupiah($tagihan) ?></b>
                <a class="btn btn-primary" href="checkout.php">Checkout</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="list-group">
                    <?php
                    foreach (\Models\Barang::getKategori() as $kategori) {
                        ?>
                        <a href="store.php?kategori=<?= $kategori ?>" class="list-group-item list-group-item-action">
                            Kategori <?= $kategori ?>
                        </a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-8">
                <?php
                if (isset($_GET['kategori'])) {
                    $daftarBarang = \Models\Barang::filter($_GET['kategori'])
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Kategori <?= $_GET['kategori'] ?>
                        </div>
                        <div class="panel-body">
                            <?php
                            foreach ($daftarBarang as $barang) {
                                ?>

                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <img src="<?= getGambar($barang->kode) ?>" class="img-responsive">
                                            </div>
                                            <div class="col-md-4">
                                                <p>Kode : <?= $barang->kode ?></p>
                                                <p>Nama : <?= $barang->nama ?></p>
                                                <p>Harga : <?= rupiah($barang->harga) ?></p>
                                                <p>Stok : <?= $barang->stok ?></p>
                                            </div>
                                            <div class="col-md-5">
                                                <form action="../actions/tambahkeranjang.php" method="post">
                                                    <input type="hidden" name="kode" value="<?= $barang->kode ?>">
                                                    <div class="form-group">
                                                        <label>Jumlah Barang</label>
                                                        <input class="form-control" type="number"
                                                               max="<?= $barang->stok ?>" name="jumlah" required>
                                                    </div>
                                                    <button class="btn btn-primary">Tambah Keranjang</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

<?php

include '../layouts/footer.php';
