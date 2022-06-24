<?php
date_default_timezone_set('Europe/Moscow'); // Часовой пояс для ТТ

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include __DIR__.'/functions.php';
include __DIR__.'/include/db.php';

// Раскладываем данные по переменным

$sessionid_ss_ads = 'b329d8a108f312adcace9fff1a06805b';
$csrfToken = 'qNSFV7KYpg4jTs4YoWCAZVe4qWdBsNg4';
$idAccount = '7099461686511370242';
$today = date("Y-m-d"); // Сегодняшняя дата за которую запрашивать расход


$getStatisticsAll = getStatisticsAll($idAccount, $csrfToken, $sessionid_ss_ads, $today);

//if($getStatisticsAll['data']['statistics']['campaign_name'] === '-'){
//
//    //echo $reslt['data']['account_balance'] . ' ' . $reslt['data']['currency'];
//    // записываем в БД
//    $db->execute("UPDATE `tokens` SET `impressions`='".$getStatisticsAll['data']['statistics']['show_cnt']."', `cpc`='".$getStatisticsAll['data']['statistics']['click_cnt']."', `cost`='".$getStatisticsAll['data']['statistics']['stat_cost']."' WHERE id_ad_account='$idAccount'");
//}


echo "<pre>";
var_dump($getStatisticsAll['data']);
echo "</pre>";