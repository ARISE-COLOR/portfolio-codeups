<?php get_header(); ?>

<div class="l-notfound p-notfound">
  <div class="p-notfound__inner l-inner">
    <div class="p-notfound__wrapper">
      <p>お探しのページは見つかりませんでした。</p>
      <div class="l-top-btn__center p-notfound__btnblock">
        <a href="<?php echo esc_url(home_url()); ?>" class="c-btn"><span>トップへ戻る</span></a>
      </div>
    </div>
  </div>
</div>

  <?php get_footer(); ?>