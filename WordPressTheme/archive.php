<?php get_header(); ?>

<article class="l-archive p-archive">
  <div class="p-archive__inner l-inner p-newsBlock">
    <ul class="p-newsBlock__list">

      <?php
      $paged = get_query_var('paged') ? get_query_var('paged') : 1;  //pagedに渡す変数
      $args = array(
        'post_type' => 'post', // 投稿タイプを指定
        'posts_per_page' => 10, // 表示する記事数
        'paged' => $paged,
      );
      $the_query = new WP_Query($args);
      if ($the_query->have_posts()) :
        while ($the_query->have_posts()) : $the_query->the_post();
          get_template_part('content-archive');
        endwhile;
      endif;

if (function_exists('wp_pagenavi')) :
  wp_pagenavi(array('query' => $the_query));
endif;
wp_reset_postdata();
?>

    </ul>
  </div>
</article>

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