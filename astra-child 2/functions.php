<?php
/**
 * Astra 子テーマ functions.php
 * 親テーマ（Astra）のスタイルを読み込む
 */

add_action( 'wp_enqueue_scripts', function () {
    // 親テーマのスタイルシートを読み込む
    wp_enqueue_style(
        'astra-parent-style',
        get_template_directory_uri() . '/style.css'
    );
} );
