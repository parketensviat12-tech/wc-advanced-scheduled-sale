<?php
defined('ABSPATH') || exit;

class WC_ASS_Logger {
    public static function log(string $message): void {
        $time = date('Y-m-d H:i:s');
        $line = "[{$time}] {$message}\n";
        file_put_contents(WC_ASS_LOG, $line, FILE_APPEND);
    }
}
