<?php

function status($status){
    if($status == 1){
        return '<span class="badge badge-dot mr-4"><i class="bg-success"></i><span class="status">Active</span></span>';
    }elseif ($status == 2){
        return '<span class="badge badge-dot mr-4"><i class="bg-danger"></i><span class="status">Rejected</span></span>';
    }else{
        return '<span class="badge badge-dot mr-4"><i class="bg-info"></i><span class="status">Await</span></span>';
    }
}

function searchSession($arrTask) {

    foreach($arrTask as $taskValue) {
        if ($taskValue->name == 'sessionid_ss_ads'){
            $result = [$taskValue->name, $taskValue->value];
            return $result;
        }
    }
}

function searchCsrf($arrTask) {

    foreach($arrTask as $taskValue) {
        if ($taskValue->name == 'csrftoken'){
            $result = [$taskValue->name, $taskValue->value];
            return $result;
        }
    }
}

function searchIdAccount($arrTask) {

    foreach($arrTask as $taskValue) {
        if ($taskValue->name == 'monitor_web_id'){
            $result = [$taskValue->name, $taskValue->value];
            return $result;
        }
        elseif ($taskValue->name == 'MONITOR_WEB_ID'){
            $result = [$taskValue->name, $taskValue->value];
            return $result;
        }else{
            return 0;
        }
    }
}

function searchId($arrTask){
    foreach($arrTask as $taskValue) {
        $taskValue->name == 'MONITOR_WEB_ID';
        $result = [$taskValue->name, $taskValue->value];

        $out = json_encode($result);

        $re = '~MONITOR_WEB_ID",".*?(.*)"]~is';

        preg_match($re, $out, $matches, PREG_OFFSET_CAPTURE, 0);

// Print the entire match result
        if($matches[1][0] > 0){
            return $matches[1][0];
        }
    }
}

function getBalance($idAccount, $csrfToken, $sessionid_ss_ads){

    $headers = [
        'user-agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4441.3 Safari/537.36',
        'content-type: application/json;charset=UTF-8',
        'trace-log-user-id: ' . $idAccount . '',
        'x-csrftoken: ' . $csrfToken . '',
        'referer: https://ads.tiktok.com/i18n/perf?aadvid=' . $idAccount,
        'cookie: csrftoken='. $csrfToken .'; sessionid_ss_ads=' . $sessionid_ss_ads . ';'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://ads.tiktok.com/api/v3/i18n/statistics/transaction/balance/query/?aadvid='. $idAccount . '&source=3&req_src=bidding');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, '{"lifetime":0,"relative_time":"0","st":"' . $today . '","et":"' . $today . '","keyword":"","search_type":1,"campaign_status":["no_delete"],"ad_status":[],"opt_status":[],"creative_status":[],"objective_type":[],"pricing":[],"placement_id":[],"image_mode":[],"ab_test":[],"having_filter":[],"country":[],"province":[],"city":[],"particle_locations":[],"bid_strategy":[],"age":[],"gender":[],"dpa_local_audience":[],"campaign_category":[],"budget_optimizer_switch":[],"promotion_type":[],"optimize_goal":[],"creative_material_mode":[],"flow_control_mode":[],"item_source":[],"dedicate_type":[],"version":1,"sort_stat":"","sort_order":0,"":[],"page":1,"limit":20,"query_list":["stat_cost","cpc","cpm","show_cnt","click_cnt","ctr","time_attr_convert_cnt","skan_convert_cnt","time_attr_conversion_cost","skan_conversion_cost","time_attr_conversion_rate","skan_conversion_rate","time_attr_effect_cnt","time_attr_effect_cost","time_attr_effect_rate"]}');

    $response = curl_exec($ch);
    $reslt = json_decode($response, true); // Ответ от ТТ с данными

    return $reslt;
}

function getStatus ($idAccount, $csrfToken, $sessionid_ss_ads){

    $headers = [
        'user-agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4441.3 Safari/537.36',
        'content-type: application/json;charset=UTF-8',
        'trace-log-user-id: ' . $idAccount . '',
        'x-csrftoken: ' . $csrfToken . '',
        'referer: https://ads.tiktok.com/i18n/perf?aadvid=' . $idAccount,
        'cookie: csrftoken='. $csrfToken .'; sessionid_ss_ads=' . $sessionid_ss_ads . ';'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://ads.tiktok.com/api/v4/i18n/advertiser/info/?aadvid=' . $idAccount);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, '{"lifetime":0,"relative_time":"0","st":"' . $today . '","et":"' . $today . '","keyword":"","search_type":1,"campaign_status":["no_delete"],"ad_status":[],"opt_status":[],"creative_status":[],"objective_type":[],"pricing":[],"placement_id":[],"image_mode":[],"ab_test":[],"having_filter":[],"country":[],"province":[],"city":[],"particle_locations":[],"bid_strategy":[],"age":[],"gender":[],"dpa_local_audience":[],"campaign_category":[],"budget_optimizer_switch":[],"promotion_type":[],"optimize_goal":[],"creative_material_mode":[],"flow_control_mode":[],"item_source":[],"dedicate_type":[],"version":1,"sort_stat":"","sort_order":0,"":[],"page":1,"limit":20,"query_list":["stat_cost","cpc","cpm","show_cnt","click_cnt","ctr","time_attr_convert_cnt","skan_convert_cnt","time_attr_conversion_cost","skan_conversion_cost","time_attr_conversion_rate","skan_conversion_rate","time_attr_effect_cnt","time_attr_effect_cost","time_attr_effect_rate"]}');

    $response = curl_exec($ch);
    $reslt = json_decode($response, true); // Ответ от ТТ с данными

    return $reslt;
}

function getStatisticsAll ($idAccount, $csrfToken, $sessionid_ss_ads, $today){

    $headers = [
        'user-agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4441.3 Safari/537.36',
        'content-type: application/json;charset=UTF-8',
        'trace-log-user-id: ' . $idAccount . '',
        'x-csrftoken: ' . $csrfToken . '',
        'referer: https://ads.tiktok.com/i18n/perf?aadvid=' . $idAccount,
        'cookie: csrftoken='. $csrfToken .'; sessionid_ss_ads=' . $sessionid_ss_ads . ';'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://ads.tiktok.com/api/v3/i18n/statistics/dashboard/campaignlist/?aadvid='.  $idAccount  .'&req_src=bidding');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, '{"version":1,"sort_stat":"stat_cost","sort_order":1,"page":1,"limit":10,"st":"' . $today . '","et":"' . $today . '","query_list":["stat_cost","show_cnt","click_cnt","time_attr_conversion_cost","time_attr_convert_cnt","ctr", "cpc"],"lifetime":0}');
    $response = curl_exec($ch);
    $result = json_decode($response, true); // Ответ от ТТ с данными

    return $result;
}