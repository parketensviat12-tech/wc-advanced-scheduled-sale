<?php
defined('ABSPATH') || exit;

class WC_ASS_Admin_Assets {

    public function __construct() {
        add_action('admin_enqueue_scripts', [$this, 'enqueue_assets']);
    }

    public function enqueue_assets($hook) {
        if ($hook !== 'toplevel_page_wc-advanced-scheduled-sale') return;

        wp_enqueue_style(
            'wc-ass-admin-css',
            WC_ASS_URL . 'includes/Admin/admin.css',
            [],
            WC_ASS_VERSION
        );

        wp_enqueue_script(
            'wc-ass-admin-js',
            WC_ASS_URL . 'includes/Admin/admin.js',
            ['jquery'],
            WC_ASS_VERSION,
            true
        );

        wp_localize_script('wc-ass-admin-js', 'wcAss', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('wc_ass_nonce')
        ]);
    }
}

new WC_ASS_Admin_Assets();
