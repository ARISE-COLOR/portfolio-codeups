<?php get_header(); ?>

<!-- 記事見出し-->
<article id="top-news" class="l-top-section p-top-news">
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
          $the_query->the_post(); //ループのインクリメントの役割、これがないと無限ループになるので注意
      ?>

          <li class="p-newsBlock__item">
            <div class="p-newsBlock__header">
              <time class="p-newsBlock__date"><?php echo get_the_modified_date('Y.m.d', $post->ID); ?></time>
              <div class="p-newsBlock__category"><?php the_category(); ?></div>
            </div>
            <div class="p-newsBlock__titleblock">
              <a href="<?php the_permalink(); ?>" class="p-newsBlock__title"><?php the_title(); ?></a>
            </div>
          </li>
      <?php
        endwhile;
      else :
        //記事が存在しなかった場合
        echo '<li class="p-newsBlock__item">';
        echo '<div>すみません。ただいま記事を準備中です。<br>少々お待ちください。</div>';
        echo '</li>';
      endif;
      wp_reset_query(); //クエリをリセット
      ?>

    </ul>

    <div class="l-top-btn__center p-top-news__btnblock">
      <a href="<?php echo home_url('news'); ?>" class="c-btn">すべて見る</a>
    </div>

  </div>
</article>

<!-- 事業内容『CONTENT』 -->
<section class="l-top-section p-top-content">
  <div class="p-top-content__inner">
    <h2 class="p-top-content__header p-section-header l-inner js-blurTrigger">
      <span class="p-section-header__title--en">content</span>
      <span class="p-section-header__title--ja">事業内容</span>
    </h2>

    <div class="l-top-section__wrapper p-top-content__wrapper js-fadeInTrigger">
      <ul class="p-top-content__list">

        <?php
        $content_obj = get_page_by_path('content');
        $post = $content_obj;
        setup_postdata($post);
        ?>
        <!-- 事業内容の固定ページ -->
        <li class="p-top-content__item">
          <a href="<?php echo home_url('content'); ?>" class="p-top-content__link">
            <div class="p-top-content__img">
              <?php the_post_thumbnail(); ?>
            </div>
            <div class="p-top-content__textblock">
              <p class="p-top-content__text"><?php the_field('main_title'); ?>ページへ</p>
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
                <div class="p-top-content__img">
                  <?php the_post_thumbnail(); ?>
                </div>
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
  <!-- 背景の斜め線（右下方向） -->
  <div class="p-top-backslash__first"></div>
</section>

<!-- works 制作実績 -->
<section class="l-top-section p-top-works">
  <div class="p-top-works__inner">
    <h2 class="p-top-content__header p-section-header l-inner">
      <span class="p-section-header__title--en">works</span>
      <span class="p-section-header__title--ja">制作実績</span>
    </h2>

    <div class="p-top-works__body">
      <div class="l-top-section__wrapper p-top-works__wrapper l-inner">
        <div class="p-top-works__swiper">

          <div class="swiper-container js-swiper-works">
            <div class="swiper-wrapper">

              <?php
              $query_args = array(
                'post_type' => 'works',
                'posts_per_page' => 3,
              );
              $the_query = new WP_Query($query_args);
              if ($the_query->have_posts()) :
                while ($the_query->have_posts()) : $the_query->the_post();
                  $workgroup = SCF::get('works-img__group');
              ?>
                  <div class="swiper-slide p-top-works__slide">
                    <div class="p-top-works__slide-img" style="background-image: url('<?php echo wp_get_attachment_image_url($workgroup[0]['works__img'], 'large'); ?>');" data-swiper-parallax-x="90%">
                    </div>
                    <div class="p-top-works__slide-heading">
                      <h3 class="p-top-works__slide-title"><?php the_title() ?></h3>
                      <p class="p-top-works__slide-text" data-swiper-parallax-x="30%" data-swiper-parallax-opacity="0">
                        スライド１のテキスト スライド１のテキスト
                      </p>
                    </div>
                  </div>
              <?php
                endwhile;
              else :
                //記事が存在しなかった場合
                echo '<li class="p-works__item">';
                echo '<div>ただいま記事を準備中です。<br>少々お待ちください。</div>';
                echo '</li>';
              endif;
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
  <!-- 背景の斜め線（左下方向） -->
  <div class="p-top-backslash__second"></div>
