<!-- ブログカード出力 -->
<?php
$terms = get_the_terms($post->ID, 'subject'); //ターム一覧抽出
?>

<li class="p-blog-cards__item p-blog-card">
  <a class="p-blog-card__link" href="<?php the_permalink(); ?>">
    <figure class="p-blog-card__img">
      <?php echo get_card_image("blog"); ?>
    </figure>
    <div class="p-blog-card__body">
      <h3 class="p-blog-card__title"><?php the_title(); ?></h3>
      <p class="p-blog-card__text"><?php echo get_flexible_excerpt(60); ?></p>
    </div>
    <div class="p-blog-card__info">
      <?php if ($terms) : ?>
        <?php if ($terms[1]) : ?>
          <div class="p-blog-card__category"><span>複数カテゴリ</span></div>
        <?php else : ?>
          <div class="p-blog-card__category"><span><?php echo esc_html($terms[0]->name); ?></span></div>
        <?php endif; ?>
      <?php else : ?>
        <div class="p-blog-card__category"><span>未分類</span></div>
      <?php endif; ?>
      <time class="p-blog-card__date" datetime="<?php the_time('Y-m-d') ?>"><?php the_time('Y.m.d') ?></time>
    </div>

    <!-- 更新日から７日以内かつ、最新３件のみNEWマークを表示（１ページ目のみ） -->
    <?php
    $days = 7;
    $limit = 3;
    $current_posts = $the_query->current_post; //現在の表示件数（何件目か）
    if (newMark_condition_numTime($days, $limit, $current_posts) && $paged == 1):
    ?>
      <div class="p-blog-card__mark">
        <span>new</span>
      </div>
    <?php
    endif;
    ?>

  </a>
</li>