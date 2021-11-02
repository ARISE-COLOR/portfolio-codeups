<?php get_header(); ?>
<!-- カテゴリリスト -->
<section class="l-category p-category">
  <div class="p-category__inner l-inner">
    <ul class="p-category__list">

      <?php
      $terms = get_terms('genre');
      var_dump($terms);
      foreach($terms as $term):
        include 'content-category.php';
      endforeach;
      ?>

    </ul>
  </div>
</section>


<section class="l-works p-works">
  <div class="p-works__inner l-inner">
    <div class="p-works__wrapper">

      <ul class="p-works__list">

        <li class="p-works__item">
          <a href="" class="p-works__link">
            <div class="p-works__img">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/works1@2x.jpg" alt="">
              <div class="p-works__category">カテゴリ１</div>
            </div>
            <h3 class="p-works__title">test</h3>
          </a>
        </li>

        <li>
        <a href="" class="p-works__link">
            <div class="p-works__img">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/works1@2x.jpg" alt="">
              <div class="p-works__category">カテゴリ１</div>
            </div>
            <h3 class="p-works__title">test</h3>
          </a>
        </li>

        <li>
        <a href="" class="p-works__link">
            <div class="p-works__img">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/works1@2x.jpg" alt="">
              <div class="p-works__category">カテゴリ１</div>
            </div>
            <h3 class="p-works__title">test</h3>
          </a>
        </li>

        <li>
        <a href="" class="p-works__link">
            <div class="p-works__img">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/works1@2x.jpg" alt="">
              <div class="p-works__category">カテゴリ１</div>
            </div>
            <h3 class="p-works__title">test</h3>
          </a>
        </li>

        <li>
        <a href="" class="p-works__link">
            <div class="p-works__img">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/works1@2x.jpg" alt="">
              <div class="p-works__category">カテゴリ１</div>
            </div>
            <h3 class="p-works__title">test</h3>
          </a>
        </li>

      </ul>

    </div>

      <div class="p-works__pagenation">

      </div>

  </div>
</section>



<?php get_footer(); ?>