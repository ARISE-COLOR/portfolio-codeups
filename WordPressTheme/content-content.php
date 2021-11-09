<!-- 事業内容ページの企業理念固定子ページ -->
<li class="l-content-child__item p-content-child__item">
  <a href="<?php the_permalink(); ?>">
    <div class="p-content-child__body">
      <figure class="p-content-child__img">
        <?php the_post_thumbnail(); ?>
      </figure>
      <div class="p-content-child__sentence">
        <h3 class="p-content-child__title"><?php the_title(); ?></h3>
        <p class="p-content-child__excerpt"><?php echo get_flexible_excerpt(120); ?></p>
      </div>
    </div>

  </a>
</li>