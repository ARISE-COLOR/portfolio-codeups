<?php get_header(); ?>

<?php
$this_category_obj = get_queried_object(); //現在のオブジェクト情報取得
$this_category_id = $this_category_obj->cat_ID; //現在のカテゴリーID取得
?>

<article class="l-archive p-archive">
  <div class="p-archive__inner l-inner p-newsBlock">
    <ul class="p-newsBlock__list">

      <?php
      $paged = get_query_var('paged') ? get_query_var('paged') : 1;
      $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'cat' => $this_category_id,
        'posts_per_page' => 10,
        'paged' => $paged,
      );
      $the_query = new WP_Query($args);
      if ($the_query->have_posts()) :
        while ($the_query->have_posts()) : $the_query->the_post();
          get_template_part('content-archive');
        endwhile;
      endif;
      ?>

    </ul>
  </div>
</article>

<!-- ページネーション -->
<!-- WP-PageNaviを使った場合の記述 -->
<!-- <div class="l-pagenavi p-pagenavi"> -->
<?php
  // if(function_exists('wp_pagenavi')):
  //   wp_pagenavi(array('query'=>$the_query)); 
  // endif;
  ?>
<!-- </div> -->

<!-- ページネーション -->
<!-- the_posts_paginationを使った場合の記述 -->
<?php original_pagenation($the_query->max_num_pages); ?>

<?php wp_reset_postdata(); ?>

<!-- お問い合わせセクション表示 -->
<?php get_template_part('content-contact'); ?>

<?php get_footer(); ?>