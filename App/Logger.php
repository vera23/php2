<?php

namespace App;


class Logger
{
    public static function write(\Exception $e) {
        $fp = fopen('error_logs/err_log.txt', 'a');
        fwrite($fp, date('y-m-d G:i:s') . ': Ошибка класса ' . get_class($e) . ' '. $e->getMessage() . "\n" );
        fclose($fp);
    }

}