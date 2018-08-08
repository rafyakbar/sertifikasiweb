<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 07/08/2018
 * Time: 21:29
 */

include '../layouts/header.php';
include '../support/kernel.php';

?>
    <div class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Barang</div>
                    <div class="panel-body">
                        <?php
                        if (isset($_GET['kode'])) {
                            $barang = \Models\Barang::find($_GET['kode']);

                            if (empty($barang)){
                                $_SESSION['info'] = 'Barang dengan kode ' . $_GET['kode'] . ' tidak ditemukan!';
                                header('Location: home.php');
                            }
                            else{
                            ?>
                            <div class="text-center">
                                <img src="<?= getGambar($barang->kode) ?>">
                            </div>
                            <form action="../actions/editbarang.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="kode_lama" value="<?php print $barang->kode ?>">
                                <div class="form-group">
                                    <label>Kode Barang</label>
                                    <input type="text" class="form-control" name="kode" value="<?php print $barang->kode ?>"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input type="text" class="form-control" name="nama" value="<?php print $barang->nama ?>"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label>Harga Barang</label>
                                    <input type="number" min="0" class="form-control" name="harga"
                                           value="<?php print $barang->harga ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Stok Barang</label>
                                    <input type="number" min="0" class="form-control" name="stok"
                                           value="<?php print $barang->stok ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Kategori Barang</label>
                                    <input type="text" class="form-control" name="kategori"
                                           value="<?php print $barang->kategori ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Gambar</label>
                                    <input type="file" accept="image/*" class="form-control" name="gambar">
                                </div>
                                <button class="btn btn-success">Simpan</button>
                            </form>
                        </div>

                        <?php
                        }
                    }
                    else {
                        $_SESSION['info'] = 'Barang tidak ditemukan!';
                        header('Location: home.php');
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
<?php

include '../layouts/footer.php';
