<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

include __DIR__.'/functions.php';
include __DIR__.'/include/db.php';

if(isset($_POST['token'])) {

    //принимаем данные из POST
    //$name = $_POST['name'];
    $token = $_POST['token'];

    if (!isset($token)) {
        echo "Вы забыли добавить токен";
        exit;
    }

    $str = $token;
    $json = base64_decode($str); // Раскодируем куки в JSON

    $pattern = '/\{"cookies":([\s\S]+)\,"useragent"+/m';
    preg_match_all($pattern, $json, $matches, PREG_SET_ORDER, 0); // Вырезаем из раскодированных кук нужную часть
    $jso = json_decode($matches[0][1]);


    $sessSearch = searchSession($jso); // Достаём $sessionid_ss_ads из JSON cookie в массив
    $csrfSearch = searchCsrf($jso); // Достаём $csrfToken из JSON cookie в массив
    $idAccSearch = searchId($jso); // Достаём $csrfToken из JSON cookie в массив

// Раскладываем данные по переменным
    $sessionid_ss_ads = $sessSearch[1];
    $csrfToken = $csrfSearch[1];
    $idAccount = (int)$idAccSearch;

    echo $idAccount;
    
    if ($idAccount > 1000000000000) {

        // записываем в БД
        $getStatus = getStatus($idAccount, $csrfToken, $sessionid_ss_ads); // Проверяем не забанен ли аккаунт

        $db->execute("INSERT INTO `tokens`(`name`, `token`, `id_ad_account`, `csrf`, `sessionid_ss_ads`) VALUES ('".$getStatus['data']['name']."', '$token','$idAccount','$csrfToken','$sessionid_ss_ads')");
        header("Location: index.php?add=success");

    }
    else {
        //echo "AD Token: " . $sessionid_ss_ads . " Token CSRF: " . $csrfToken . " ID cab: " . $idAccount;
        header("Location: index.php?add=no_ad_id");
    }
}
else   {
    header("Location: index.php?add=empty");
}