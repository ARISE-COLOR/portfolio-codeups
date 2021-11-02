<?php

/**
 * Functions
 */

/**
 * WordPress標準機能
 *
 * @codex https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/add_theme_support
 */
function my_setup()
{
  add_theme_support('post-thumbnails'); /* アイキャッチ */
  add_theme_support('automatic-feed-links'); /* RSSフィード */
  add_theme_support('title-tag'); /* タイトルタグ自動生成 */
  add_theme_support(
    'html5',
    array( /* HTML5のタグで出力 */
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    )
  );
}
add_action('after_setup_theme', 'my_setup');


/**
 * CSSとJavaScriptの読み込み
 *
 * @codex https://wpdocs.osdn.jp/%E3%83%8A%E3%83%93%E3%82%B2%E3%83%BC%E3%82%B7%E3%83%A7%E3%83%B3%E3%83%A1%E3%83%8B%E3%83%A5%E3%83%BC
 */
function my_script_init()
{

  wp_enqueue_style('my', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.1', 'all');

  wp_enqueue_script('my', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '1.0.1', true);
}
add_action('wp_enqueue_scripts', 'my_script_init');



/* 投稿アーカイブページの作成 */
function post_has_archive($args, $post_type)
{

  if ('post' == $post_type) {
    $args['rewrite'] = true;
    $args['has_archive'] = 'news'; //任意のスラッグ名
  }
  return $args;
}
add_filter('register_post_type_args', 'post_has_archive', 10, 2);



//固定ページの『抜粋文』表示機能の有効化
add_post_type_support('page', 'excerpt');

//get_the_excerpt()で取得する文字列に改行タグを挿入
function apply_excerpt_br($value)
{
  return nl2br($value);
}
add_filter('get_the_excerpt', 'apply_excerpt_br');

//抜粋文の最後の省略文字をデフォルトの[...]から変更する
function cms_excerpt_more()
{
  return '...';
}
add_filter('excerpt_more', 'cms_excerpt_more');

//抜粋文のデフォルト文字数を定義する
function cms_excerpt_length()
{
  return 80;
}
add_filter('excerpt_mblength', 'cms_excerpt_length');


//抜粋文の文字数をフレキシブルに設定する関数
//wp_trim_words:第一引数に抜粋対象の文字列、第二引数には数値、第三引数には抜粋文の最後に表示する内容を指定
//これを本来get_the_excerptを入れるところに代入すると、そこだけ指定文字数で抜粋できる
function get_flexible_excerpt($number)
{
  $value = get_the_excerpt();
  $value = wp_trim_words($value, $number, '...');
  return $value;
}


/**
 * メニューの登録
 *
 * @codex https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/register_nav_menus
 */
function my_menu_init()
{
  register_nav_menus(
    array(
      'place_global' => 'グローバル',
      'place_footer' => 'フッターナビ',
      'drawer'  => 'ドロワーメニュー',
    )
  );
}
add_action('init', 'my_menu_init');


//メニューのクラス追加
function add_additional_class_on_li($classes, $item, $args)
{
  //add_li_classで指定した内容を反映
  if (isset($args->add_li_class)) {
    $classes[] = $args->add_li_class;
  }
  return $classes;

  // 現在のページのliタグの場合
  if ($item->current == true) {
    // classの値にcurrentを付与
    $classes[] = 'current';
  }

  return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);



/**
 * ウィジェットの登録
 *
 * @codex http://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/register_sidebar
 */
// function my_widget_init() {
// 	register_sidebar(
// 		array(
// 			'name'          => 'サイドバー',
// 			'id'            => 'sidebar',
// 			'before_widget' => '<div id="%1$s" class="p-widget %2$s">',
// 			'after_widget'  => '</div>',
// 			'before_title'  => '<div class="p-widget__title">',
// 			'after_title'   => '</div>',
// 		)
// 	);
// }
// add_action( 'widgets_init', 'my_widget_init' );


/**
 * アーカイブタイトル書き換え
 *
 * @param string $title 書き換え前のタイトル.
 * @return string $title 書き換え後のタイトル.
 */
function my_archive_title($title)
{

  if (is_home()) { /* ホームの場合 */
    $title = 'ブログ';
  } elseif (is_category()) { /* カテゴリーアーカイブの場合 */
    $title = '' . single_cat_title('', false) . '';
  } elseif (is_tag()) { /* タグアーカイブの場合 */
    $title = '' . single_tag_title('', false) . '';
  } elseif (is_post_type_archive()) { /* 投稿タイプのアーカイブの場合 */
    $title = '' . post_type_archive_title('', false) . '';
  } elseif (is_tax()) { /* タームアーカイブの場合 */
    $title = '' . single_term_title('', false);
  } elseif (is_search()) { /* 検索結果アーカイブの場合 */
    $title = '「' . esc_html(get_query_var('s')) . '」の検索結果';
  } elseif (is_author()) { /* 作者アーカイブの場合 */
    $title = '' . get_the_author() . '';
  } elseif (is_date()) { /* 日付アーカイブの場合 */
    $title = '';
    if (get_query_var('year')) {
      $title .= get_query_var('year') . '年';
    }
    if (get_query_var('monthnum')) {
      $title .= get_query_var('monthnum') . '月';
    }
    if (get_query_var('day')) {
      $title .= get_query_var('day') . '日';
    }
  }
  return $title;
};
add_filter('get_the_archive_title', 'my_archive_title');


/**
 * 抜粋文の文字数の変更
 *
 * @param int $length 変更前の文字数.
 * @return int $length 変更後の文字数.
 */
function my_excerpt_length($length)
{
  return 80;
}
add_filter('excerpt_length', 'my_excerpt_length', 999);


/**
 * 抜粋文の省略記法の変更
 *
 * @param string $more 変更前の省略記法.
 * @return string $more 変更後の省略記法.
 */
function my_excerpt_more($more)
{
  return '...';
}
add_filter('excerpt_more', 'my_excerpt_more');


//トップページのメインビジュアル画像用のサイズ設定
add_image_size('top', 1077, 622, true);



//各テンプレートごとのメイン画像を表示
function get_main_image()
{
  global $post;
  if (is_page() || is_singular('daily_contribution')) :
    if (get_field('main_image')) :
      $attachment_id = get_field('main_image');
      return wp_get_attachment_image($attachment_id, 'full');
    elseif (get_the_post_thumbnail($post->ID)) :
      return get_the_post_thumbnail($post->ID, 'full');
    else :
      return '<img src="' . get_template_directory_uri() . '/assets/img/overview@2x.jpg" />';
    endif;
  //制作実績アーカイブページ
  elseif (is_post_type_archive('works') || is_tax('genre')) :
    return '<img src="' . get_template_directory_uri() . '/assets/img/works0.jpg" />';

  elseif (is_post_type_archive('blog') || is_tax('subject')) :
    return '<img src="' . get_template_directory_uri() . '/assets/img/blog0@2x.jpg" />';

  elseif (is_tax('genre')) :
    return '<img src="' . get_template_directory_uri() . '/assets/img/works0.jpg" />';

  elseif (is_tax('subject')) :
    return '<img src="' . get_template_directory_uri() . '/assets/img/blog0@2x.jpg" />';

  elseif (is_archive() || is_singular('post')) : //newsカテゴリorシングル投稿ページの場合
    return '<img src="' . get_template_directory_uri() . '/assets/img/news@2x.jpg" />';

  elseif (is_search() || is_404()) :
    return '<img src="' . get_template_directory_uri() . '/assets/images/bg-page-search.jpg" />';



  else :
    return '<img src="' . get_template_directory_uri() . '/assets/images/bg-page-dummy.png" />';
  endif;
}



//アーカイブページの、各カード型情報のサムネイル画像を表示
function get_card_image()
{
  global $post;
  if (is_front_page()) :


  elseif (is_post_type_archive('works') || is_tax('genre')) :
    $workgroup = SCF::get('works-img__group');

    //サムネイル画像が設定されていればサムネイル画像表示
    if (get_the_post_thumbnail($post->ID)) :
      return get_the_post_thumbnail($post->ID, 'full');

    //サムネイル画像が無い場合は、スライダー画像の１枚目表示
    elseif ($workgroup[0]['works__img']) :
      return wp_get_attachment_image($workgroup[0]['works__img'], 'full');

    //画像登録されていない場合、ダミーとしてworks0.jpgを表示
    else :
      return '<img src="' . get_template_directory_uri() . '/assets/img/works0.jpg" />';
    endif;


  elseif (is_post_type_archive('blog') || is_tax('subject')) :
    return '<img src="' . get_template_directory_uri() . '/assets/img/blog0.jpg" />';

  else :
    return '<img src="' . get_template_directory_uri() . '/assets/img/works0.jpg" />';
  endif;
}



//メイン画像上にテンプレートごとの文字列を表示
function get_main_title()
{
  global $post;
  if (is_singular('post')) :
    $category_obj = get_the_category();
    return $category_obj[0]->name;
  elseif (is_page()) :
    return get_the_title();
  elseif (is_category() || is_tax()) :
    return single_cat_title();
  elseif (is_post_type_archive()) :
    return post_type_archive_title();
  elseif (is_archive()) :
    $page_obj = get_page_by_path('news');
    $page = get_post($page_obj);
    return $page->post_title;     //タイトルを表示
  elseif (is_search()) :
    return 'サイト内検索結果';
  elseif (is_404()) :
    return 'ページが見つかりません';
  elseif (is_singular('daily_contribution')) :
    $term_obj = get_the_terms($post->ID, 'event');
    return $term_obj[0]->name;
  endif;
};


//子ページを取得する関数
function get_child_pages($number = -1, $specified_id = null)
{ //-1を指定すると全てのページを読み込める
  if (isset($specified_id)) :
    $parent_id = $specified_id;
  else :
    $parent_id = get_the_ID();
  endif;
  $args = array(
    'posts_per_page' => $number,
    'post_type'      => 'page',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'post_parent'    => $parent_id,
  );
  $child_pages = new WP_Query($args);
  return $child_pages;
};


// //カスタム投稿タイプ『works』を登録
// add_action('init', function(){
//   register_post_type('works', [
//       'label' => '制作実績',
//       'description' => '制作実績ページ用の投稿機能',
//       'public' => true,
//       'menu_position' => 5,
//       'menu_icon' => 'dashicons-store',
//       'supports' => ['thumbnail', 'title', 'editor','excerpt'],
//       'has_archive' => true,
//       'show_in_rest' => true,
//   ]);
//   register_taxonomy('test', 'works',[
//       'label' => '制作実績の種類',
//       'singular_label' => '制作実績の種類',
//       'hierarchical' => true,
//       'show_in_rest' => true
//   ]);
// });

//******************************************************************
//カスタム投稿タイプ works を登録する
//******************************************************************
add_action('init', 'codex_works_init');
function codex_works_init()
{
  $labels = array(
    'name'               => __('制作実績'),
    'menu_name'          => __('制作実績'),
    'add_new'            => __('制作実績の新規追加'),
    'add_new_item'       => __('新規制作実績の投稿を追加'),
    'new_item'           => __('新規制作実績'),
    'edit_item'          => __('制作実績を編集'),
    'view_item'          => __('制作実績を表示'),
    'all_items'          => __('制作実績一覧'),
    'search_items'       => __('制作実績の投稿を検索'),
    'not_found'          => __('制作実績の投稿が見つかりませんでした。'),
    'not_found_in_trash' => __('ゴミ箱内に制作実績の投稿が見つかりませんでした')
  );

  $args = array(
    'labels'             => $labels,
    'description'        => '制作実績ページ用の投稿機能',
    'public'             => true,
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => 5,
    'menu_icon'          => 'dashicons-format-gallery',
    'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
    'show_in_rest'       => true,
  );

  register_post_type('works', $args);
}

//カスタム投稿タイプ works のカスタムタクソノミー（genre)を追加
add_action('init', 'create_works_taxonomies', 0);
function create_works_taxonomies()
{
  $labels = array(
    'name'              => __('制作実績の種類'),
    'search_items'      => __('制作実績の種類を検索'),
    'add_new_item'      => __('新規『制作実績の種類』を追加'),
    'menu_name'         => __('実績の種類'),
    'edit_item'         => __('制作実績の種類を編集'),
    'view_item'         => __('制作実績の種類を表示'),
    'not_found'         => __('制作実績の種類カテゴリーが見つかりませんでした。'),
    'popular_items'     => __('よく使われている実績の種類'),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_admin_column' => true,
    'show_in_rest'      => true
  );

  register_taxonomy('genre', 'works', $args);
}


//******************************************************************
//カスタム投稿タイプ blog を登録する
//******************************************************************
add_action('init', 'codex_blog_init');
function codex_blog_init()
{
  $labels = array(
    'name'               => __('ブログ'),
    'menu_name'          => __('ブログ'),
    'add_new'            => __('ブログ記事の新規追加'),
    'add_new_item'       => __('新規ブログ記事の投稿を追加'),
    'new_item'           => __('新規ブログ記事'),
    'edit_item'          => __('ブログ記事を編集'),
    'view_item'          => __('ブログ記事を表示'),
    'all_items'          => __('ブログ一覧'),
    'search_items'       => __('ブログの投稿を検索'),
    'not_found'          => __('ブログ記事の投稿が見つかりませんでした。'),
    'not_found_in_trash' => __('ゴミ箱内にブログ記事が見つかりませんでした')
  );

  $args = array(
    'labels'             => $labels,
    'description'        => 'ブログ記事用の投稿機能',
    'public'             => true,
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => 5,
    'menu_icon'          => 'dashicons-analytics',
    'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
    'show_in_rest'       => true,
  );

  register_post_type('blog', $args);
}

//カスタム投稿タイプ blog のカスタムタクソノミー（subject)を追加
add_action('init', 'create_blog_taxonomies', 0);
function create_blog_taxonomies()
{
  $labels = array(
    'name'              => __('ブログの種類'),
    'search_items'      => __('ブログの種類を検索'),
    'add_new_item'      => __('新規『ブログの種類』を追加'),
    'menu_name'         => __('ブログの種類'),
    'edit_item'         => __('ブログの種類を編集'),
    'view_item'         => __('ブログの種類を表示'),
    'not_found'         => __('ブログの種類カテゴリーが見つかりませんでした。'),
    'popular_items'     => __('よく使われているブログの種類'),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_admin_column' => true,
    'has_archive'        => true,
    'show_in_rest'      => true
  );

  register_taxonomy('subject', 'blog', $args);
}


//******************************************************************
// カスタム投稿タイプでカテゴリ未選択時にデフォルトで others(その他) を設定
//******************************************************************
//制作実績用
function add_works_defaultcategory_automatically($post_ID)
{
  global $wpdb;
  // 設定されているカスタム分類のタームを取得
  $worksTerm = wp_get_object_terms($post_ID, 'genre'); //制作実績

  // 既存のターム指定数が 0（つまり未設定）であれば）「others」を指定
  if (0 == count($worksTerm)) {
    // others のターム ID=7
    $defaultTerm = array(7);
    wp_set_object_terms($post_ID, $defaultTerm, 'genre');
  }
}
add_action('publish_works', 'add_works_defaultcategory_automatically');

//ブログ用
function add_blog_defaultcategory_automatically($post_ID)
{
  global $wpdb;
  // 設定されているカスタム分類のタームを取得
  $blogTerm = wp_get_object_terms($post_ID, 'subject'); //ブログ

  // 既存のターム指定数が 0（つまり未設定）であれば）「others」を指定
  if (0 == count($blogTerm)) {
    // others のターム ID=7
    $defaultTerm = array(11);
    wp_set_object_terms($post_ID, $defaultTerm, 'subject');
  }
}
add_action('publish_blog', 'add_blog_defaultcategory_automatically');



//******************************************************************
/* the_archive_title 余計な文字を削除 */
//******************************************************************
add_filter('get_the_archive_title', function ($title) {
  if (is_category()) {
    $title = single_cat_title('', false);
  } elseif (is_tag()) {
    $title = single_tag_title('', false);
  } elseif (is_tax()) {
    $title = single_term_title('', false);
  } elseif (is_post_type_archive()) {
    $title = post_type_archive_title('', false);
  } elseif (is_date()) {
    $title = get_the_time('Y年n月');
  } elseif (is_search()) {
    $title = '検索結果：' . esc_html(get_search_query(false));
  } elseif (is_404()) {
    $title = '「404」ページが見つかりません';
  } else {
  }
  return $title;
});
