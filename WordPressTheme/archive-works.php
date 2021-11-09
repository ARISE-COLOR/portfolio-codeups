<?php get_header(); ?>
<!-- カテゴリリスト -->
<div class="l-category p-category">
  <div class="p-category__inner l-inner">
    <ul class="p-category__list">

      <li class="p-category__item">
        <a class="p-category__link p-category__link--all current" href="<?php echo esc_url(home_url('works')); ?>">
          <span>一覧</span>
        </a>
      </li>

      <!-- タクソノミーに紐づくターム一覧を取得＆選択されているタームには.current-catクラスが付与（色分け不要の場合はこの１行） -->
      <?php //wp_list_categories('title_li=&taxonomy=genre'); ?>

      <!-- 色分けをするため、一つずつ個別に抽出 -->
      <?php
      $terms = get_terms('genre');
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
<section class="l-works p-works">
  <div class="p-works__inner l-inner">
    <ul class="p-works__list">
      <?php
      $paged = get_query_var('paged')? get_query_var('paged') : 1;
      $args = array(
        'post_type' => 'works', // 投稿タイプを指定
        'post_status' => 'publish', 
        'posts_per_page' => 4, // 表示する記事数
        'paged'=>$paged,
      );
      $the_query = new WP_Query($args);
      if ($the_query->have_posts()) :
        while ($the_query->have_posts()) : $the_query->the_post();
          get_template_part('content-archive-works');
        endwhile;
      endif;
      
      ?>
    </ul>
  </div>
</section>

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