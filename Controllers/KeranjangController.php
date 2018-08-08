<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 08/08/2018
 * Time: 16:49
 */

namespace Controllers;

use Models\Barang;

class KeranjangController
{
    /**
     * menambah keranjang
     *
     * @param $request
     */
    public function add($request)
    {
        if (isset($_SESSION['keranjang'][$request->kode]))
            $_SESSION['keranjang'][$request->kode] = $request->jumlah + $_SESSION['keranjang'][$request->kode];
        else
            $_SESSION['keranjang'][$request->kode] = $request->jumlah;

        writeLog(user()->email.'_Menambahkan '.$request->kode.' kedalam keranjang pada '.getDateTime());
    }

    /**
     * cek keranjang elanja
     */
    public function cek()
    {
        if (isset($_SESSION['keranjang']))
            foreach ($_SESSION['keranjang'] as $kode => $jumlah){
                if (!Barang::has($kode))
                    unset($_SESSION['keranjang'][$kode]);
                else
                    if (Barang::find($kode)->stok < $jumlah)
                        $_SESSION['keranjang'][$kode] = Barang::find($kode)->stok;
            }
    }

    /**
     * hapus keranjang belanja
     *
     * @param $kode
     */
    public function delete($kode)
    {
        if (isset($_SESSION['keranjang'][$kode]))
            unset($_SESSION['keranjang'][$kode]);

        writeLog(user()->email.'_Menghapus barang yang di keranjang pada '.getDateTime());
    }
}