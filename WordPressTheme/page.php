<?php get_header(); ?>
<article class="l-page p-page">
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
</article>

<!-- お問い合わせセクション表示 -->
<?php get_template_part('content-contact'); ?>

<?php get_footer(); ?>