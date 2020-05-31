<?php

namespace app\define;

class Send
{
    public static function url($url, $data = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_REFERER, 'https://www.google.com/');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Accept: application/json",
        ));
        curl_setopt($ch, CURLOPT_URL, $url);
        if ($data != null) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        } else {
            curl_setopt($ch, CURLOPT_POST, 0);
        }
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}