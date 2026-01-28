<?php
defined('ABSPATH') || exit;

?>
<div class="wrap wc-ass-wrap">
    <h1><?php _e('Насрочени отстъпки', 'wc-advanced-scheduled-sale'); ?></h1>

    <p><?php _e('Тук можете да създавате, преглеждате и прилагате насрочени отстъпки за вашите продукти.', 'wc-advanced-scheduled-sale'); ?></p>

    <form id="wc-ass-form" method="post">
        <table class="form-table">
            <tr>
                <th scope="row"><?php _e('Производител', 'wc-advanced-scheduled-sale'); ?></th>
                <td>
                    <select name="wc_ass_manufacturer[]" multiple>
                        <?php
                        $terms = get_terms(['taxonomy' => 'pa_brand', 'hide_empty' => false]);
                        foreach ($terms as $term) {
                            echo '<option value="' . esc_attr($term->term_id) . '">' . esc_html($term->name) . '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php _e('Категории', 'wc-advanced-scheduled-sale'); ?></th>
                <td>
                    <select name="wc_ass_category[]" multiple>
                        <?php
                        $categories = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => false]);
                        foreach ($categories as $cat) {
                            echo '<option value="' . esc_attr($cat->term_id) . '">' . esc_html($cat->name) . '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php _e('Процент отстъпка', 'wc-advanced-scheduled-sale'); ?></th>
                <td>
                    <input type="number" name="wc_ass_discount" value="10" min="1" max="100"> %
                </td>
            </tr>
        </table>

        <p class="submit">
            <button type="submit" class="button button-primary"><?php _e('Преглед / Приложи', 'wc-advanced-scheduled-sale'); ?></button>
        </p>
    </form>

    <div id="wc-ass-preview"></div>
</div>
