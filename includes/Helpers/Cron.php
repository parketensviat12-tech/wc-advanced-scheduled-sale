<?php
defined('ABSPATH') || exit;

/**
 * Cron функции за автоматично стартиране на отстъпки
 */
class WC_ASS_Cron {

    const HOOK = 'wc_ass_run_scheduled_sales';

    public static function init() {
        add_action(self::HOOK, [self::class, 'run_scheduled_sales']);
    }

    /**
     * Стартира се от WP Cron
     */
    public static function run_scheduled_sales() {
        // Вземи активните правила от базата данни (оптимизирано)
        $rules = get_option('wc_ass_rules', []);
        if (empty($rules)) return;

        foreach ($rules as $rule) {
            $products = WC_ASS_ProductQuery::get_products(
                $rule['categories'] ?? [],
                $rule['manufacturers'] ?? []
            );

            WC_ASS_Apply::apply($products, $rule['discount_percent']);
        }
    }

    /**
     * Регистрация на WP Cron
     */
    public static function schedule() {
        if (!wp_next_scheduled(self::HOOK)) {
            wp_schedule_event(time(), 'daily', self::HOOK);
        }
    }

    /**
     * Премахване на Cron при деактивиране
     */
    public static function clear_schedule() {
        $timestamp = wp_next_scheduled(self::HOOK);
        if ($timestamp) {
            wp_unschedule_event($timestamp, self::HOOK);
        }
    }
}

// Инициализация
add_action('init', [WC_ASS_Cron::class, 'init']);
register_activation_hook(__FILE__, [WC_ASS_Cron::class, 'schedule']);
register_deactivation_hook(__FILE__, [WC_ASS_Cron::class, 'clear_schedule']);
