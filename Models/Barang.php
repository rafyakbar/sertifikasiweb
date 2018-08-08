<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 07/08/2018
 * Time: 19:09
 */

namespace Models;

/**
 * Class Barang
 * merepresentasikan objek barang
 */
class Barang
{
    private $kode;

    private $nama;

    private $harga;

    private $stok;

    private $kategori;

    /**
     * Mengeset value untuk properti tertentu
     *
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        if (property_exists($this, $name))
            $this->$name = $value;
    }

    /**
     * Mendapatkan value dari property tertentu
     *
     * @param $name
     * @return null
     */
    public function __get($name)
    {
        if (property_exists($this, $name))
            return $this->$name;

        return null;
    }

    /**
     * mengeset value dari std class
     *
     * @param $std
     * @return Barang
     */
    public function setFromStdClass($std)
    {
        $this->kode = $std->kode;
        $this->nama = $std->nama;
        $this->harga = $std->harga;
        $this->stok = $std->stok;
        $this->kategori = $std->kategori;

        return $this;
    }

    /**
     * mengambil atau menulis file json
     *
     * @return mixed
     */
    public static function loadJson($toArray = false)
    {
        $fileName = '../data.json';
        $file = fopen($fileName, 'a+');
        $data = json_decode(fgets($file), $toArray);
        fclose($file);

        return $data;
    }

    /**
     * menulis file json
     *
     * @param $array
     */
    public static function writeJson($array)
    {
        $fileName = '../data.json';
        $file = fopen($fileName, 'w');
        fwrite($file, json_encode($array));
        fclose($file);
    }

    public static function init()
    {
        $barang = new static();
        $barang->kode = '';
        $barang->nama = '';
        $barang->harga = 0;
        $barang->stok = 0;

        $daftarBarang[$barang->kode] = $barang->toArray();

        return $daftarBarang;
    }

    /**
     * mengambil semua data barang
     *
     * @return mixed
     */
    public static function all($toArray = false)
    {
        if (empty(self::loadJson())){

            self::writeJson(self::init());

            return self::loadJson($toArray);
        }

        if ($toArray)
            return self::loadJson($toArray);

        foreach (self::loadJson() as $barang)
            $daftarBarang[$barang->kode] = (new Barang())->setFromStdClass($barang);

        return $daftarBarang;
    }

    /**
     * filter berdasarkan kategori
     *
     * @param $namaKategori
     * @return mixed
     */
    public static function filter($namaKategori)
    {
        $daftarBarang = self::all();
        foreach ($daftarBarang as $barang)
            if ($barang->kategori == $namaKategori)
                $barangFilter[$barang->kode] = $barang;

        return $barangFilter;
    }

    /**
     * mendapatkan kategori barang
     *
     * @return array
     */
    public static function getKategori()
    {
        $kategori = [];
        foreach (self::all() as $barang)
            if (!in_array($barang->kategori, $kategori) && $barang->kategori != '')
                array_push($kategori, $barang->kategori);

        return $kategori;
    }

    /**
     * sorting barang
     *
     * @param $properti
     * @param bool $asc
     * @return mixed
     */
    public static function sort($properti, $asc = true)
    {
        $daftarBarang = self::all();
        usort($daftarBarang, function ($a, $b) use ($properti, $asc) {
            if ($properti == 'kode')
                return ($asc ? strcmp($a->kode, $b->kode) : strcmp($b->kode, $a->kode));
            elseif ($properti == 'nama')
                return ($asc ? strcmp($a->nama, $b->nama) : strcmp($b->nama, $a->nama));
            elseif ($properti == 'harga')
                return $a->harga > $b->harga ? -1 : 1;
            elseif ($properti == 'stok')
                return $a->stok > $b->stok ? -1 : 1;
        });

        return $daftarBarang;
    }

    /**
     * menambahkan barang kedalam file json
     *
     * @param $kode
     * @param $nama
     * @param $harga
     * @param $stok
     */
    public static function create($kode, $nama, $harga, $stok, $kategori)
    {
        $daftarBarang = self::all(true);

        $barang = new static();
        $barang->kode = $kode;
        $barang->nama = $nama;
        $barang->harga = (int)$harga;
        $barang->stok = (int)$stok;
        $barang->kategori = strtoupper($kategori);

        $daftarBarang[$barang->kode] = $barang->toArray();

        self::writeJson($daftarBarang);
    }

    /**
     * mengkonversi properti ke dalam array
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'kode' => $this->kode,
            'nama' => $this->nama,
            'harga' => $this->harga,
            'stok' => $this->stok,
            'kategori' => $this->kategori
        ];
    }

    /**
     * mencari barang berdasarkan kode
     *
     * @param $kode
     * @return null
     */
    public static function find($kode)
    {
        if (self::has($kode))
            return (new Barang())->setFromStdClass((object)self::all(true)[$kode]);

        return null;
    }

    /**
     * mengecek apakah barang memiliki kode tertentu
     *
     * @param $kode
     * @return bool
     */
    public static function has($kode)
    {
        $daftarBarang = self::all(true);

        return isset($daftarBarang[$kode]) ? true : false;
    }

    /**
     * update barang
     *
     * @param $kode
     * @param $nama
     * @param $harga
     * @param $stok
     */
    public function update($kode, $nama, $harga, $stok, $kategori)
    {
        $this->delete();

        self::create(
            $kode,
            $nama,
            $harga,
            $stok,
            $kategori
        );
    }

    /**
     * menghapus barang
     */
    public function delete()
    {
        $daftarBarang = self::all(true);
        unset($daftarBarang[$this->kode]);

        self::writeJson($daftarBarang);
    }
}