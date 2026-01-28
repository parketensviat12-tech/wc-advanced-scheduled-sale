<?php
defined('ABSPATH') || exit;

/**
 * Помощен клас за прилагане на правила и отстъпки
 */
class WC_ASS_Helper_Apply {

    /**
     * Прилага правила и отстъпки на продуктите
     * @param array $rules Множество правила (категории + производители + процент)
     * @param bool $dry_run Ако е true, само preview
     * @return array Резултати от прилагането
     */
    public static function run_rules($rules, $dry_run = false) {
        $all_results = [];

        foreach ($rules as $rule) {
            $products = WC_ASS_ProductQuery::get_products(
                $rule['categories'] ?? [],
                $rule['manufacturers'] ?? []
            );

            if ($dry_run) {
                $results = WC_ASS_DryRun::preview($products, $rule['discount_percent']);
            } else {
                $results = WC_ASS_Apply::apply($products, $rule['discount_percent']);
            }

            $all_results[] = [
                'rule' => $rule,
                'products' => $results
            ];
        }

        return $all_results;
    }
}
