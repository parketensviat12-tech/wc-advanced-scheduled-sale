<?php
/**
 * Plugin Name: Woo Advanced Scheduled Sale
 * Plugin URI: https://example.com
 * Description: Насрочени отстъпки за WooCommerce с правила, preview, rollback, cron и лог.
 * Version: 3.0.0
 * Author: Custom Dev
 * Text Domain: wc-advanced-scheduled-sale
 * Domain Path: /languages
 */

defined('ABSPATH') || exit;

define('WC_ASS_VERSION', '3.0.0');
define('WC_ASS_PATH', plugin_dir_path(__FILE__));
define('WC_ASS_URL', plugin_dir_url(__FILE__));
define('WC_ASS_LOG', wp_upload_dir()['basedir'] . '/wc-ass.log');

/**
 * Зареждане на преводи
 */
add_action('plugins_loaded', function () {
    load_plugin_textdomain(
        'wc-advanced-scheduled-sale',
        false,
        dirname(plugin_basename(__FILE__)) . '/languages'
    );
});

/**
 * Core файлове
 */
require_once WC_ASS_PATH . 'includes/Core/ProductQuery.php';
require_once WC_ASS_PATH . 'includes/Core/RuleEngine.php';
require_once WC_ASS_PATH . 'includes/Core/DryRun.php';
require_once WC_ASS_PATH . 'includes/Core/Apply.php';
require_once WC_ASS_PATH . 'includes/Core/Rollback.php';

/**
 * Helper файлове
 */
require_once WC_ASS_PATH . 'includes/Helpers/Utils.php';
require_once WC_ASS_PATH . 'includes/Helpers/Cron.php';

/**
 * Admin файлове
 */
require_once WC_ASS_PATH . 'includes/Admin/Menu.php';
require_once WC_ASS_PATH . 'includes/Admin/Page.php';
require_once WC_ASS_PATH . 'includes/Admin/Assets.php';

/**
 * Logger
 */
require_once WC_ASS_PATH . 'includes/Logger/Logger.php';
