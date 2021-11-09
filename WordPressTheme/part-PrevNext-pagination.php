<!-- 記事用のページネーション （新しい記事へ　記事一覧　過去の記事へ-->
<div class="l-PrevNext-pagination p-PrevNext-pagination">
  <div class="p-PrevNext-pagination__inner">
    <?php
    // 新しい記事に行くのがget_next_post
    $next_post = get_next_post();
    // 古い記事に行くのがget_previous_post
    $prev_post = get_previous_post();
    if ($next_post) :
    ?>
      <!-- PREVが新しい記事 -->
      <div class="p-PrevNext-pagination__prev">
        <a class="p-PrevNext-pagination__link" href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">新しい記事へ</a>
      </div>
    <?php
    endif;
    ?>
    <!-- 一覧を表示 -->
    <div class="p-PrevNext-pagination__archive">
      <a class="p-PrevNext-pagination__link" href="<?php echo esc_url(get_post_type_archive_link($post->post_type)); ?>">記事一覧</a>
    </div>
    <?php
    if ($prev_post) :
    ?>
      <!-- NEXTが古い記事 -->
      <div class="p-PrevNext-pagination__next">
        <a class="p-PrevNext-pagination__link" href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>">過去の記事へ</a>
      </div>
    <?php
    endif;
    ?>
  </div>
</div>