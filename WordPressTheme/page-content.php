<?php get_header(); ?>
<!-- 固定ページの内容を表示（カスタムフィールド） -->
<section class="l-content p-content">
  <div class="p-content__inner l-inner">
    <?php if (get_field('main_title')) : ?>
      <h2 class="p-content__title"><?php esc_html(the_field('main_title')); ?></h2>
    <?php endif; ?>
    <?php if (get_field('main_text')) : ?>
      <div class="p-content__textblock">
        <p class="p-content__text"><?php esc_html(the_field('main_text')); ?></p>
      </div>
    <?php endif; ?>
  </div>
</section>

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

<!-- お問い合わせセクション表示 -->
<?php get_template_part('content-contact'); ?>

<?php get_footer(); ?>