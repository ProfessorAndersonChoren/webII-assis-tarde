<?php

namespace QI\SistemaDeChamados\Controller;

class Log
{
    private function __construct()
    {
    }

    public static function write($log)
    {
        $logsDir = dirname(dirname(__DIR__)) . "/logs/";
        if (!is_dir($logsDir)) {
            mkdir($logsDir);
        }
        $log_path =  $logsDir . date("Y-m-d h-i-s") . ".log";
        $file = fopen($log_path, 'w');
        fwrite($file, $log);
        fclose($file);
    }
}
