<?php get_header(); ?>
<article class="l-single p-single">
  <div class="p-single__inner l-inner">
    <div class="p-single__content">
      <?php
      if (have_posts()) :
        while (have_posts()) : the_post(); ?>
          <h1><?php the_title(); ?></h1>
      <?php the_content();
        endwhile;
      endif;
      ?>
    </div>
  </div>
</article>

<!-- 記事用のページネーション （新しい記事へ　記事一覧　過去の記事へ-->
<?php get_template_part('part-PrevNext-pagination'); ?>

<!-- お問い合わせセクション表示 -->
<?php get_template_part('content-contact'); ?>

<?php get_footer(); ?>