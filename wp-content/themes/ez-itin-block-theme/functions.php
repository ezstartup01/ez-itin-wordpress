<?php
/**
 * EZ-ITIN Block Theme bootstrap.
 */

declare(strict_types=1);

add_action('wp_enqueue_scripts', static function (): void {
    wp_enqueue_script(
        'ez-itin-navigation',
        get_theme_file_uri('assets/js/navigation.js'),
        [],
        '0.1.0',
        true
    );
});

add_action('after_setup_theme', static function (): void {
    add_theme_support('editor-styles');
    add_editor_style('assets/css/design-system.css');
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
});
