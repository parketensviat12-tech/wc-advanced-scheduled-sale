<?php
defined('ABSPATH') || exit;

class WC_Ass_Logger {

    public static function log($message) {
        $date = date('Y-m-d H:i:s');
        $entry = "[{$date}] {$message}\n";
        file_put_contents(WC_ASS_LOG, $entry, FILE_APPEND);
    }
}
