<?php get_header(); ?>

<!-- カテゴリリスト表示 -->
<div class="l-category p-category">
  <div class="p-category__inner l-inner">
    <ul class="p-category__list">

      <li class="p-category__item">
        <a class="p-category__link p-category__link--all current" href="<?php echo esc_url(home_url('blog')); ?>">
          <span>一覧</span>
        </a>
      </li>
      <!-- タクソノミーに紐づくターム一覧を取得＆選択されているタームには.current-catクラスが付与 -->
      <?php //wp_list_categories('title_li=&taxonomy=genre'); ?>
      <?php
      $terms = get_terms('subject');
      if ($terms) {
        foreach ($terms as $term) :
          include 'content-category.php';
        endforeach;
      }
      ?>
    </ul>
  </div>
</div>

<!-- 制作実績の記事一覧表示 -->
<article class="l-blog p-blog">
  <div class="p-blog__inner l-inner">
    <ul class="p-blog__list  p-blog-cards">
      <?php
      $paged = get_query_var('paged') ? get_query_var('paged') : 1;
      $args = array(
        'post_type' => 'blog',
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'paged' => $paged,
      );
      $the_query = new WP_Query($args);
      if ($the_query->have_posts()) :
        while ($the_query->have_posts()) : $the_query->the_post();
          include 'content-archive-blog.php';
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