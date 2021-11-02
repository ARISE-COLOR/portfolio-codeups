<?php get_header(); ?>

<article class="l-single-works p-single-works">
  <div class="p-single-works l-inner">

<?php
      if (have_posts()) :
        while (have_posts()) : the_post();
          get_template_part('content-single-works');
        endwhile;
      endif;
?>

  </div>
</article>



<?php get_footer(); ?>