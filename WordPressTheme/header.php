<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- meta情報 -->
  <title><?php bloginfo('name'); ?></title>
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <meta name=”robots” content=”noindex”>
  <!-- ogp -->
  <meta property="og:title" content="" />
  <meta property="og:type" content="" />
  <meta property="og:url" content="" />
  <meta property="og:image" content="" />
  <meta property="og:site_name" content="" />
  <meta property="og:description" content="" />
  <!-- ファビコン -->
  <link rel="”icon”" href="" />
  <!-- Web font -->
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&family=Noto+Serif+JP&display=swap" rel="stylesheet">
  <!-- swiper.css -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <!-- swiper.js -->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>


  <!-- <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/swiper@4.5.1/dist/css/swiper.min.css" /> -->
  <script src="//cdn.jsdelivr.net/npm/imagesloaded@4.1.4/imagesloaded.pkgd.min.js"></script>
  <!-- <script src="//cdn.jsdelivr.net/npm/swiper@4.5.1/dist/js/swiper.min.js"> -->



  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <header class="l-header p-header">
    <div class="p-header__inner">

      <!-- ヘッダーロゴ -->
      <div class="p-header-logo">
        <a href="/home/">
          <span>アライズカラー</span>
          <div>ポートフォリオサイト</div>
        </a>
      </div>

      <!-- ヘッダーメニュー -->
      <nav class="p-header-nav js-drawer-open">
        <div class="p-header-nav__container g-nav">
          <ul class="g-nav__list">
            <li class="g-nav__item u-hidden-pc"><a class="g-nav__link js-glowAnime" href="<?php echo home_url(); ?>">ホーム</a></li>
            <li class="g-nav__item"><a class="g-nav__link u-link-hover__nav js-glowAnime" href="<?php echo home_url('news'); ?>">お知らせ</a></li>
            <li class="g-nav__item"><a class="g-nav__link u-link-hover__nav js-glowAnime" href="<?php echo home_url('content'); ?>">事業内容</a></li>
            <li class="g-nav__item"><a class="g-nav__link u-link-hover__nav js-glowAnime" href="<?php echo home_url('works'); ?>">制作実績</a></li>
            <li class="g-nav__item"><a class="g-nav__link u-link-hover__nav js-glowAnime" href="<?php echo home_url('overview'); ?>">企業概要</a></li>
            <li class="g-nav__item"><a class="g-nav__link u-link-hover__nav js-glowAnime" href="<?php echo home_url('blog'); ?>">ブログ</a></li>

            <!-- <li class="g-nav__item p-header-nav__item--contact"><a class="g-nav__link p-header-nav__link--contact" href="#">お問い合わせ</a></li> -->
          </ul>
          <div class="p-header-nav__contact">
            <a class="p-header-nav__btn js-glowAnime" href="<?php echo home_url('contact'); ?>">お問い合わせ</a>
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
                  <?php echo wp_get_attachment_image($fields['main-visual__img'], 'full'); ?>
                </div>
              </div>

            <?php } ?>
          </div>

          <div class="p-top-mv__titlebox">
            <h1 class="p-top-mv__title">アライズカラー　見本サイト</h1>
            <div class="p-top-mv__subtitle">こちらの画像はお客様側で簡単に差し替えが可能です。</div>
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