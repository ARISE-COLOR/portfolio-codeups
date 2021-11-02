<?php get_header(); ?>
<section class="l-contact p-contact">
  <div class="p-contact__inner l-inner">
    <div class="p-contact__wrapper">
      <?php
      if (have_posts()) :
        while (have_posts()) : the_post();
          the_content();
        endwhile;
      endif;
      ?>
    </div>
  </div>
</section>



<?php get_footer(); ?>