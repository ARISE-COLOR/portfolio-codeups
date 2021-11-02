<?php get_header(); ?>
<!-- 固定ページの内容を表示（カスタムフィールド） -->
<section class="l-content p-content">
  <div class="p-content__inner l-inner">
    <?php if (get_field('main_title')) : ?>
      <h3 class="p-content__title"><?php the_field('main_title'); ?></h3>
    <?php endif; ?>
    <?php if (get_field('main_text')) : ?>
      <div class="p-content__textblock">
        <p class="p-content__text"><?php the_field('main_text'); ?></p>
      </div>
    <?php endif; ?>
</section>
</div>

<!-- 子ページの情報を出力 -->
<section class="l-content-child p-content-child">
  <div class="p-content-child__inner l-inner">
    <ul class="p-content-child__list">

      <?php
      $content_pages = get_child_pages();
      if ($content_pages->have_posts()) :
        while ($content_pages->have_posts()) : $content_pages->the_post();
          get_template_part('content-content');
        endwhile;
        wp_reset_postdata();
      endif;
      ?>

    </ul>
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
      <a href="/contact/" class="c-btn">お問い合わせへ</a>
    </div>
  </div>
</section>


<?php get_footer(); ?>