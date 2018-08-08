<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 07/08/2018
 * Time: 21:20
 */

include '../layouts/header.php';
include '../support/kernel.php';

?>

    <div class="container">
        <?php include 'info.php' ?>
        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Daftar Barang</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Gambar</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach (\Models\Barang::all() as $barang) {
                                    if ($barang->kode != '') {
                                        ?>
                                        <tr>
                                            <td><?= $barang->kode ?></td>
                                            <td><?= $barang->nama ?></td>
                                            <td>
                                                <img src="<?= getGambar($barang->kode) ?>" class="img-responsive">
                                            </td>
                                            <td><?= $barang->harga ?></td>
                                            <td><?= $barang->stok ?></td>
                                            <td><?= $barang->kategori ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-warning btn-sm"
                                                       href="edit.php?kode=<?php print $barang->kode ?>">Edit</a>
                                                    <a class="btn btn-danger btn-sm"
                                                       onclick="hapus('<?php print $barang->kode ?>')">Hapus</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-success">
                    <div class="panel-heading">Tambah Barang</div>
                    <div class="panel-body">
                        <form action="../actions/tambahbarang.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Kode Barang</label>
                                <input type="text" class="form-control" name="kode" required>
                            </div>
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label>Harga Barang</label>
                                <input type="number" min="0" class="form-control" name="harga" required>
                            </div>
                            <div class="form-group">
                                <label>Stok Barang</label>
                                <input type="number" min="0" class="form-control" name="stok" required>
                            </div>
                            <div class="form-group">
                                <label>Kategori Barang</label>
                                <input type="text" class="form-control" name="kategori" required>
                            </div>
                            <div class="form-group">
                                <label>Gambar</label>
                                <input type="file" accept="image/*" class="form-control" name="gambar" required>
                            </div>
                            <button class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="../actions/hapusbarang.php" method="post" id="hapus">
        <input type="hidden" name="kode" id="kode">
    </form>

<?php

include '../layouts/footer.php';