<?php get_header(); ?>
<!-- お問い合わせページ -->
<div class="l-contact p-contact">
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
</div>

<?php get_footer(); ?>