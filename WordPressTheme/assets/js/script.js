/*********************************************************
 * ローディング判定
 *********************************************************/
jQuery(function ($) {
  $(window).on("load", function () {
    $("body").attr("data-loading", "true");
    //フッターナビメニューにクラス名追加(firefoxでは機能せず)
    $('.p-footerNav__list li').addClass('p-footerNav__item');
    $('.p-footerNav__list a').addClass('p-footerNav__link u-link-hover__nav');

  });

  // スクロール判定
  $(window).on("scroll", function () {
    if (100 < jQuery(this).scrollTop()) {
      $("body").attr("data-scroll", "true");
    } else {
      $("body").attr("data-scroll", "false");
    }
  });
});


/*********************************************************
 * ドロワーメニュー
 *********************************************************/
jQuery(function ($) {

  $(".js-drawer").click(function () {
    $(this).toggleClass('active');//
    $(".js-drawer-open").toggleClass('is-open');
    $("main").toggleClass('u-mainblur'); //背景をぼかすエフェクトON
    $(".js-glowAnime").toggleClass("u-glowAnime"); //光ながら出現するエフェクトON
  });

  $(".js-drawer-open a").click(function () {
    $(".js-drawer").removeClass('active');
    $(".js-drawer-open").removeClass('is-open');
    $("main").removeClass('u-mainblur'); //背景をぼかすエフェクトOFF
    $(".js-glowAnime").removeClass("u-glowAnime"); //光ながら出現するエフェクトOFF
  });

});

/*********************************************************
 * スムーススクロール
 *********************************************************/
jQuery(function ($) {
  $('a[href^="#"]').click(function () {
    let header = jQuery(".js-header").height();
    let speed = 300;
    let id = jQuery(this).attr("href");
    let target = jQuery("#" == id ? "html" : id);
    let position = jQuery(target).offset().top - header;
    if ("fixed" !== jQuery("#header").css("position")) {
      position = jQuery(target).offset().top;
    }
    if (0 > position) {
      position = 0;
    }
    $("html, body").animate(
      {
        scrollTop: position
      },
      speed
    );
    return false;
  });


  /**
   * 右下トップへ戻るボタン
   **/
  $(function() {
    var topBtn = $('.p-pagetop');
    topBtn.hide();

    // ボタンの表示設定
    $(window).scroll(function () {
      if ($(this).scrollTop() > 400) {
        // 指定px以上のスクロールでボタンを表示
        topBtn.fadeIn();
      } else {
        // 画面が指定pxより上ならボタンを非表示
        topBtn.fadeOut();
      }
    });

    // ボタンをクリックしたらスクロールして上に戻る
    topBtn.click(function () {
      $('body,html').animate({
        scrollTop: 0
      }, 500, 'swing');
      return false;
    });
  });

  /* 電話リンク */
  let ua = navigator.userAgent;
  if (ua.indexOf("iPhone") < 0 && ua.indexOf("Android") < 0) {
    $('a[href^="tel:"]')
      .css("cursor", "default")
      .on("click", function (e) {
        e.preventDefault();
      });
  }
});

/*********************************************************
 * メインビジュアル用swiper
 *********************************************************/
var swiperMVOption = new Swiper('.js-swiper-mv', {
  loop: true,
  effect: 'fade',
  autoplay: {
    delay: 4000,
    disableOnInteraction: false
  },
  speed: 2000
});


// // Works　制作実績用swiper
// var swiperWorksOption = new Swiper('.js-swiper-works', {
//   loop: true,
//   parallax: true, //パパラックスさせる
//   loopAdditionalSlides: 10, //ループのときに作られるクローンの枚数。
//   // effect: 'slide',
//   autoplay: {
//     delay: 4000,
//     disableOnInteraction: false,
//   },
//   speed: 1000,
//   pagination: {
//     el: '.p-top-works__swiper-pagination',
//     clickable: true,
//   },
// });


/*********************************************************
 * Works 制作実績用swiper
 *********************************************************/
var userAgent = window.navigator.userAgent.toLowerCase();

