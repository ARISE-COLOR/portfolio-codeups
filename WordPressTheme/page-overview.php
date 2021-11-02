<?php get_header(); ?>

<section class="l-overview p-overview">
  <div class="p-overview__inner l-inner">

    <!-- 繰り返しフィールド読み込み -->
    <?php
    $overviewgroup = SCF::get('overview__group');
    foreach ($overviewgroup as $fields) {
    ?>

      <dl class="p-overview__list">
        <dt class="p-overview__title"><?php echo $fields['overview__title']; ?></dt>
        <dd class="p-overview__text"><?php echo $fields['overview__text']; ?></dd>
      </dl>

    <?php } ?>
  </div>
</section>

<section class="l-google-map p-google-map">
  <div class="p-google-map__inner">
    <div class="p-google-map__wrapper">
      <?php the_field('overview__map'); ?>
    </div>
  </div>
</section>

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
      <a href="/contact/" class="c-btn__effect--neon"><span>お問い合わせへ</span></a>
    </div>
  </div>
</section>


<?php get_footer(); ?>