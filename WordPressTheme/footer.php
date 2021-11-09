</main>
<footer class="l-footer p-footer">
  <div class="p-footer__inner l-inner">
    <div class="p-footer__container">
      <section class="p-footer__contact p-footerLogo">
        <div class="p-footerLogo__title">
          <!-- <h2>ARISE-COLOR</h2> -->
          <p>
            <span style="--i:1;">A</span>
            <span style="--i:2;">R</span>
            <span style="--i:3;">I</span>
            <span style="--i:4;">S</span>
            <span style="--i:5;">E</span>
            <span style="--i:6;">-</span>
            <span style="--i:8;">C</span>
            <span style="--i:9;">O</span>
            <span style="--i:10;">L</span>
            <span style="--i:11;">O</span>
            <span style="--i:12;">R</span>
          </p>
        </div>
        <div class="p-footerLogo__enterprise">
          <h2>Web制作<span>アライズカラー</span></h2>
          <p>神奈川県相模原市中央区</p>
          <p>アライズカラービル150F</p>
        </div>
      </section>

      <!-- フッターナビ -->
      <nav class="p-footer__navigation p-footerNav">
        <?php
        wp_nav_menu(
          array(
            'theme_location' => 'place_footer',
            'menu_class' => 'p-footerNav__list',
            'container' => false,
          )
        );
        ?>
      </nav>

      <div class="p-footer__sns l-snsNavi p-snsNavi">
        <ul class="p-snsNavi__list">
          <li class="p-snsNavi__item"><a href="https://twitter.com"><img
                src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/twitter.png" alt="twitterロゴ"></a></li>
          <li class="p-snsNavi__item"><a href="https://www.facebook.com"><img
                src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/facebook.png" alt="facebookロゴ"></a></li>
          <li class="p-snsNavi__item"><a href="https://www.instagram.com"><img
                src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/instagram.png" alt="instagramロゴ"></a></li>
        </ul>
      </div>
    </div>

    <div class="l-footer-copyright p-footer-copyright">
      <small class="p-footer-copyright__text">&copy; 2021 <?php bloginfo('name'); ?> All Rights Reserved.</small>
    </div>

  </div>
</footer>

<!-- 画面遷移用 -->
<?php if (is_front_page()) : ?>
<!-- </div> -->
<!--/u-splash-contaier-->
<?php endif; ?>

<?php wp_footer(); ?>
</body>

</html>