if (//旧EdgeとIE11ではスライダーのガタつきが強いので、ユーザーエージェント判定でパララックスではなくフェード表示に切り替え
  userAgent.indexOf("msie") != -1 ||
  userAgent.indexOf("trident") != -1 ||
  userAgent.indexOf("edge") != -1 ||
  userAgent.indexOf("firefox") != -1
) {
  var mainOptions = {
    loop: true, //ループさせる
    speed: 2000, //２秒かけながら移動
    effect: "fade", //フェードさせる
    autoplay: {
      delay: 4000,
      disableOnInteraction: false,
    },
    loopAdditionalSlides: 10, //ループのときに作られるクローンの枚数。
    pagination: {
      el: '.p-top-works__swiper-pagination',
      clickable: true,
    },
  };
} else {
  var mainOptions = {
    loop: true, //ループさせる
    speed: 1500, //１.５秒かけながら移動
    parallax: true, //パパラックス設定
    // allowTouchMove: false, //pcではスライプの禁止、クリックでの移動を禁止する
    loopAdditionalSlides: 10, //ループのときに作られるクローンの枚数。
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    pagination: {
      el: '.p-top-works__swiper-pagination',
      clickable: true,
    },
  };
};

var mainSliderTarget = ".js-swiper-works"; //メイン部分のスライダー
var mainSlider = new Swiper(mainSliderTarget, mainOptions); //.slider__mainとそのオプションをセットする




/*********************************************************
 * worksページサムネイル付きswiper
 *********************************************************/
/**
 * サムネイル
 **/
var sliderThumbnail = new Swiper('.js-works-thumbnail', {
  slidesPerView: 3,
  spaceBetween: 10,
  freeMode: true,
  watchSlidesVisibility: true,
  watchSlidesProgress: true,
});

/**
 * メイン
 **/
var slider = new Swiper('.js-works-slider', {
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  thumbs: {
    swiper: sliderThumbnail
  }
});


/*********************************************************
 * 一定の範囲にスクロールしたらヘッダーメニューバーが非表示
 * 上にスクロールすると再表示
 *********************************************************/
var beforePos = 0;

function ScrollAnime() {
  var keyPosition = 1000;
  var scroll = $(window).scrollTop();
  var mainblur_check = jQuery('main').attr('class');

  if (scroll == beforePos) {
    //IE11対策で処理を入れない
  }
  else if(mainblur_check == 'u-mainblur') {
    // ドロワーメニュー表示時は何も処理をしない
  }
  else if (keyPosition > scroll || 0 > scroll - beforePos) {
    //ヘッダーメニューが上から出現
    $('#u-header').removeClass('UpMove');
    $('#u-header').addClass('DownMove');
  }
  else {
    //ヘッダーが上に消える
    $('#u-header').removeClass('DownMove');
    $('#u-header').addClass('UpMove');
  }

  beforePos = scroll; //現在のスクロール値を入れて前後のスクロール量を比較
}



/*********************************************************
 * ローディング関係
 * 実装済みですが、未使用
 *********************************************************/
$(window).on('load', function () {
  $("#u-splash-logo").delay(1200).fadeOut('slow');//ロゴを1.2秒でフェードアウトする記述

  //=====ここからローディングエリア（splashエリア）を1.5秒でフェードアウトした後に動かしたいJSをまとめる
  $("#u-splash").delay(1500).fadeOut('slow', function () {//ローディングエリア（splashエリア）を1.5秒でフェードアウトする記述
    $('body').addClass('appear');//フェードアウト後bodyにappearクラス付与
  });
  //=====ここまでローディングエリア（splashエリア）を1.5秒でフェードアウトした後に動かしたいJSをまとめる

  //=====ここから背景が伸びた後に動かしたいJSをまとめたい場合は
  $('.u-splashbg1').on('animationend', function () {
    //この中に動かしたいJSを記載
  });
  //=====ここまで背景が伸びた後に動かしたいJSをまとめる
});

// 10秒待っても読み込みが終わらない時は強制的にローディング画面をフェードアウト
function stopload() {
  $('.loading').delay(1000).fadeOut(700);
}
setTimeout('stopload()', 5000);




/*********************************************************
 * その場でフェードイン
 *********************************************************/

function fadeAnime() {
  $('.js-fadeInTrigger').each(function () { //fadeInTriggerというクラス名が
    var elemPos = $(this).offset().top - 50;//要素より、50px上の
    var scroll = $(window).scrollTop();
    var windowHeight = $(window).height();
    if (scroll >= elemPos - windowHeight) {
      $(this).addClass('u-fadeIn');// 画面内に入ったらu-fadeInというクラス名を追記
    } else {
      // $(this).removeClass('fadeIn');// 画面外に出たらfadeInというクラス名を外す（一度しかアニメーションさせない場合は不要）
    }
  });
}