</section>

<!-- Overview 企業概要 -->
<section class="l-top-section p-top-overview">
  <div class="p-top-overview__inner">
    <h2 class="p-top-overview__header p-section-header l-inner">
      <span class="p-section-header__title--en">overview</span>
      <span class="p-section-header__title--ja">企業概要</span>
    </h2>

    <div class="p-top-overview__body">
      <div class="l-top-section__wrapper p-top-overview__wrapper l-inner">
        <div class="p-top-overview__imgblock">
          <div class="p-top-overview__img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/overview@2x.jpg" alt="事業内容画像1枚目">
          </div>
        </div>

        <div class="p-top-overview__content">
          <h3 class="p-top-overview__title">メインタイトルが入ります</h3>
          <p class="p-top-overview__text">
            テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。
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
<section class="l-top-section p-top-blog">
  <div class="p-top-blog__inner l-inner">
    <h2 class="p-top-blog__header p-section-header">
      <span class="p-section-header__title--en">blog</span>
      <span class="p-section-header__title--ja">ブログ</span>
    </h2>

    <div class="l-top-section__wrapper p-top-blog__body">
      <ul class="p-top-blog__list p-blog-cards">

        <li class="p-blog-cards__item p-blog-card">
          <a class="p-blog-card__link" href="#">
            <div class="p-blog-card__img">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/blog1@2x.jpg" alt="blogサムネイル画像">
            </div>
            <div class="p-blog-card__wrapper">
              <h3 class="p-blog-card__title">タイトルが入ります。タイトルが入ります。</h3>
              <p class="p-blog-card__text">説明文が入ります。説明文が入ります。説明文が入ります。</p>

              <div class="p-blog-card__footer">
                <div class="p-blog-card__category">カテゴリ</div>
                <time class="p-blog-card__date">2021.07.20</time>
              </div>
            </div>
            <div class="p-blog-card__mark">
              <p class="p-blog-card__new">new</p>
            </div>
          </a>
        </li>

        <li class="p-blog-cards__item p-blog-card">
          <a class="p-blog-card__link" href="#">
            <div class="p-blog-card__img">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/blog2@2x.jpg" alt="blogサムネイル画像">
            </div>
            <div class="p-blog-card__wrapper">
              <h3 class="p-blog-card__title">タイトルが入ります。タイトルが入ります。</h3>
              <p class="p-blog-card__text">説明文が入ります。説明文が入ります。説明文が入ります。</p>

              <div class="p-blog-card__footer">
                <div class="p-blog-card__category">カテゴリ</div>
                <time class="p-blog-card__date">2021.07.19</time>
              </div>
            </div>
          </a>
        </li>

        <li class="p-blog-cards__item p-blog-card">
          <a class="p-blog-card__link" href="#">
            <div class="p-blog-card__img">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/blog3@2x.jpg" alt="blogサムネイル画像">
            </div>
            <div class="p-blog-card__wrapper">
              <h3 class="p-blog-card__title">タイトルが入ります。タイトルが入ります。</h3>
              <p class="p-blog-card__text">説明文が入ります。説明文が入ります。説明文が入ります。</p>

              <div class="p-blog-card__footer">
                <div class="p-blog-card__category">カテゴリ</div>
                <time class="p-blog-card__date">2021.07.18</time>
              </div>
            </div>
          </a>
        </li>

      </ul>
      <div class="l-top-btn__center p-top-blog__btnblock">
        <a href="#" class="c-btn">詳しく見る</a>
      </div>
    </div>
  </div>
</section>

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
      <a href="<?php echo home_url('contact'); ?>" class="c-btn__effect--neon"><span>詳しく見る</span></a>
    </div>
  </div>
</section>

</main>
<?php get_footer(); ?>