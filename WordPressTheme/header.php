<?php
global $post, $_HEADER;

// URLを取得
$http = is_ssl() ? 'https' : 'http' . '://';
$_HEADER['url'] = $http . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

//ディスクリプションを取得
$_HEADER['description'] = wp_trim_words(strip_shortcodes($post->post_content), 55);

//ogp画像を取得
$_HEADER['og_image'] = get_the_post_thumbnail_url($post->ID);

//ページタイトルを取得
if (is_single() || is_page()) {
  $_HEADER['title'] = (get_the_title($post->ID)) ? get_the_title($post->ID) : get_bloginfo('name');
} else {
  $_HEADER['title'] = get_bloginfo('name');
}

$og_image .= '?' . time(); // UNIXTIMEのタイムスタンプをパラメータとして付与（OGPのキャッシュ対策）

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- meta情報 -->
  <title><?php echo esc_html($_HEADER['title']); ?></title>
  <meta name="description" content="<?php bloginfo('description') ?>" />
  <meta name="keywords" content="キーワード" />
  <meta name=”robots” content=”noindex”>
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="theme-color" content="#333333">
  <!-- ogp -->
  <meta property="og:title" content="<?php echo esc_html($_HEADER['title']); ?>" />
  <meta property="og:type" content="blog" />
  <meta property="og:url" content="<?php echo esc_html($_HEADER['url']); ?>" />
  <meta property="og:image" content="<?php echo esc_html($_HEADER['og_image'] . $og_image); ?>" />
  <meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
  <meta property="og:description" content="<?php echo esc_html($_HEADER['description']); ?>" />
  <!-- ファビコン -->
  <link rel="”icon”" href="" />
  <!-- Web font -->
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&family=Noto+Serif+JP&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Jura:wght@400;700&display=swap" rel="stylesheet">
  <!-- FontAwesome -->
  <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet">
  <!-- swiper.css -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <!-- swiper.js -->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="//cdn.jsdelivr.net/npm/imagesloaded@4.1.4/imagesloaded.pkgd.min.js"></script>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <!---画面遷移用（ひとまず非表示（実装済み））-->
  <?php if (is_front_page()) : ?>
    <!-- <div id="u-splash">
      <div id="u-splash-logo" class="u-loader"></div>
    </div>
    <div class="u-splashbg1"></div>
    <div class="u-splashbg2"></div>
  <div id="u-splash-container"> -->
  <?php endif; ?>
  <header id="u-header" class="l-header p-header DownMove">
    <div class="p-header__inner">

      <!-- ヘッダーロゴ -->
      <section class="p-header-logo">
        <a href="<?php echo esc_url(home_url()); ?>">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/logo.svg" alt="仮ロゴ">
          <div class="p-header-logo__title">
            <h1>Web制作アライズカラー</h1>
            <p>ポートフォリオサイト</p>
          </div>
        </a>
      </section>

      <!-- ヘッダーメニュー -->
      <nav class="p-header-nav js-drawer-open">
        <div class="p-header-nav__container p-g-nav">
          <ul class="p-g-nav__list">
            <li class="p-g-nav__item u-hidden-pc"><a class="p-g-nav__link js-glowAnime" href="<?php echo esc_url(home_url()); ?>">ホーム</a></li>
            <li class="p-g-nav__item"><a class="p-g-nav__link u-link-hover__nav js-glowAnime" href="<?php echo esc_url(home_url('news')); ?>">お知らせ</a></li>
            <li class="p-g-nav__item"><a class="p-g-nav__link u-link-hover__nav js-glowAnime" href="<?php echo esc_url(home_url('content')); ?>">事業内容</a></li>
            <li class="p-g-nav__item"><a class="p-g-nav__link u-link-hover__nav js-glowAnime" href="<?php echo esc_url(home_url('works')); ?>">制作実績</a></li>
            <li class="p-g-nav__item"><a class="p-g-nav__link u-link-hover__nav js-glowAnime" href="<?php echo esc_url(home_url('overview')); ?>">企業概要</a></li>
            <li class="p-g-nav__item"><a class="p-g-nav__link u-link-hover__nav js-glowAnime" href="<?php echo esc_url(home_url('blog')); ?>">ブログ</a></li>
          </ul>
          <div class="p-header-nav__contact">
            <a class="p-header-nav__btn js-glowAnime" href="<?php echo esc_url(home_url('contact')); ?>">お問い合わせ</a>
          </div>
          <div class="p-header-nav__circle-background js-drawer-open"></div>
        </div>

      </nav>

      <!-- ドロワーメニュー -->
      <div class="p-header__menu">
        <button class="c-drawer-menu js-drawer" aria-label="メニュー" aria-controls="nav" aria-expanded="false">
          <span></span>
          <span></span>
          <span></span>
        </button>
      </div>
    </div>


  </header>
  <main>
    <!-- ページトップへのリンクボタン -->
    <div class="p-pagetop"></div>

    <?php if (is_front_page()) : ?>
      <!-- トップ画面：メインビジュアル-->
      <section id="top-mv" class="p-top-mv">
        <div class="swiper-container js-swiper-mv p-top-mv__swiper-container">
          <div class="swiper-wrapper p-top-mv__swiper-wrapper">

            <!-- 繰り返しフィールド読み込み -->
            <?php
            $topMVgroup = SCF::get('main-visual__group');
            foreach ($topMVgroup as $fields) {
            ?>

              <div class="swiper-slide p-top-mv__swiper-slide">
                <div class="slide-img p-top-mv__slide-img">
                  <?php echo wp_get_attachment_image(esc_html($fields['main-visual__img']), 'full'); ?>
                </div>
              </div>

            <?php } ?>
          </div>

          <div class="p-top-mv__titlebox">
            <h2 class="p-top-mv__title">サンプルサイト</h2>
            <div class="p-top-mv__subtitle">
              <p>当サイトはWordPressオリジナルテーマをgulp環境にて作成致しました。</p>
              <p>デザインはオリジナルではございませんが、模範コードやサンプルコードがないデザインカンプを使用しておりますため、コードは完全オリジナルです。</p>
              <!-- <p>別途HTML版で、ピクセルパーフェクトで作成したものもございます。（トップページのみ）</p> -->
              <!-- <span>こちらの画像は</span><span>Smart Custom Fieldsにて、</span>
              <span>変更や追加ができるように</span><span>設定しています。</span><br>
              <span>スライダーは</span><span>swiperを使用しており、</span>
              <span>他にもパララックス効果を</span><span>設定したもの（トップページ中ほど）</span>
              <span>サムネイル画像と連動</span><span>させたもの（制作実績詳細）と、</span>
              <span>サンプルとして複数パターン</span><span>実装しています。</span> -->
            </div>
            <div class="p-top-mv__subtitle p-top-mv__subtitle--second">
              <p>スマホファーストにて記述、ブレイクポイントは一ヶ所（768px）のみですが、pxではなく基本remで統一することで、768px～1100pxの間はリキッドレイアウトとなるようにしているのが特徴です。</p>
              <p>是非、画面幅を動かしてみて、全体の変化をご確認ください。</p>
            </div>
          </div>
        </div>
      </section>
    <?php elseif (is_singular('works') || is_singular('blog')) : ?>
      <!-- パンくずリスト -->
      <div class="l-breadcrumbs__single">
        <div class="l-inner">
          <?php if (function_exists('bcn_display')) {
            bcn_display();
          } ?>
        </div>
      </div>

      <!-- フロントページ以外 -->
    <?php else : ?>
      <!-- ヘッダー画像とタイトル表示 -->
      <section class="p-page-head">
        <div class="p-page-head__wrapper">
          <div class="p-page-head__img">
            <?php echo get_main_image(); ?>
          </div>

          <div class="p-page-head__container">
            <h2 class="p-page-head__title"><?php echo get_main_title(); ?></h2>
          </div>
        </div>
      </section>

      <!-- パンくずリスト -->
      <div class="l-breadcrumbs">
        <div class="l-inner">
          <?php if (function_exists('bcn_display')) {
            bcn_display();
          } ?>
        </div>
      </div>
    <?php endif; ?>