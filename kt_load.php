<?php 

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);


//$date = date("Y-m-d"); // Сегодняшняя дата

function sendCostKeitaro($cost,$id_camp_keitaro, $date){

    $apikey='YOUR_TOKEN_KEITARO'; // ваш api ключ для доступа к API кейтаро
    $domain='http://00.000.000.00'; // домен/ip на котором висит кейтаро БЕЗ СЛЕША В КОНЦЕ!!!
    $timezone='Europe/Moscow'; // ваша временная зона
    $currency = 'EUR';

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $domain.'/admin_api/v1/clicks/update_costs',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
  "campaign_ids": [
    "'.$id_camp_keitaro.'"
  ],
  "costs": [
    {
      "start_date": "'.$date.' 00:00",
      "end_date": "'.$date.' 23:59",
      "cost": "'.$cost.'"
    }
  ],
  "timezone": "'.$timezone.'",
  "currency": "'.$currency.'",
  "only_campaign_uniques": 0
}',
        CURLOPT_HTTPHEADER => array(
            'Connection: keep-alive',
            'Accept: application/json, text/plain, */*',
            'Content-Type: application/json;charset=UTF-8',
            'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
            'Api-Key: '.$apikey.''
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    //echo $response;

    $updateres= json_decode($response);
    if($updateres->success)
    {
        echo "Загрузили расходы в кампанию ID: " . $id_camp_keitaro . " за " . $date . "<br/>";
    }
    else{
        echo "Не смогли загрузить расходы для кампании " . $id_camp_keitaro . " <br> Возможно такой кампании не существует <br>";
        var_dump($updateres);
    }
}