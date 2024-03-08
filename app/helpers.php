<?php

if (! function_exists('show_route')) {
    function show_route($model, $resource = null)
    {
        $resource = $resource ?? plural_from_model($model);
        return route("{$resource}.show", $model);
    }
}


if (! function_exists('current_date')) {
    function current_date()
    {
        return date("Y-m-d H:i:s");
    }
}

if (! function_exists('pr')) {
    function pr($data,$die="")
    {
        echo "<pre>"; print_r($data); echo "</pre>";
        if($die) die; 
    }
}

if (! function_exists('custom_error_log')) {
    function custom_error_log($msg)
    {
    $response = ["message" => $msg ,'status' => 0];
    return response($response, 200);exit;  
    }
}

if (! function_exists('booking_log')) {
    function booking_log($booking_no,$booking_logs)
    { 

    $booking_log_path = storage_path() . '/booking_logs/'.$booking_no;
    if (!file_exists($booking_log_path)) {
    mkdir($booking_log_path, 0755, true);
    }
    $LogInfo = 'Step - '.$booking_logs['step'].';TimeStamp - '.$booking_logs['time_stamp'].';Msg - '.$booking_logs['msg'];
    file_put_contents($booking_log_path.'/'.$booking_no.'.txt',$LogInfo . "\n\n\n",FILE_APPEND);
    $response = ["message" => 'success' ,'status' => 0];
    return response($response, 200);   
    }
}

if (! function_exists('get_client_ip')) {

    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}
