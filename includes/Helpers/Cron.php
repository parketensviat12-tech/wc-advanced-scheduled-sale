<?php
defined('ABSPATH') || exit;

class WC_Ass_Cron {

    public static function init() {
        add_action('wc_ass_cron_apply_sales', [__CLASS__, 'run_sales']);
    }

    public static function run_sales() {
        $rules = get_option('wc_ass_rules', []);
        $today = date('Y-m-d');

        foreach ($rules as $rule) {
            if ($today >= $rule['start_date'] && $today <= $rule['end_date']) {
                WC_Ass_Apply::apply_rules([$rule]);
            }
        }
    }

    public static function schedule() {
        if (!wp_next_scheduled('wc_ass_cron_apply_sales')) {
            wp_schedule_event(time(), 'daily', 'wc_ass_cron_apply_sales');
        }
    }

    public static function clear_schedule() {
        $timestamp = wp_next_scheduled('wc_ass_cron_apply_sales');
        if ($timestamp) wp_unschedule_event($timestamp, 'wc_ass_cron_apply_sales');
    }
}

add_action('wp', [WC_Ass_Cron::class, 'schedule']);
