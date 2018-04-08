<?php
/**
 * Created by PhpStorm.
 * User: newexe
 * Date: 08.04.18
 * Time: 3:20
 */

namespace App\Services;


class GeoData
{
    /**
     * @var string URL for GET request.
     */
    static $url = 'http://ip-api.com/json';

    /**
     * @return object
     */
    public static function get()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => self::$url,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }
}