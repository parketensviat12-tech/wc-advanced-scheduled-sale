<?php
defined('ABSPATH') || exit;

class WC_ASS_Cron {

    public static function init(): void {
        if (!wp_next_scheduled('wc_ass_cron_event')) {
            wp_schedule_event(time(), 'hourly', 'wc_ass_cron_event');
        }
        add_action('wc_ass_cron_event', [self::class, 'run']);
    }

    public static function run(): void {
        // TODO: вкарвай правилата с дата и percent
        WC_ASS_Logger::log("Cron job executed");
    }
}

add_action('init', [WC_ASS_Cron::class, 'init']);
