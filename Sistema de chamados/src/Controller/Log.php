<?php

namespace QI\SistemaDeChamados\Controller;

class Log
{
    private static $file_path = "../../system_logs.log";

    public static function write($text)
    {
        $text = date("d/m/Y h:m:s") . " - " . $text;
        $file = fopen(self::$file_path, "w");
        fwrite($file, $text);
        fclose($file);
    }
}
