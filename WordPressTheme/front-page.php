<?php get_header(); ?>

<!-- 記事見出し-->
<section id="top-news" class="l-top-section p-top-news js-fadeInTrigger">
  <h2 class="p-top-content__header p-section-header l-inner">
    <span class="p-section-header__title--en">news</span>
    <span class="p-section-header__title--ja">お知らせ</span>
  </h2>
  <div class="p-top-news__inner l-inner p-newsBlock">
    <ul class="p-newsBlock__list">

      <?php
      $query_args = array(
        'post_status' => 'publish',
        'post_type' => 'post',
        'order' => 'DESC',
        'posts_per_page' => 5
      );
      $the_query = new WP_Query($query_args);

      if ($the_query->have_posts()) :
        //記事が存在した場合
        while ($the_query->have_posts()) :
          $the_query->the_post();
          get_template_part('content-archive');
        endwhile;
      else :
        //記事が存在しなかった場合
      ?>
        <li class="p-newsBlock__item">
          <p>ただいま記事を準備中です。<br>少々お待ちください。</p>
        </li>
      <?php
      endif;
      wp_reset_query(); //クエリをリセット
      ?>

    </ul>

    <div class="l-top-btn__center p-top-news__btnblock">
      <a href="<?php echo home_url('news'); ?>" class="c-btn">すべて見る</a>
    </div>

  </div>
</section>

<!-- 事業内容『CONTENT』 -->
<section class="l-top-section p-top-content js-fadeInTrigger">
  <!-- 背景の斜め線（右下方向） -->
  <div class="p-top-backslash__first js-fadeInTrigger"></div>

  <div class="p-top-content__inner">
    <h2 class="p-top-content__header p-section-header l-inner">
      <span class="p-section-header__title--en">content</span>
      <span class="p-section-header__title--ja">事業内容（サンプル）</span>
    </h2>

    <div class="p-top-content__wrapper">
      <ul class="p-top-content__list">

        <?php
        $content_obj = get_page_by_path('content');
        $post = $content_obj;
        setup_postdata($post);
        ?>
        <!-- 事業内容の固定ページ -->
        <li class="p-top-content__item">
          <a href="<?php echo home_url('content'); ?>" class="p-top-content__link">
            <figure class="p-top-content__img">
              <?php the_post_thumbnail(); ?>
            </figure>
            <div class="p-top-content__textblock">
              <p class="p-top-content__text"><?php esc_html(the_field('main_title')); ?>ページへ</p>
            </div>
          </a>
        </li>
        <?php wp_reset_postdata(); ?>

        <!-- 事業内容の子ページ３件を読み込み -->
        <?php
        $content_pages = get_child_pages(3, $content_obj->ID);
        if ($content_pages->have_posts()) :
          while ($content_pages->have_posts()) : $content_pages->the_post();
        ?>

            <li class="p-top-content__item">
              <a href="<?php the_permalink(); ?>" class="p-top-content__link">
                <figure class="p-top-content__img">
                  <?php the_post_thumbnail(); ?>
                </figure>
                <div class="p-top-content__textblock">
                  <p class="p-top-content__text"><?php the_title(); ?>へ</p>
                </div>
              </a>
            </li>

        <?php
          endwhile;
          wp_reset_postdata();
        endif;
        ?>

      </ul>
    </div>
  </div>
</section>

