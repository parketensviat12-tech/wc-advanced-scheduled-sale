<?php
defined('ABSPATH') || exit;

class WC_ASS_Admin_Menu {

    public function __construct() {
        add_action('admin_menu', [$this, 'register_menu']);
    }

    public function register_menu() {
        add_menu_page(
            __('Насрочени отстъпки', 'wc-advanced-scheduled-sale'),
            __('Насрочени отстъпки', 'wc-advanced-scheduled-sale'),
            'manage_woocommerce',
            'wc-advanced-scheduled-sale',
            [$this, 'admin_page'],
            'dashicons-tickets-alt',
            56
        );
    }

    public function admin_page() {
        // Включваме страницата
        include WC_ASS_PATH . 'includes/Admin/Page.php';
    }
}

new WC_ASS_Admin_Menu();
