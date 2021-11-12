<?php get_header(); ?>
<!-- カテゴリリスト -->

<div class="l-category p-category">
  <div class="p-category__inner l-inner">
    <ul class="p-category__list">

      <li class="p-category__item">
        <a class="p-category__link p-category__link--all" href="<?php echo home_url('works'); ?>">
          ALL
        </a>
      </li>

      <!-- タクソノミーに紐づくターム一覧を取得＆選択されているタームには.current-catクラスが付与 -->
      <!-- 各タームごとに色分けが不要な場合は下記１行で表示できる -->
      <?php //wp_list_categories('title_li=&taxonomy=genre'); 
      ?>

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


<article class="l-works p-works">
  <div class="p-works__inner l-inner">
    <ul class="p-works__list">

      <?php
      $terms_obj = get_queried_object(); //現在のタクソノミー情報取得
      $terms_slug = $terms_obj->slug; //現在のタクソノミーslug取得
      $paged = get_query_var('paged') ? get_query_var('paged') : 1;
      $query_args = array(
        'post_type' => 'works',
        'post_status' => 'publish', 
        'posts_per_page' => 4,
        'paged' => $paged,
        'tax_query' => array(
          array(
            'taxonomy' => 'genre',
            'field' => 'slug',
            'terms' => $terms_slug,
          ),
        ),
      );
      $the_query = new WP_Query($query_args);
      if ($the_query->have_posts()) :
        while ($the_query->have_posts()) : $the_query->the_post();
          get_template_part('content-archive-works');
        endwhile;
      else :
        ?>
        <!-- 記事が存在しなかった場合 -->
        <li class="p-works__item">
          <div>ただいま記事を準備中です。<br>少々お待ちください。</div>
        </li>
      <?php
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