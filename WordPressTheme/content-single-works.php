<section class="p-works-header">
  <h2 class="p-works-header__title">
    <?php the_title(); ?>様　制作実績
  </h2>
</section>



<!-- スライダー -->
<div class="l-works-slider p-works-slider">
  <div class="p-works-slider__inner">
    <div class="swiper-container p-works-slider__container--main js-works-slider">
      <div class="swiper-wrapper p-works-slider__wrapper--main">

        <!-- 繰り返しフィールド読み込み -->
        <?php
        $imggroup = SCF::get('works-img__group');
        foreach ($imggroup as $fields) {
        ?>

          <div class="swiper-slide p-works-slider__img--main">
            <?php echo wp_get_attachment_image($fields['works__img'], 'full'); ?>
          </div>

        <?php } ?>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>

    <div class="swiper-container p-works-slider__container--thumbnail js-works-thumbnail">
      <div class="swiper-wrapper  p-works-slider__wrapper--thumbnail">

        <!-- 繰り返しフィールド読み込み -->
        <?php
        $imggroup = SCF::get('works-img__group');
        foreach ($imggroup as $fields) {
        ?>

          <div class="swiper-slide  p-works-slider__img--thumbnail">
            <?php echo wp_get_attachment_image($fields['works__img'], 'full'); ?>
          </div>

        <?php } ?>
      </div>
    </div>
  </div>

</div>

<!-- テキストコンテンツ -->
<section class="l-works-textarea p-works-textarea">
  <?php
  $textgroup = SCF::get('works-text__group');
  foreach ($textgroup as $fields) {
  ?>
    <h3 class="p-works-textarea__title">
      <?php echo ($fields['works__title']); ?>
      </h4>
      <p class="p-works-textarea__text">
        <?php echo ($fields['works__text']); ?>
      </p>

    <?php } ?>


</section>


<div class="l-works-moreButton p-works-moreButton">
  <div class="p-works-moreButton__inner">
  <?php
  // 新しい記事に行くのがget_next_post
  $next_post = get_next_post();
  // 古い記事に行くのがget_previous_post
  $prev_post = get_previous_post();
  if ($next_post) :
  ?>
    <!-- PREVが新しい記事 -->
    <div class="p-works-moreButton__prev">
      <a class="p-works-moreButton__link" href="<?php echo get_permalink($next_post->ID); ?>">PREV</a>
    </div>
  <?php
  endif;
  ?>
  <div class="p-works-moreButton__archive">
    <a class="p-works-moreButton__link" href="<?php echo home_url('works'); ?>">制作実績 一覧</a>
  </div>
  <?php
  if ($prev_post) :
  ?>
    <!-- NEXTが古い記事 -->
    <div class="p-works-moreButton__next">
      <a class="p-works-moreButton__link" href="<?php echo get_permalink($prev_post->ID); ?>">NEXT</a>
    </div>
  <?php
  endif;
  ?>
  </div>
 
</div>