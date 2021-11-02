  <li class="l-content-child__item p-content-child__item">
    <div class="p-content-child__img">
      <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
    </div>
    <div class="p-content-child__sentence">
      <a href="<?php the_permalink(); ?>">
        <h4 class="p-content-child__title"><?php the_title(); ?></h4>
        <p class="p-content-child__excerpt"><?php echo get_flexible_excerpt(120); ?></p>
      </a>
    </div>
  </li>