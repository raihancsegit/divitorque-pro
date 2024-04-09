<?php

namespace DiviTorque\DB;

class Forms
{
    public static function migrate()
    {
        self::create_forms_table();
        self::create_forms_entries(true);
    }

    private static function create_forms_table()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'torq_divi_forms';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `title` VARCHAR(255) NOT NULL,
            `unique_id` VARCHAR(255) NOT NULL,
            `created_by` INT NULL,
            `created_at` TIMESTAMP NULL,
            `updated_at` TIMESTAMP NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    private static function create_forms_entries($force = false)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'torq_divi_forms_entries';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `form_id` VARCHAR(45) NULL,
            `response` LONGTEXT NULL,
			`status` VARCHAR(45) NULL DEFAULT 'unread' COMMENT 'possible values: read, unread, trashed',
            `browser` VARCHAR(45) NULL,
            `device` VARCHAR(45) NULL,
            `ip` VARCHAR(45) NULL,
            `city` VARCHAR(45) NULL,
            `country` VARCHAR(45) NULL,
			`created_at` TIMESTAMP NULL,
			`updated_at` TIMESTAMP NULL,
            `post_id` INT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        $hasTable = $wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name;

        if ($force || !$hasTable) {
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }
}
