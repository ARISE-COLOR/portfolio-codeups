<li class="p-category__item">
  <?php
  $this_terms_obj = get_queried_object(); //現在のタクソノミー情報取得
  $this_terms_id = $this_terms_obj->term_id; //現在のタクソノミーID取得
  $term_link = get_term_link($term); //ループ中の各タームリンク取得
  $term_background = get_field('term__background-color', $term->taxonomy . '_' . $term->term_id); //ループ中の各タームカスタムフィールド値取得（背景色）
  $term_text = get_field('term__text-color', $term->taxonomy . '_' . $term->term_id); //ループ中の各タームカスタムフィールド値取得（文字色）

  if ($term->term_id == $this_terms_id) :
    echo '<a class="p-category__link current" href="' . esc_url($term_link) . '" style="background-color:' . esc_attr($term_background) . ';color:' . esc_attr($term_text) . ';">';
  else :
    echo '<a class="p-category__link" href="' . esc_url($term_link) . '" style="background-color:' . esc_attr($term_background) . ';color:' . esc_attr($term_text) . ';">';
  endif;
  ?>
  <span><?php echo esc_html($term->name); ?></span>
  </a>

</li>