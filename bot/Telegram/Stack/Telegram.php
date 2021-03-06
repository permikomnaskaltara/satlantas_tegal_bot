<?php

namespace Telegram\Stack;

defined("TOKEN") or die("TOKEN not defined!");

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */

class Telegram
{
    /**
     * @param string $a
     * @param array  $b
     */
    public static function __callStatic($a, $b)
    {
        // var_dump($b);
        $ch = curl_init("https://api.telegram.org/bot".TOKEN."/".$a);
        $op = array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false
        );
        if (!isset($b[1])) {
            $op[CURLOPT_POST] = true;
            $op[CURLOPT_POSTFIELDS] = http_build_query($b[0]);
        }
        curl_setopt_array($ch, $op);
        $out = curl_exec($ch);
        $err = curl_error($ch) and $out = $err;
        curl_close($ch);
        return $out;
    }
}
