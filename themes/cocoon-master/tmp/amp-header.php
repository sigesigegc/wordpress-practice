<?php //AMPヘッダー
/**
 * Cocoon WordPress Theme
 * @author: yhira
 * @link: https://wp-cocoon.com/
 * @license: http://www.gnu.org/licenses/gpl-2.0.html GPL v2 or later
 */
if ( !defined( 'ABSPATH' ) ) exit; ?>
<!DOCTYPE html>
<html amp>
<head>
<meta charset="utf-8">
<title><?php echo wp_get_document_title(); ?></title>
<?php //サイトアイコンの呼び出し
if ($icon = get_site_favicon_url()): ?>
<link rel="icon" href="<?php echo $icon; ?>" >
<?php endif ?>
<?php //canonicalタグの出力
generate_canonical_tag() ?>
<?php //メタディスクリプションタグ
generate_meta_description_tag() ?>
<?php //メタキーワードタグ
generate_meta_keywords_tag() ?>
<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
<?php if ( is_facebook_ogp_enable() ) //Facebook OGPタグ挿入がオンのとき
get_template_part('tmp/header-ogp');//Facebook OGP用のタグテンプレート?>
<?php if ( is_twitter_card_enable() ) //Twitterカードタグ挿入がオンのとき
get_template_part('tmp/header-twitter-card');//Twitterカード用のタグテンプレート?>
<script async src="https://cdn.ampproject.org/v0.js"></script>
<?php
//投稿・固定ページのページ内容全てを取得する
$all_content = get_the_singular_content();
$all_content = convert_content_for_amp($all_content);
$elements = array(
  //'amp-analytics' => 'amp-analytics-0.1.js',
  'amp-facebook' => 'amp-facebook-0.1.js',
  'amp-youtube' => 'amp-youtube-0.1.js',
  'amp-vine' => 'amp-vine-0.1.js',
  'amp-twitter' => 'amp-twitter-0.1.js',
  'amp-instagram' => 'amp-instagram-0.1.js',
  'amp-social-share' => 'amp-social-share-0.1.js',
  'amp-ad' => 'amp-ad-0.1.js',
  'amp-iframe' => 'amp-iframe-0.1.js',
  'amp-audio' => 'amp-audio-0.1.js',
  'amp-video' => 'amp-video-0.1.js',
  'amp-image-lightbox' => 'amp-image-lightbox-0.1.js',
  //form class="amp-form'form class="amp-form' => 'amp-form-0.1.js',
);

//var_dump($the_content);
foreach( $elements as $key => $val ) {
  if( strpos($all_content, '<'.$key) !== false ) {
    echo '<script async custom-element="'.$key.'" src="https://cdn.ampproject.org/v0/'.$val.'"></script>'.PHP_EOL;

  }
}

//AMP用の検索フォームが存在するか
if( (strpos($all_content, 'class="amp-form') !== false) || is_mobile_button_layout_type_slide_in() ) {
  echo '<script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>'.PHP_EOL;
}

//AMP Analytics・Google Tag Manager用のライブラリ
if ( is_analytics() && (get_google_analytics_tracking_id() || get_google_tag_manager_tracking_id()) )  {
  echo '<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>'.PHP_EOL;
}

//AMP Lightboxギャラリーが有効な時
if (is_amp_image_zoom_effect_gallery()) {
  echo '<script async custom-element="amp-lightbox-gallery" src="https://cdn.ampproject.org/v0/amp-lightbox-gallery-0.1.js"></script>'.PHP_EOL;
}

//Font Awesome様のスタイルの読み込み
echo '<link rel="stylesheet" href="'.FONT_AWESOME4_CDN_URL.'">'.PHP_EOL;
//Google Fontsスタイルの読み込み
if (!is_site_font_family_local()) {
  echo '<link rel="stylesheet" href="'.get_site_font_source_url().'">'.PHP_EOL;
}
?>
<?php //JSON-LDの読み込み
get_template_part('tmp/json-ld'); ?>
<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>

<?php //AMP用スタイルの出力
  generate_style_amp_custom_tag(); ?>

<?php //AdSense AMP自動広告の</head>手前コード
get_template_part('tmp/ad-amp-auto-adsense-in-head') ?>

<?php //トップに戻るの</head>手前コード
get_template_part('tmp/amp-button-go-to-top-in-head') ?>

<?php //ユーザーカスタマイズ用
get_template_part('tmp-user/amp-head-insert'); ?>
</head>
<body <?php body_class('amp'); ?> itemscope itemtype="http://schema.org/WebPage">

  <?php //AdSense AMP自動広告の<body>直後コード
  get_template_part('tmp/ad-amp-auto-adsense-in-body') ?>

  <?php //トップに戻るの<body>直後コード
  get_template_part('tmp/amp-button-go-to-top-in-body') ?>

  <?php //AMP用のGoogle Tag Managerコード
  get_template_part('tmp/amp-tagmanager') ?>

  <?php //AMP用のAnalyticsコード
  get_template_part('tmp/amp-analytics') ?>

  <?php //ユーザーカスタマイズ用
  get_template_part('tmp-user/amp-body-top-insert'); ?>

  <?php //サイトヘッダーからコンテンツまでbodyタグ最初のHTML
  get_template_part('tmp/body-top'); ?>
