<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 08/08/2018
 * Time: 10:12
 */

namespace Models;


class User
{
    private $email;

    private $nama;

    private $password;

    private $role;

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
     * @return User
     */
    public function setFromStdClass($std)
    {
        $this->nama = $std->nama;
        $this->email = $std->email;
        $this->password = $std->password;
        $this->role = $std->role;

        return $this;
    }

    /**
     * mengambil atau menulis file json
     *
     * @return mixed
     */
    public static function loadJson($toArray = false)
    {
        $fileName = '../user.json';
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
        $fileName = '../user.json';
        $file = fopen($fileName, 'w');
        fwrite($file, json_encode($array));
        fclose($file);
    }

    /**
     * mengambil semua data barang
     *
     * @return mixed
     */
    public static function all($toArray = false)
    {
        if (empty(self::loadJson())){
            self::writeJson([]);

            return self::loadJson(true);
        }

        if ($toArray)
            return self::loadJson($toArray);

        foreach (self::loadJson() as $user)
            $daftarPengguna[$user->email] = $user;

        return $daftarPengguna;
    }

    /**
     * menambahkan barang kedalam file json
     *
     * @param $kode
     * @param $nama
     * @param $harga
     * @param $stok
     */
    public static function create($nama, $email, $password, $role)
    {
        $daftarPengguna = self::all(true);

        $user = new static();
        $user->nama = $nama;
        $user->email = $email;
        $user->password = $password;
        $user->role = $role;

        $daftarPengguna[$email] = $user->toArray();

        self::writeJson($daftarPengguna);
    }

    /**
     * mengecek apakah barang memiliki kode tertentu
     *
     * @param $kode
     * @return bool
     */
    public static function has($email)
    {
        $daftarPengguna = self::all(true);

        if (isset($daftarPengguna[$email]))
            return true;
        return false;
    }

    /**
     * mencari user berdasarkan email
     *
     * @param $kode
     * @return null
     */
    public static function find($email)
    {
        if (self::has($email))
            return (new User())->setFromStdClass((object)self::all(true)[$email]);

        return null;
    }

    /**
     * mengubah ke dalam bentuk array
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'nama' => $this->nama,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role
        ];
    }
}