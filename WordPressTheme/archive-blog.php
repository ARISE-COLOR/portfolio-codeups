<?php get_header(); ?>
<!-- カテゴリリスト -->
<section class="l-category p-category">
  <div class="p-category__inner l-inner">
    <ul class="p-category__list">

      <li class="p-category__item">
        <a class="p-category__link p-category__link--all current" href="<?php echo home_url('blog'); ?>">
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
</section>

<!-- 制作実績の記事一覧表示 -->
<section class="l-works p-works">
  <div class="p-works__inner l-inner">
    <ul class="p-works__list">
      <?php
      $paged = get_query_var('paged')? get_query_var('paged') : 1;
      $args = array(
        'post_type' => 'blog', // 投稿タイプを指定
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
<div class="l-pagenavi p-pagenavi">
<?php
  if(function_exists('wp_pagenavi')):
    wp_pagenavi(array('query'=>$the_query)); 
  endif;
  ?>
</div>
<?php wp_reset_postdata(); ?>

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