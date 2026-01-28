<?php
defined('ABSPATH') || exit;

class WC_ASS_Utils {
    public static function sanitize_percentage($value): float {
        return max(0, min(100, (float)$value));
    }

    public static function parse_date(string $date): ?\DateTime {
        try {
            return new \DateTime($date);
        } catch (\Exception $e) {
            return null;
        }
    }
}
