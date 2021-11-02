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
            <li class="g-nav__item"><a class="g-nav__link u-link-hover__nav js-glowAnime" href="#">制作実績</a></li>
            <li class="g-nav__item"><a class="g-nav__link u-link-hover__nav js-glowAnime" href="#">企業概要</a></li>
            <li class="g-nav__item"><a class="g-nav__link u-link-hover__nav js-glowAnime" href="#">ブログ</a></li>

            <!-- <li class="g-nav__item p-header-nav__item--contact"><a class="g-nav__link p-header-nav__link--contact" href="#">お問い合わせ</a></li> -->
          </ul>
          <div class="p-header-nav__contact">
            <a class="p-header-nav__btn js-glowAnime" href="#">お問い合わせ</a>
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
<section class="p-mv-para">
        <img src="<?php echo get_template_directory_uri() ?>/assets/img/bg.jpg" id="bg" alt="">
        <img src="<?php echo get_template_directory_uri() ?>/assets/img/moon.png" id="moon" alt="">
        <img src="<?php echo get_template_directory_uri() ?>/assets/img/mountain.png" id="mountain" alt="">
        <img src="<?php echo get_template_directory_uri() ?>/assets/img/road.png" id="road" alt="">
        <h1 id = "mv__title" class="c-mv__title">ARISE-COLOR</h1>
      </section>
      <script type="text/javascript">
        let bg = document.getElementById("bg");
        let moon = document.getElementById("moon");
        let mountain = document.getElementById("mountain");
        let road = document.getElementById("road");
        let text = document.getElementById("text");

        window.addEventListener('scroll', function(){
          var value = window.scrollY;

          bg.style.top = value * 0.5 + 'px';
          moon.style.top = value * 0.5 + 'px';
          moon.style.left = value * 0.5 + 'px';
          mountain.style.top = -value * 0.15 + 'px';
          road.style.top = value * 0.15 + 'px';
          mv__title.style.top = value * 0.5 + 'px';
        })
      </script>
 
<!-- contact お問い合わせ -->
<section class="l-top-section p-contact-section">
  <div class="p-contact-section__inner l-inner">
    <h2 class="p-contact-section__header p-section-header">
      <span class="p-section-header__title--en">contact</span>
      <span class="p-section-header__title--ja">お問い合わせ</span>
    </h2>

    <div class="p-contact-section__textblock">
      <p class="p-contact-section__text">テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</p>
    </div>

    <div class="l-top-btn__center p-contact-section__btnblock">
    <a href="<?php echo home_url('contact'); ?>" class="c-btn__effect--neon"><span>詳しく見る</span></a>
    </div>
  </div>
</section>
</main>
<?php get_footer(); ?>