<?php
class Logger {
    public static function log($message, $level = 'info') {
        $logFile = 'logs/app.log';
        $logEntry = date('Y-m-d H:i:s') . " [$level] $message" . PHP_EOL;
        file_put_contents($logFile, $logEntry, FILE_APPEND);
    }
}
