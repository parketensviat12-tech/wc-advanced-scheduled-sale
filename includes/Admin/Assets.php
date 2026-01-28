<?php
defined('ABSPATH') || exit;

class WC_ASS_Admin_Assets {

    public function __construct() {
        add_action('admin_enqueue_scripts', [$this, 'enqueue']);
    }

    public function enqueue($hook) {
        // Проверяваме дали сме на нашата страница
        if ($hook !== 'toplevel_page_wc-advanced-scheduled-sale') return;

        // CSS
        wp_enqueue_style(
            'wc-ass-admin',
            WC_ASS_URL . 'includes/Admin/admin.css',
            [],
            WC_ASS_VERSION
        );

        // JS
        wp_enqueue_script(
            'wc-ass-admin',
            WC_ASS_URL . 'includes/Admin/admin.js',
            ['jquery'],
            WC_ASS_VERSION,
            true
        );

        // Локализиране на данни за JS (REST URL + nonce)
        wp_localize_script('wc-ass-admin', 'wc_ass_vars', [
            'rest_url' => esc_url(rest_url('')),
            'nonce'    => wp_create_nonce('wp_rest')
        ]);
    }
}

new WC_ASS_Admin_Assets();