/*********************************************************
 * テキストがじわっと出現
 *********************************************************/
function BlurTextAnimeControl() {
  $('.js-blurTrigger').each(function () { //blurTriggerというクラス名が
    var elemPos = $(this).offset().top - 50;//要素より、50px上の
    var scroll = $(window).scrollTop();
    var windowHeight = $(window).height();
    if (scroll >= elemPos - windowHeight) {
      $(this).addClass('u-blur');// 画面内に入ったらblurというクラス名を追記
    } else {
      // $(this).removeClass('u-blur');// 画面外に出たらblurというクラス名を外す（一度しかアニメーションさせない場合は不要）
    }
  });
}



/*********************************************************
 * 画面がリサイズされたら動かしたいソースコードを記述する
 *********************************************************/
$(window).on('resize', function () {
  //ドロワーメニューを閉じる
  $(".js-drawer").removeClass('active');//ボタンの activeクラスを除去し
  $(".js-drawer-open").removeClass('is-open');//ナビゲーションのpanelactiveクラスも除去
  $("main").removeClass('u-mainblur');//ぼかしたいエリアにu-mainblurクラスを付与
  $(".js-glowAnime").removeClass("u-glowAnime");
  ScrollAnime();//スクロール途中でヘッダーが消え、上にスクロールすると復活する関数を呼ぶ
});

/*********************************************************
 * 画面をスクロールをしたら動かしたい場合の記述
 *********************************************************/
$(window).scroll(function () {
  fadeAnime();// その場でフェードイン
  BlurTextAnimeControl()//テキストがじわっと出現
  ScrollAnime();//スクロール途中でヘッダーが消え、上にスクロールすると復活する関数を呼ぶ
});

/*********************************************************
 * ページが読み込まれたらすぐに動かしたい場合の記述
 *********************************************************/
$(window).on('load', function () {
  //spanタグを追加する
  var element = $(".js-glowAnime");
  element.each(function () {
    var text = $(this).text();
    var textbox = "";
    text.split('').forEach(function (t, i) {
      if (t !== " ") {
        if (i < 10) {
          textbox += '<span style="animation-delay:.' + i + 's;">' + t + '</span>';
        } else {
          var n = i / 10;
          textbox += '<span style="animation-delay:' + n + 's;">' + t + '</span>';
        }
      } else {
        textbox += t;
      }
    });
    $(this).html(textbox);
  });
});


/*********************************************************
 * お問い合わせフォーム関連
 *********************************************************/
$(function () {
  $('[name="pickup"]:radio').change(function () {
    $(".p-contact-form__pickup--op").hide();
    if ($("input:radio[name='pickup']:checked").val() == "1") {
      $('.p-contact-form__pickup--op').show();
    } else if ($("input:radio[name='pickup']:checked").val() == "2") {
      $("input[name='pickupDate']").val("");
      $("select[name='pickupTime']").val("0");
    }
  }).trigger('change');
});


jQuery(function ($) {
  /* ページ読み込み時のボタン制御処理 */
  if ($('input[id="contact_agree-1"]:checked').val()) {
    $('[name="submitConfirm"]').prop("disabled", false);
  } else {
    $('[name="submitConfirm"]').prop("disabled", true);
  }

  /* 同意のチェックボックスをクリックした際のボタン制御処理 */
  $('[id="contact_agree-1"]').click(function () {
    if ($('input[id="contact_agree-1"]:checked').val()) {
      $('[name="submitConfirm"]').prop("disabled", false);
    } else {
      $('[name="submitConfirm"]').prop("disabled", true);
    }
  });

  /**
   * 確認画面用（確認画面のボタンは常に押せる状態にしておく）
   **/
  if (location.pathname === '/confirm/') {
    $('[name="submitButton"]').prop("disabled", false);
    if ($("input:radio[name='pickup']:checked").val() == "1") {
      $('.p-contact-form__pickup--op').show();
    } else if ($("input:radio[name='pickup']:checked").val() == "2") {
      $(".p-contact-form__pickup--op").hide();
    }
  }
});



//お問い合わせフォームのエラー操作(該当箇所にis-errorを付与、エラーメッセージの出し入れ)
jQuery(function ($) {

  if ($('.error')[0]) {
    $('.p-contact-form__td:has(span)').addClass('is-error');
    $('.p-contact__error').show();
  } else {
    $('.p-contact__error').hide();
  }
});

