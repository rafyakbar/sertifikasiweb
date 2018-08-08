<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 07/08/2018
 * Time: 20:28
 */

namespace Controllers;

use Models\Barang;

class BarangController
{
    /**
     * menambah barang
     *
     * @param $request
     * @param $file
     */
    public function add($request, $file)
    {
        if (!Barang::has($request->kode)){
            uploadGambar($file, $request->kode);
            Barang::create(
                $request->kode,
                $request->nama,
                $request->harga,
                $request->stok,
                $request->kategori
            );
        }
        else
            $_SESSION['info'] = 'Barang dengan kode '.$request->kode.' telah ada';

        header('Location: ../index.php');
    }

    /**
     * edit barang
     *
     * @param $request
     * @param $file
     */
    public function edit($request, $file)
    {
        if (Barang::has($request->kode) && $request->kode != $request->kode_lama)
            $_SESSION['info'] = 'Terdapat duplikasi kode '.$request->kode;
        else{
            if (isset($file))
                uploadGambar($file, $request->kode);

            Barang::find($request->kode_lama)->update(
                $request->kode,
                $request->nama,
                $request->harga,
                $request->stok,
                $request->kategori
            );

            $_SESSION['info'] = 'Barang berhasil diperbarui';
        }

        header('Location: ../views/home.php');
    }

    /**
     * menghapus barang
     *
     * @param $request
     */
    public function delete($request)
    {
        Barang::find($request->kode)->delete();

        $_SESSION['info'] = 'Berhasil menghapus barang';

        header('Location: ../views/home.php');
    }
}