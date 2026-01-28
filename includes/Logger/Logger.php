<?php
defined('ABSPATH') || exit;

/**
 * Логиране на действията на плъгина
 */
class WC_ASS_Logger {

    /**
     * Логира съобщение във файл
     * @param string $message
     */
    public static function log($message) {
        $date = date('Y-m-d H:i:s');
        $file = defined('WC_ASS_LOG') ? WC_ASS_LOG : WP_CONTENT_DIR . '/wc-ass.log';
        $line = "[$date] $message" . PHP_EOL;
        file_put_contents($file, $line, FILE_APPEND);
    }
}
