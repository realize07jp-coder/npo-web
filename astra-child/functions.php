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

// 子テーマのスタイルシートを読み込む（Astra本体のCSSより後に適用するため優先度を下げる）
add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'astra-child-style',
        get_stylesheet_uri(),
        array( 'astra-parent-style' ),
        wp_get_theme()->get( 'Version' )
    );
}, 20 );
