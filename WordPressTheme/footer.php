<footer class="l-footer p-footer">
  <div class="p-footer__inner l-inner">
    <div class="p-footer__container">
      <div class="p-footer__contact">
        <div class="p-foote__logo">
          <h1>ARISE-COLOR</h1>
        </div>
        <div class="p-footer__enterprise">
          <p class="p-footer__name">Web制作　アライズカラー</p>
          <p class="p-footer__address">
            神奈川県相模原市中央区<br />
            アライズカラービル30F
          </p>
        </div>
      </div>

      <nav class="p-footer__nav">
        <ul class="menu">
          <li class="menu-item">
            <a class="nav-link" href="#">企業情報</a>
          </li>
          <li class="menu-item">
            <a class="nav-link" href="#">会社概要</a>
          </li>
          <li class="menu-item">
            <a class="nav-link" href="#">事業紹介</a>
          </li>
          <li class="menu-item">
            <a class="nav-link" href="#">沿革</a>
          </li>
          <li class="menu-item">
            <a class="nav-link" href="#">店舗情報</a>
          </li>
          <li class="menu-item">
            <a class="nav-link" href="#">地域貢献活動</a>
          </li>
          <li class="menu-item">
            <a class="nav-link" href="#">ニュースリリース</a>
          </li>
          <li class="menu-item">
            <a class="nav-link" href="#">お問い合わせ</a>
          </li>
        </ul>

        <?php
              wp_nav_menu(
                array (
                  'theme_location' => 'place_footer',
                  'container' => 'div',
                  'container_class' => 'arise-class-cont',
                  'menu_class' => 'arise-class',
                  'add_li_class'  => 'arise-item-li arise-hover'
                )
              );
            ?>


      </nav>
    </div>
    <div class="p-footer-copyright">
      <small class="p-footer-copyright__text">&copy; 2021 <?php bloginfo('name'); ?> All Rights Reserved.</small>
    </div>

  </div>

<section>
  <p>testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest</p>
</section>

</footer>
<?php wp_footer(); ?>
</body>

</html>