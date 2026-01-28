<?php
defined('ABSPATH') || exit;

class WC_Ass_Assets {

    public static function init() {
        add_action('admin_enqueue_scripts', [__CLASS__, 'enqueue']);
    }

    public static function enqueue() {
        wp_enqueue_style(
            'wc-ass-admin',
            WC_ASS_URL . 'includes/Admin/admin.css',
            [],
            WC_ASS_VERSION
        );
    }
}

WC_Ass_Assets::init();
