<!DOCTYPE html>
<html>
<head>
  <?= $this->element('analytics_key'); ?>
  <?= $this->Html->charset() ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"> -->
  <title>
    <?= $this->fetch('title') ?>
  </title>
  <?= $this->Html->meta('apple-touch-icon-precomposed', '/night_planet_top_favicon.png', [
      'type'=>'icon',
      'size' => '144x144',
      'rel'=>'apple-touch-icon-precomposed'
  ])."\n";?>
  <?= SIMPLE_NO_INDEX ? $this->Html->meta('robots',['content'=> 'noindex']): "";?>
  <?= NO_FOLLOW ? $this->Html->meta('robots',['content'=> 'nofollow']): "";?>
  <?= $this->Html->meta('icon') ?>
  <?= $this->Html->script('jquery-3.1.0.min.js') ?>
  <!-- <?= $this->Html->script('materialize.js') ?> --><!-- 検証用 -->
  <?= $this->Html->script('materialize.min.js') ?>
  <?= $this->Html->script('map.js') ?>
  <?= $this->Html->script('okiyoru.js') ?>
  <?= $this->Html->script('ja_JP.js') ?>
  <?= $this->Html->script('jquery.notifyBar.js') ?>
  <?= $this->Html->script('ajaxzip3.js') ?>
  <?= $this->Html->script('masonry.pkgd.min.js') ?><!-- タイル表示プラグイン TODO: 未使用状態 -->
  <?= $this->Html->script('moment.min.js') ?><!-- fullcalendar-3.9.0 -->
  <?= $this->Html->script('fullcalendar.js') ?><!-- fullcalendar-3.9.0 --><!-- TODO: minの方を読み込むようにする。軽量化のため -->
  <?= $this->Html->script('fullcalendar_locale/ja.js') ?><!-- fullcalendar-3.9.0 -->
  <?= $this->Html->script(API['GOOGLE_MAP_APIS']) ?>
  <script src='/PhotoSwipe-master/dist/photoswipe.min.js'></script> <!-- PhotoSwipe 4.1.3 -->
  <script src='/PhotoSwipe-master/dist/photoswipe-ui-default.min.js'></script> <!-- PhotoSwipe 4.1.3 -->
  <link href='/PhotoSwipe-master/dist/default-skin/default-skin.css' rel='stylesheet' /> <!-- PhotoSwipe 4.1.3 -->
  <link href='/PhotoSwipe-master/dist/photoswipe.css' rel='stylesheet' /> <!-- PhotoSwipe 4.1.3 -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <?= $this->Html->css('fontello-3eba660b/css/fontello.css') ?>
  <?= $this->Html->css('materialize.css') ?>
  <?= $this->Html->css('okiyoru.css') ?>
  <?= $this->Html->css('jquery.notifyBar.css') ?>
  <?= $this->Html->css('fullcalendar.css') ?><!-- fullcalendar-3.9.0 --><!-- TODO: minの方を読み込むようにする。軽量化のため -->

  <?= $this->fetch('meta') ?>
  <?= $this->fetch('css') ?>
  <?= $this->fetch('script') ?>
</head>
<body id="simple-default">
  <?= $this->fetch('content') ?>
</body>
</html>