<!-- works 制作実績 -->
<section class="l-top-section p-top-works js-fadeInTrigger">
  <!-- 背景の斜め線（左下方向） -->
  <div class="p-top-backslash__second js-fadeInTrigger"></div>

  <div class="p-top-works__inner">
    <h2 class="p-top-content__header p-section-header l-inner">
      <span class="p-section-header__title--en p-section-header__title--right">works</span>
      <span class="p-section-header__title--ja">制作実績(サンプル）</span>
    </h2>

    <div class="p-top-works__body">
      <div class="l-top-section__wrapper p-top-works__wrapper l-inner">
        <div class="p-top-works__swiper">

          <div class="swiper-container js-swiper-works">
            <div class="swiper-wrapper">

              <?php
              $query_args = array(
                'post_type' => 'works',
                'post_status' => 'publish',
                'posts_per_page' => 3,
              );
              $the_query = new WP_Query($query_args);
              if ($the_query->have_posts()) :
                while ($the_query->have_posts()) : $the_query->the_post();
                  $workgroup = SCF::get('works-img__group');
              ?>
                  <div class="swiper-slide p-top-works__slide">
                    <figure class="p-top-works__slide-img" style="background-image: url('<?php echo esc_html(wp_get_attachment_image_url($workgroup[0]['works__img'], 'full')); ?>');" data-swiper-parallax-x="90%">
                    </figure>
                    <div class="p-top-works__slide-heading">
                      <h4 class="p-top-works__slide-title"><?php the_title() ?></h4>
                      <p class="p-top-works__slide-text" data-swiper-parallax-x="30%" data-swiper-parallax-opacity="0">
                        <?php echo get_flexible_excerpt(40); ?>
                      </p>
                    </div>
                  </div>
                <?php
                endwhile;
              else : ?>

                <!-- 記事が存在しなかった場合 -->
                <div class="swiper-slide p-top-works__slide">
                  <figure class="p-top-works__slide-img" style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/works1@2x.jpg')" data-swiper-parallax-x="90%">
                  </figure>
                  <div class="p-top-works__slide-heading">
                    <h4 class="p-top-works__slide-title">只今記事を準備中です。</h3>
                    <p class="p-top-works__slide-text" data-swiper-parallax-x="30%" data-swiper-parallax-opacity="0">
                      公開まで、今しばらくお待ちください。
                    </p>
                  </div>
                </div>
              <?php endif;
              wp_reset_query(); //クエリをリセット
              ?>

            </div>
          </div>
          <div class="p-top-works__pagenation-wrapper">
            <div class="p-top-works__swiper-pagination"></div>
          </div>
        </div>

        <div class="p-top-works__content">
          <h3 class="p-top-works__title">最新投稿３件がスライダー表示されています</h3>
          <p class="p-top-works__text">
            制作実績はカスタム投稿タイプにて記事を作成しております。
            記事の内容はsmart custom fieldsにて繰り返しフィールドを使用することで、お客様側でもスライダー画像、テキスト内容を簡単に編集・変更・追加できるように作成しました。
          </p>
          <div class="l-top-btn__left p-top-works__btnblock">
            <a href="<?php echo home_url('works'); ?>" class="c-btn">詳しく見る</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Overview 企業概要 -->
<section class="l-top-section p-top-overview js-fadeInTrigger">
  <div class="p-top-overview__inner">
    <h2 class="p-top-overview__header p-section-header l-inner">
      <span class="p-section-header__title--en">overview</span>
      <span class="p-section-header__title--ja">企業概要（サンプル）</span>
    </h2>

    <div class="p-top-overview__body">
      <div class="l-top-section__wrapper p-top-overview__wrapper l-inner">
        <div class="p-top-overview__imgblock">
          <figure class="p-top-overview__img">
            <img class="rellax u-hidden-tab" src="<?php echo esc_url(get_the_post_thumbnail_url('27')); ?>">
            <img class="u-show-tab" src="<?php echo esc_url(get_the_post_thumbnail_url('27')); ?>">
          </figure>
        </div>

        <div class="p-top-overview__content">
          <h3 class="p-top-overview__title">固定ページのサムネイル画像を表示</h3>
          <p class="p-top-overview__text">
            画像比率の指定は、aspect-ratioですとまだSafariでの対応開始から日が浅いため、padding-topにて指定しました。<br>
            ページ内はSmart Custom Fieldsを使用することで、項目の追加・編集等を容易にし、グーグルマップもお客様側で変更できるように設定しております。
          </p>
          <div class="l-top-btn__left p-top-overview__btnblock">
            <a href="<?php echo home_url('overview'); ?>" class="c-btn">詳しく見る</a>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<!-- Blog ブログ -->
<section class="l-top-section p-top-blog js-fadeInTrigger">
  <div class="p-top-blog__inner l-inner">
    <h2 class="p-top-blog__header p-section-header">
      <span class="p-section-header__title--en p-section-header__title--right">blog</span>
      <span class="p-section-header__title--ja">ブログ</span>
    </h2>

    <div class="l-top-section__wrapper p-top-blog__body">
      <ul class="p-top-blog__list p-blog-cards">

        <?php
        $paged = 1;
        $args = array(
          'post_type' => 'blog', // 投稿タイプを指定
          'post_status' => 'publish',
          'posts_per_page' => 3, // 表示する記事数
        );
        $the_query = new WP_Query($args);
        if ($the_query->have_posts()) :
          while ($the_query->have_posts()) : $the_query->the_post();
            include 'content-archive-blog.php';
          endwhile;
        endif;
        wp_reset_query(); //クエリをリセット
        ?>

      </ul>
      <div class="l-top-btn__center p-top-blog__btnblock">
        <a href="<?php echo home_url('blog'); ?>" class="c-btn">詳しく見る</a>
      </div>
    </div>
  </div>
</section>

<!-- お問い合わせセクション表示 -->
<?php get_template_part('content-contact'); ?>


<?php get_footer(); ?>