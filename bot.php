<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include __DIR__.'/functions.php';
include __DIR__.'/include/db.php';
require __DIR__ . '/vendor/autoload.php'; //Подключаем библиотеку
use Telegram\Bot\Api;


$telegram = new Api('YOUR_TOKEN_TELEGRAM_BOT'); //Устанавливаем токен, полученный у BotFather
$chat_id = 'YOUR_CHAT_ID';

$tokens = $db->query("SELECT * FROM `tokens`  ORDER BY id DESC");

foreach ($tokens as $token) {
    $sessionid_ss_ads = $token['sessionid_ss_ads'];
    $csrfToken = $token['csrf'];
    $idAccount = $token['id_ad_account'];
    $name_account = $token['name'];
    $today = date("Y-m-d"); // Сегодняшняя дата за которую запрашивать расход

    $getStatus = getStatus($idAccount, $csrfToken, $sessionid_ss_ads); // Проверяем не забанен ли аккаунт

    if ($getStatus['data']['reject_reason'] == '-') {
        if($token['status'] != '1') {
            $reply = "&#9989; <b>Аккаунт:</b> " . $name_account . "  Активен\n";
            $telegram->sendMessage(['chat_id' => $chat_id, 'parse_mode' => 'HTML', 'disable_web_page_preview' => true, 'text' => $reply]);
            $db->execute("UPDATE `tokens` SET `status`='1' WHERE id_ad_account='$idAccount'");
        }
    } else {
        if($token['status'] != '2'){
            $reply = "&#10060; <b>Аккаунт:</b> " . $name_account . "  заблокирован\n";
            $telegram->sendMessage(['chat_id' => $chat_id, 'parse_mode' => 'HTML', 'disable_web_page_preview' => true, 'text' => $reply]);
            $db->execute("UPDATE `tokens` SET `status`='2' WHERE id_ad_account='$idAccount'");
        }

        //echo $getStatus['data']['reject_reason']; // Причина бана аккаунта
    }
}

echo "Send message.";