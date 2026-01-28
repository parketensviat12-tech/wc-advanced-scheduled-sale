<?php
defined('ABSPATH') || exit;

class WC_Ass_Menu {

    public static function init() {
        add_action('admin_menu', [__CLASS__, 'add_menu']);
    }

    public static function add_menu() {
        add_menu_page(
            __('WC Scheduled Sales', 'wc-advanced-scheduled-sale'),
            __('WC Sales', 'wc-advanced-scheduled-sale'),
            'manage_options',
            'wc-ass',
            [__CLASS__, 'render_page'],
            'dashicons-tag',
            56
        );
    }

    public static function render_page() {
        require WC_ASS_PATH . 'includes/Admin/Page.php';
    }
}

WC_Ass_Menu::init();
