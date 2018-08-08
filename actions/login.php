<?php
/**
 * Created by PhpStorm.
 * User: rafya
 * Date: 08/08/2018
 * Time: 10:33
 */

require_once '../support/init.php';

use Models\User;

if (isset($_POST)){
    $request = ((object)$_POST);

    if (!empty($request->email) && !empty($request->password)){
        $user = User::find($request->email);

        if ($user->password == $request->password){
            $_SESSION['user'] = $request->email;
            writeLog($user->email.'_Melakukan login pada '.getDateTime());
        } else
            $_SESSION['info'] = 'Kata sandi atau email salah';
    }
}

header('Location: ceksession.php');