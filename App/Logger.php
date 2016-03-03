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
        $fp = fopen('error_logs/err_log.txt', 'a');
        if (isset($e) && $e instanceof \Exception) {
            fwrite($fp,
                date('y-m-d G:i:s') . ': Ошибка класса ' . get_class($e) . '(' . $level . ')' . $message .
                'в файле: ' . $e->getFile() . ' on line ' . $e->getLine() . "\n");
            fclose($fp);
        }
        else {
            fwrite($fp,  date('y-m-d G:i:s')  . 'Ошибка:' .  $level . ', ' . $message);
            fclose($fp);
        }
    }
}