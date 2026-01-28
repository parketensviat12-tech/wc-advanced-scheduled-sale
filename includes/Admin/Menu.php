<?php
defined('ABSPATH') || exit;

class WC_ASS_Admin_Menu {

    private $page_hook;

    public function __construct() {
        add_action('admin_menu', [$this, 'register_menu']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_assets']);
    }

    public function register_menu() {
        $this->page_hook = add_menu_page(
            __('Насрочени отстъпки', 'wc-advanced-scheduled-sale'),
            __('Насрочени отстъпки', 'wc-advanced-scheduled-sale'),
            'manage_woocommerce',
            'wc-advanced-scheduled-sale',
            [$this, 'admin_page'],
            'dashicons-tickets-alt',
            56
        );
    }

    public function enqueue_assets($hook) {
        if ($hook !== $this->page_hook) {
            return;
        }

        wp_enqueue_style(
            'wc-ass-admin',
            WC_ASS_URL . 'includes/Admin/admin.css',
            [],
            WC_ASS_VERSION
        );

        wp_enqueue_script(
            'wc-ass-admin',
            WC_ASS_URL . 'includes/Admin/admin.js',
            ['jquery'],
            WC_ASS_VERSION,
            true
        );
    }

    public function admin_page() {
        if (!current_user_can('manage_woocommerce')) {
            wp_die(__('Нямате необходимите права за достъп до тази страница.', 'wc-advanced-scheduled-sale'));
        }
        include WC_ASS_PATH . 'includes/Admin/Page.php';
    }
}

new WC_ASS_Admin_Menu();
