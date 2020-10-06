<?php

/**
 * Global helpers file with misc functions.
 */
if (!function_exists('triggerAsyncRequest')) {
    function triggerAsyncRequest($url, $params = "", $method = "get", $headers = [])
    {
        $channel = curl_init();
        curl_setopt($channel, CURLOPT_URL, $url);
        curl_setopt($channel, CURLOPT_POST, $method == "post" || $method == "POST" ? true : false);
        curl_setopt($channel, CURLOPT_POSTFIELDS, $params);
        curl_setopt($channel, CURLOPT_NOSIGNAL, 1);
        curl_setopt($channel, CURLOPT_TIMEOUT_MS, 200);
        if ($headers) {
            curl_setopt($channel, CURLOPT_HTTPHEADER, $headers);
        }
        curl_exec($channel);
        curl_close($channel);
    }
}
if (!function_exists('triggerSyncRequest')) {
    function triggerSyncRequest($url, $method = 'GET', $params = [], $headers = [])
    {
        $ch = curl_init();
        $timeout = 30;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if ($headers) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        if ($method != 'GET') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        }

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return json_decode($data, true);
    }
}


if (!function_exists('getImageSystemCdnUrl')) {
    function getImageSystemCdnUrl($url, $witdh = '0', $height = '0')
    {
        $retval = "";
        $cdn_url = config('app.cdn_base_url');
        $quality_string = "unsafe/" . $witdh . "x" . $height . "/left/top/smart/filters:quality(70)/";
        $system_url = config('app.system_url');
        $resource_url = "api/resources";
        $retval = $cdn_url . $quality_string . $system_url . $resource_url . $url;
        return $retval;
    }
}