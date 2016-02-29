<?php

namespace App;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

class Logger implements LoggerInterface
{
    use LoggerTrait;

    public function log($level, $message, array $context = array())
    {
        $e = $context['exception'];
        if (isset($e) && $e instanceof \Exception) {
            $fp = fopen('error_logs/err_log.txt', 'a');
            fwrite($fp,
                date('y-m-d G:i:s') . ': Ошибка класса ' . get_class($e) . '( ' . $level . ' )' . $message .
                'in file: ' . $e->getFile() . 'on line ' . $e->getLine() . "\n");
            fclose($fp);
        }
    }

    /* public static function write(\Exception $e)
     {
         $fp = fopen('error_logs/err_log.txt', 'a');
         fwrite($fp, date('y-m-d G:i:s') . ': Ошибка класса ' . get_class($e) . ' ' . $e->getMessage() . "\n");
         fclose($fp);
     }*/
}