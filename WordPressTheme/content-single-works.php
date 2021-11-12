<section class="p-works-header">
  <h1 class="p-works-header__title">
    <?php the_title(); ?>
  </h1>
</section>


<!-- スライダー -->
<?php $imggroup = SCF::get('works-img__group'); ?>
<div class="l-works-slider p-works-slider">
  <div class="p-works-slider__inner">
    <div class="swiper-container p-works-slider__container--main js-works-slider">
      <div class="swiper-wrapper p-works-slider__wrapper--main">

        <!-- 繰り返しフィールド読み込み -->
        <?php foreach ($imggroup as $fields) { ?>

          <figure class="swiper-slide p-works-slider__img--main">
            <?php 
            if(esc_html($fields['works__img'])):
            echo wp_get_attachment_image(esc_html($fields['works__img']), 'full');
            else:
              echo '<img src="' . esc_url(get_template_directory_uri()) . '/assets/img/noimg.png" />';
            endif;
            ?>
          </figure>

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

          <figure class="swiper-slide  p-works-slider__img--thumbnail">
            <?php echo wp_get_attachment_image(esc_html($fields['works__img']), 'full'); ?>
          </figure>

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
    <h2 class="p-works-textarea__title">
      <?php echo esc_html(($fields['works__title'])); ?>
    </h2>
    <p class="p-works-textarea__text">
      <?php echo esc_html(($fields['works__text'])); ?>
    </p>

  <?php } ?>
</section>

<!-- 記事用のページネーション （新しい記事へ　記事一覧　過去の記事へ-->
<?php get_template_part('part-PrevNext-pagination'); ?>