<?php

date_default_timezone_set('Europe/Moscow'); // Часовой пояс для ТТ

include __DIR__.'/functions.php';
include __DIR__.'/kt_load.php';
include __DIR__.'/include/db.php';

$today = date("Y-m-d"); // Сегодняшняя дата за которую запрашивать расход
echo 'Если ниже вы видите названия ваших кампаний то скрипт работает правильно';


$tokens = $db->query("SELECT * FROM `tokens`  ORDER BY id DESC");

foreach ($tokens as $token) {
    $token = $token['token'];
    if (!isset($token)) {
        exit;
    }

    $str = $token;
    $json = base64_decode($str); // Раскодируем куки в JSON

    $pattern = '/\{"cookies":([\s\S]+)\,"useragent"+/m';
    preg_match_all($pattern, $json, $matches, PREG_SET_ORDER, 0); // Вырезаем из раскодированных кук нужную часть
    $jso = json_decode($matches[0][1]);


    $sessSearch = searchSession($jso); // Достаём $sessionid_ss_ads из JSON cookie в массив
    $csrfSearch = searchCsrf($jso); // Достаём $csrfToken из JSON cookie в массив
    $idAccSearch = searchIdAccount($jso); // Достаём $csrfToken из JSON cookie в массив

    // Раскладываем данные по переменным
    $sessionid_ss_ads = $sessSearch[1];
    $csrfToken = $csrfSearch[1];
    $idAccount = $idAccSearch[1];


    $headers = [
        'user-agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4441.3 Safari/537.36',
        'content-type: application/json;charset=UTF-8',
        'trace-log-user-id: ' . $idAccount . '',
        'x-csrftoken: ' . $csrfToken . '',
        'referer: https://ads.tiktok.com/i18n/perf?aadvid=' . $idAccount,
        'cookie: sessionid_ss_ads=' . $sessionid_ss_ads . ';'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://ads.tiktok.com/api/v3/i18n/statistics/campaign/list/?aadvid=' . $idAccount);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, '{"lifetime":0,"relative_time":"0","st":"' . $today . '","et":"' . $today . '","keyword":"","search_type":1,"campaign_status":["no_delete"],"ad_status":[],"opt_status":[],"creative_status":[],"objective_type":[],"pricing":[],"placement_id":[],"image_mode":[],"ab_test":[],"having_filter":[],"country":[],"province":[],"city":[],"particle_locations":[],"bid_strategy":[],"age":[],"gender":[],"dpa_local_audience":[],"campaign_category":[],"budget_optimizer_switch":[],"promotion_type":[],"optimize_goal":[],"creative_material_mode":[],"flow_control_mode":[],"item_source":[],"dedicate_type":[],"version":1,"sort_stat":"","sort_order":0,"":[],"page":1,"limit":20,"query_list":["stat_cost","cpc","cpm","show_cnt","click_cnt","ctr","time_attr_convert_cnt","skan_convert_cnt","time_attr_conversion_cost","skan_conversion_cost","time_attr_conversion_rate","skan_conversion_rate","time_attr_effect_cnt","time_attr_effect_cost","time_attr_effect_rate"]}');

    $response = curl_exec($ch);
    $reslt = json_decode($response, true); // Ответ от ТТ с данными


    /**
     * Оставляем только расход
     */
    foreach ($reslt['data']['table'] as $taskValue) {

        $re = '/(?<=\{).*(?=})/m';
        $id_campaign_keitaro = $taskValue['campaign_name'];
        preg_match_all($re, $id_campaign_keitaro, $matches, PREG_SET_ORDER, 0);

        /**
         * Выводим только те кампании где есть макрос {id}
         */
        if (isset($matches[0][0])) {
            $id_campaign_keitaro = $matches[0][0];

            echo "Кампания: (" . $id_campaign_keitaro . ") " . $taskValue['campaign_name'] . " Расход: " . $taskValue['stat_data']['stat_cost'] . '<br>';
            echo sendCostKeitaro($taskValue['stat_data']['stat_cost'], $id_campaign_keitaro, $today);

        }
    }
}