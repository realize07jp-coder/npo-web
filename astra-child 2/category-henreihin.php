<?php
/**
 * 返礼品カテゴリーアーカイブ テンプレート
 *
 * 【使い方】
 * このファイルを FTP で WordPress の子テーマフォルダへアップロードしてください。
 * アップロード先: /wp-content/themes/[使用中のテーマ名]/category-henreihin.php
 *
 * ※子テーマを使っていない場合は親テーマのフォルダに置いても動きますが、
 *   テーマ更新時に上書きされる可能性があるため子テーマ推奨。
 *
 * 【生成されるURL】
 * https://chikugogawa.com/category/henreihin/
 */

get_header();
?>

<style>
/* ── 返礼品アーカイブ スタイル ─────────────────────────────────── */
.henreihin-archive {
    max-width: 1100px;
    margin: 60px auto;
    padding: 0 20px;
    font-family: 'Noto Sans JP', sans-serif;
}

.henreihin-archive h1 {
    font-size: 2rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 12px;
    color: #2c2c2c;
}

.henreihin-archive .archive-desc {
    text-align: center;
    color: #555;
    margin-bottom: 48px;
    font-size: 1rem;
    line-height: 1.8;
}

.henreihin-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 36px;
}

.henreihin-card {
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    transition: transform 0.2s, box-shadow 0.2s;
    text-decoration: none;
    color: inherit;
    display: block;
}

.henreihin-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.14);
    text-decoration: none;
    color: inherit;
}

.henreihin-card-img {
    width: 100%;
    aspect-ratio: 3 / 2;
    object-fit: cover;
    display: block;
}

.henreihin-card-img-placeholder {
    width: 100%;
    aspect-ratio: 3 / 2;
    background: #e8ede8;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #999;
    font-size: 0.85rem;
}

.henreihin-card-body {
    padding: 20px 22px 24px;
}

.henreihin-card-amount {
    display: inline-block;
    background: #3a6b3a;
    color: #fff;
    font-size: 0.78rem;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 4px;
    margin-bottom: 10px;
    letter-spacing: 0.04em;
}

.henreihin-card-title {
    font-size: 1.05rem;
    font-weight: 700;
    line-height: 1.5;
    margin-bottom: 8px;
    color: #2c2c2c;
}

.henreihin-card-excerpt {
    font-size: 0.88rem;
    color: #666;
    line-height: 1.7;
}

.henreihin-back {
    text-align: center;
    margin-top: 56px;
}

.henreihin-back a {
    display: inline-block;
    padding: 12px 32px;
    border: 2px solid #3a6b3a;
    border-radius: 4px;
    color: #3a6b3a;
    font-weight: 600;
    text-decoration: none;
    transition: background 0.2s, color 0.2s;
}

.henreihin-back a:hover {
    background: #3a6b3a;
    color: #fff;
}
</style>

<div class="henreihin-archive">

    <h1><?php single_cat_title(); ?></h1>

    <?php
    $cat_description = category_description();
    if ( $cat_description ) :
    ?>
        <p class="archive-desc"><?php echo $cat_description; ?></p>
    <?php else : ?>
        <p class="archive-desc">寄付のお礼に自然のめぐみをお届けいたします。<br>寄付額に応じて返礼品をお送りいたします。</p>
    <?php endif; ?>

    <div class="henreihin-grid">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <?php
            // カスタムフィールド「寄付額」があれば表示（なければ空）
            $amount = get_post_meta( get_the_ID(), '寄付額', true );
            ?>

            <a class="henreihin-card" href="<?php the_permalink(); ?>">

                <?php if ( has_post_thumbnail() ) : ?>
                    <img class="henreihin-card-img"
                         src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ) ); ?>"
                         alt="<?php the_title_attribute(); ?>">
                <?php else : ?>
                    <div class="henreihin-card-img-placeholder">画像なし</div>
                <?php endif; ?>

                <div class="henreihin-card-body">
                    <?php if ( $amount ) : ?>
                        <span class="henreihin-card-amount"><?php echo esc_html( $amount ); ?>円〜</span>
                    <?php endif; ?>
                    <div class="henreihin-card-title"><?php the_title(); ?></div>
                    <div class="henreihin-card-excerpt">
                        <?php echo wp_trim_words( get_the_excerpt(), 30, '...' ); ?>
                    </div>
                </div>

            </a>

        <?php endwhile; endif; ?>
    </div>

    <div class="henreihin-back">
        <a href="<?php echo esc_url( home_url( '/donation' ) ); ?>">← 寄付ページに戻る</a>
    </div>

</div>

<?php get_footer(); ?>
