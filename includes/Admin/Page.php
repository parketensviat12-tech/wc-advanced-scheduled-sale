<?php
defined('ABSPATH') || exit;
?>

<div class="wrap wc-ass-admin">
    <h1><?php _e('Насрочени отстъпки за WooCommerce', 'wc-advanced-scheduled-sale'); ?></h1>

    <form method="post" id="wc-ass-form">
        <table class="form-table">
            <tr>
                <th><?php _e('Производител', 'wc-advanced-scheduled-sale'); ?></th>
                <td>
                    <select name="wc_ass_manufacturer[]" multiple>
                        <?php
                        $terms = get_terms(['taxonomy' => 'product_brand', 'hide_empty' => false]);
                        foreach ($terms as $term) {
                            echo '<option value="' . esc_attr($term->term_id) . '">' . esc_html($term->name) . '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <th><?php _e('Категории', 'wc-advanced-scheduled-sale'); ?></th>
                <td>
                    <select name="wc_ass_categories[]" multiple>
                        <?php
                        $cats = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => false]);
                        foreach ($cats as $cat) {
                            echo '<option value="' . esc_attr($cat->term_id) . '">' . esc_html($cat->name) . '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <th><?php _e('Процент отстъпка', 'wc-advanced-scheduled-sale'); ?></th>
                <td>
                    <input type="number" name="wc_ass_discount" value="10" min="0" max="100" /> %
                </td>
            </tr>

            <tr>
                <th><?php _e('Начална дата', 'wc-advanced-scheduled-sale'); ?></th>
                <td>
                    <input type="date" name="wc_ass_start" value="<?php echo date('Y-m-d'); ?>" />
                </td>
            </tr>

            <tr>
                <th><?php _e('Крайна дата', 'wc-advanced-scheduled-sale'); ?></th>
                <td>
                    <input type="date" name="wc_ass_end" value="<?php echo date('Y-m-d', strtotime('+1 month')); ?>" />
                </td>
            </tr>
        </table>

        <p class="submit">
            <button type="button" class="button button-primary" id="wc-ass-preview"><?php _e('Preview / Test', 'wc-advanced-scheduled-sale'); ?></button>
            <button type="submit" class="button button-secondary"><?php _e('Приложи отстъпките', 'wc-advanced-scheduled-sale'); ?></button>
        </p>
    </form>

    <div id="wc-ass-result"></div>
</div>
