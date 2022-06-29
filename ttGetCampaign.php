<?php

date_default_timezone_set('Europe/Moscow'); // Часовой пояс для ТТ

include __DIR__.'/functions.php';
include __DIR__.'/kt_load.php';
include __DIR__.'/include/db.php';

$today = date("Y-m-d"); // Сегодняшняя дата за которую запрашивать расход
echo 'Если ниже вы видите названия ваших кампаний то скрипт работает правильно';


$tokens = $db->query("SELECT * FROM `tokens`  ORDER BY id DESC");

foreach ($tokens as $token) {
    $sessionid_ss_ads = $token['sessionid_ss_ads'];
    $csrfToken = $token['csrf'];
    $idAccount = $token['id_ad_account'];
    $today = date("Y-m-d"); // Сегодняшняя дата за которую запрашивать расход
    $getStatisticsAll = getStatisticsAll($idAccount, $csrfToken, $sessionid_ss_ads, $today); //


    /**
     * Оставляем только расход
     */

    foreach ($getStatisticsAll['data']['table'] as $taskValue) {

        $re = '/(?<=\{).*(?=})/m';
        $id_campaign_keitaro = $taskValue['campaign_name'];
        preg_match_all($re, $id_campaign_keitaro, $matches, PREG_SET_ORDER, 0);

        /**
         * Выводим только те кампании где есть макрос {id}
         */
        if (isset($matches[0][0])) {
            $id_campaign_keitaro = $matches[0][0];

            echo "<br>Кампания: (" . $id_campaign_keitaro . ") " . $taskValue['campaign_name'] . " Расход: " . $taskValue['stat_data']['stat_cost'] . '<br>';
            echo sendCostKeitaro($taskValue['stat_data']['stat_cost'], $id_campaign_keitaro, $today);
        }
    }
}
