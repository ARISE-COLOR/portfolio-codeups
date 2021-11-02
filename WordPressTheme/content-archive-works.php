<!-- 記事に紐づくカスタムタクソノミー情報を取得 -->
<?php
$terms = get_the_terms($post->ID, 'genre');
?>

<!-- 制作実績カード出力 -->
<li class="p-works__item">
  <a href="<?php the_permalink(); ?>" class="p-works__link">
    <div class="p-works__img">
      <?php echo get_card_image(); ?>
    </div>
    <h2 class="p-works__title"><?php the_title(); ?></h2>
  </a>
  <div class="p-works__category">

    <!-- 関連するタームを複数表示する場合 -->
    <?php if (!empty($terms)) : ?>
      <?php foreach ($terms as $term) : ?>
        <?php
        $term_link = get_term_link($term); //ループ中の各タームリンク取得
        $term_background = get_field('term__background-color', $term->taxonomy . '_' . $term->term_id); //ループ中の各タームカスタムフィールド値取得（背景色）
        $term_text = get_field('term__text-color', $term->taxonomy . '_' . $term->term_id); //ループ中の各タームカスタムフィールド値取得（文字色）

        echo '<a class="p-works__terms" href="' . $term_link . '" style="background-color:' . $term_background . ';color:' . $term_text . ';">';
        ?>
          <span><?php echo $term->name; ?></span>
        </a>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

</li>





<!-- 参考情報 -->
<!-- 紐づくタームの最初の一つのみリンクとして貼り付け -->
<!-- <?php //if($terms): 
      ?>
  <a href="<?php //echo get_term_link($terms[0]); 
            ?>" class="p-works__category">
    <span><?php //echo $terms[0]->name; 
          ?></span>
  </a>
  <?php //endif;
  ?> -->