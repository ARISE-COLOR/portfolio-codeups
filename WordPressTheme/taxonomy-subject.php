<?php get_header(); ?>
<!-- カテゴリリスト -->

<div class="l-category p-category">
  <div class="p-category__inner l-inner">
    <ul class="p-category__list">

      <li class="p-category__item">
        <a class="p-category__link p-category__link--all" href="<?php echo home_url('blog'); ?>">
          一覧
        </a>
      </li>

      <!-- タクソノミーに紐づくターム一覧を取得＆選択されているタームには.current-catクラスが付与 -->
      <!-- 各タームごとに色分けが不要な場合は下記１行で表示できる -->
      <?php //wp_list_categories('title_li=&taxonomy=genre'); 
      ?>

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
      $terms_obj = get_queried_object(); //現在のタクソノミー情報取得
      $terms_slug = $terms_obj->slug; //現在のタクソノミーslug取得
      $paged = get_query_var('paged')? get_query_var('paged') : 1;
      $args = array(
        'post_type' => 'blog', // 投稿タイプを指定
        'post_status' => 'publish', 
        'posts_per_page' => 6, // 表示する記事数
        'paged'=>$paged,
        'tax_query' => array(
          array(
            'taxonomy' => 'subject',
            'field' => 'slug',
            'terms' => $terms_slug,
          ),
        ),
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