<?php
defined('ABSPATH') || exit;

$rules = get_option('wc_ass_rules', []);
?>

<div class="wrap">
    <h1><?php _e('Насрочени отстъпки за WooCommerce', 'wc-advanced-scheduled-sale'); ?></h1>

    <form method="post">
        <h2><?php _e('Правила', 'wc-advanced-scheduled-sale'); ?></h2>
        <p><?php _e('Тук можете да добавяте или редактирате правила за sale price.', 'wc-advanced-scheduled-sale'); ?></p>
        <button class="button button-primary" type="submit" name="preview"><?php _e('Preview / Test', 'wc-advanced-scheduled-sale'); ?></button>
    </form>

    <?php if (isset($_POST['preview'])): 
        $preview = WC_Ass_DryRun::preview_rules($rules);
    ?>
        <h3><?php _e('Preview резултати', 'wc-advanced-scheduled-sale'); ?></h3>
        <table class="widefat">
            <thead>
                <tr>
                    <th><?php _e('ID', 'wc-advanced-scheduled-sale'); ?></th>
                    <th><?php _e('Име', 'wc-advanced-scheduled-sale'); ?></th>
                    <th><?php _e('Оригинална цена', 'wc-advanced-scheduled-sale'); ?></th>
                    <th><?php _e('Отстъпка %', 'wc-advanced-scheduled-sale'); ?></th>
                    <th><?php _e('Нова цена', 'wc-advanced-scheduled-sale'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($preview as $row): ?>
                    <tr>
                        <td><?php echo esc_html($row['ID']); ?></td>
                        <td><?php echo esc_html($row['Name']); ?></td>
                        <td><?php echo esc_html($row['Original']); ?></td>
                        <td><?php echo esc_html($row['Discount']); ?></td>
                        <td><?php echo esc_html($row['New']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
