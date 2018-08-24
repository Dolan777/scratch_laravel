<?php

use App\Model\Settings;

function getControllerActionName() {
    return substr(\Route::getCurrentRoute()->getActionName(), (strpos(\Route::getCurrentRoute()->getActionName(), '@') + 1));
}

function getControllerName() {
    list($controller, $action) = explode('@', \Route::getCurrentRoute()->getActionName());
    return preg_replace('/.*\\\/', '', $controller);
}

function rand_string($digits) {
    $alphanum = "1234567890AabBcCdDEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz";
    // generate the random string
    $rand = substr(str_shuffle($alphanum), 0, $digits);

    return $rand;
}

function get_settings($module, $slug) {
    $model = Settings::where('slug', $slug)->where('module', $module)->get()->first();
    return $model->value;
}

function get_settings_by_slug($slug) {
    $model = Settings::where('slug', $slug)->get()->first();
    return $model->value;
}

function get_user_ip() {
    if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
        //check for ip from share internet
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    } elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
        // Check for the Proxy User
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    } else {
        $ip = $_SERVER["REMOTE_ADDR"];
    }
    return $ip;
}

function batch_step($current_step, $t_step) {
    if ($current_step == 'new') {
        if ($t_step == 1) {
            return 'active';
        } else {
            return '';
        }
    } else {
        if ($current_step == $t_step) {
            return 'active';
        } else {
            if ($current_step > $t_step) {
                return 'done';
            } else {
                return '';
            }
        }
    }
}

function get_day_list() {
    return [
        1 => 'Monday',
        2 => 'Tuesday',
        3 => 'Wednesday',
        4 => 'Thursday',
        5 => 'Friday',
        6 => 'Saturday',
        7 => 'Sunday'
    ];
}

function get_reason() {
    return [
        1 => 'Sign',
        2 => 'Flyer',
        3 => 'Google/Other search engine',
        4 => 'Facebook',
        5 => 'Friend',
        6 => 'Other'
    ];
}

function get_day_name($index) {
    $days = get_day_list();
    return $days[$index];
}

function get_reason_details($index) {
    $reason_details = get_reason();
    return $reason_details[$index];
}

function get_current_date_index($date) {
    if ($date != "") {
        return date('N', strtotime($date));
    } else {
        return 1;
    }
}

function get_week_days_by_day_date($date) {
    $days = [];
// parse about any English textual datetime description into a Unix timestamp 
    $ts = strtotime($date);
// find the year (ISO-8601 year number) and the current week
    $year = date('o', $ts);
    $week = date('W', $ts);
// print week for the current date
    for ($i = 1; $i <= 7; $i++) {
        // timestamp from ISO week date format
        $ts = strtotime($year . 'W' . $week . $i);
        $days[$i] = date("Y-m-d", $ts);
    }

    return $days;
}

function google_date($timestamp = 0) {
    if (!$timestamp) {
        $timestamp = time();
    }
    $date = date('Y-m-d\TH:i:s', $timestamp);
    $matches = array();
    if (preg_match('/^([\-+])(\d{2})(\d{2})$/', date('O', $timestamp), $matches)) {
        $date .= $matches[1] . $matches[2] . ':' . $matches[3];
    } else {
        $date .= 'Z';
    }
    return $date;
}

function get_cms_collection($page_name, $section_type) {
    return App\Model\Cms::where('page_name', $page_name)->where('section_name', $section_type)->get()->all();
}

function get_cms_by_slug($slug) {
    if ($slug != "") {
        return App\Model\Cms::where('slug', $slug)->get()->first();
    }
}

function generate_color() {
    $color = dechex(rand(0x000000, 0xFFFFFF));
    return "#" . $color;
}

function create_schedule($batch_master_id, $type) {
    $model = new \App\Model\SyncSchedule();
    $model->batch_master_id = $batch_master_id;
    $model->process_type = $type;
    $model->status = '1';
    $model->save();
    $batch_master = \App\Model\BatchMaster::where('id', $batch_master_id)->get()->first();
    if ($batch_master) {
        $batch_master->teacher_sync_status = '0';
        $batch_master->save();
    }
}

function db_date_format($date) {
    if ($date != '') {
        return date_format(new \DateTime($date), 'Y-m-d');
    }
    return $date;
}

function site_date_format($date) {
    if ($date != '') {
        return date_format(new \DateTime($date), 'd-m-Y');
    }
    return $date;
}
