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

date_default_timezone_set("Asia/Jakarta");

/**
 * membuat fungsi getDateTime jika tidak ada
 */
if (!function_exists('getDateTime')){
    /**
     * fungsi untuk mengambil waktu sekarang
     *
     * @return string
     */
    function getDateTime()
    {
        return (new DateTime('now'))->format('Y-m-d H:i:s');
    }
}

/**
 * membuat fungsi untuk nominal rupiah jika belum ada
 */
if (!function_exists('rupiah')) {
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
if (!function_exists('uploadGambar')) {
    /**
     * @param $file
     * @param $kode
     */
    function uploadGambar($file, $kode)
    {
        move_uploaded_file($file->tmp_name, '../storage/' . $kode . '_' . $file->name);
    }
}

/**
 * membuat fungsi untuk mendapatkan gambar jika belum ada
 */
if (!function_exists('getGambar')) {
    /**
     * @param $kode
     * @return string
     */
    function getGambar($kode)
    {
        foreach (scandir('../storage') as $namaFile) {
            if (explode('_', $namaFile)[0] == $kode) {
                return '../storage/' . $namaFile;
            }
        }

        return '';
    }
}

/**
 * membuat fungsi user jika tidak ada
 */
if (!function_exists('user')) {
    /**
     * mengambil data user yg login
     *
     * @return null
     */
    function user()
    {
        return isset($_SESSION['user']) ? \Models\User::find($_SESSION['user']) : null;
    }
}

/**
 * membuat fungsi untuk menulis log jika tidak ada
 */
if (!function_exists('writeLog')) {
    /**
     * fungsi untuk menulis log
     *
     * @param $array
     */
    function writeLog($text)
    {
        $file = fopen("../log.txt", "a+") or die("Unable to open file!");
        fwrite($file, $text . "\n");
        fclose($file);
    }
}

/**
 * membuat fungsi untuk membaca log jika tidak ada
 */
if (!function_exists('readLog')) {
    /**
     * fungsi untuk membaca log pengguna
     *
     * @return mixed
     */
    function readLog()
    {
        $file = fopen("../log.txt", "r");

        while (!feof($file)) {
            $text = fgets($file);
            $line = explode('_', $text);

            if (isset($line[1])){
                if (!isset($log[$line[0]]))
                    $log[$line[0]] = [];

                array_push($log[$line[0]], $line[1]);
            }
        }

        fclose($file);

        return $log;
    }
}