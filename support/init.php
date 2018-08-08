<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 08/08/2018
 * Time: 17:05
 */

session_start();

require_once '../Models/User.php';
require_once '../Models/Barang.php';
require_once '../Controllers/AuthController.php';
require_once '../Controllers/BarangController.php';
require_once '../Controllers/KeranjangController.php';

/**
 * membuat fungsi untuk nominal rupiah jika belum ada
 */
if (!function_exists('rupiah')){
    /**
     * @param $nominal
     * @return string
     */
    function rupiah($nominal)
    {
        return number_format($nominal, 0, ',', '.');
    }
}

/**
 * membuat fungsi untuk upload gambar jika belum ada
 */
if (!function_exists('uploadGambar')){
    /**
     * @param $file
     * @param $kode
     */
    function uploadGambar($file, $kode)
    {
        move_uploaded_file($file->tmp_name, '../storage/'.$kode.'_'.$file->name);
    }
}

/**
 * membuat fungsi untuk mendapatkan gambar jika belum ada
 */
if (!function_exists('getGambar')){
    /**
     * @param $kode
     * @return string
     */
    function getGambar($kode){
        foreach (scandir('../storage') as $namaFile){
            if (explode('_', $namaFile)[0] == $kode){
                return '../storage/'.$namaFile;
            }
        }

        return '';
    }
}