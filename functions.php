<?php

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
        }
    }
}
