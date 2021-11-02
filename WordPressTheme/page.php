<?php get_header(); ?>
<div class="l-page p-page">
  <div class="p-page__inner l-inner">
    <div class="p-page__content">
      <?php
      if (have_posts()) :
        while (have_posts()) : the_post();
          the_content();
        endwhile;
      endif;
      ?>
    </div>
  </div>
</div>
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


<?php get_footer(); ?>