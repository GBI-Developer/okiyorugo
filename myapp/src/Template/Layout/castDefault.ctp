<!DOCTYPE html>
<html>
<head>
  <?= $this->element('analytics_key'); ?>
  <?= $this->Html->charset() ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"> -->
  <title>
    <?= LT['004'] ?>:
    <?= $this->fetch('title') ?>
  </title>
  <?= $this->Html->meta('apple-touch-icon-precomposed', '/favicon.ico', [
    'type'=>'icon',
    'size' => '144x144',
    'rel'=>'apple-touch-icon-precomposed'
])."\n";?>
  <?= META['USER_NO_INDEX'] ? $this->Html->meta('robots',['content'=> 'noindex']): "";?>
  <?= META['NO_FOLLOW'] ? $this->Html->meta('robots',['content'=> 'nofollow']): "";?>
  <?= $this->Html->meta('icon') ?>
  <?= $this->Html->script('jquery-3.1.0.min.js') ?>
  <!-- <?= $this->Html->script('materialize.js') ?> --><!-- 検証用 -->
 <?= $this->Html->script('materialize.min.js') ?>
  <?= $this->Html->script('map.js') ?>
  <?= $this->Html->script('okiyoru.js') ?>
  <?= $this->Html->script('ja_JP.js') ?>
  <?= $this->Html->script('jquery.notifyBar.js') ?>
  <?= $this->Html->script('ajaxzip3.js') ?>
  <?= $this->Html->script('moment.min.js') ?><!-- fullcalendar-3.9.0 -->
  <?= $this->Html->script('fullcalendar.js') ?><!-- fullcalendar-3.9.0 --><!-- TODO: minの方を読み込むようにする。軽量化のため -->
  <?= $this->Html->script('fullcalendar_locale/ja.js') ?><!-- fullcalendar-3.9.0 -->
  <?= $this->Html->script(API['GOOGLE_MAP_APIS']) ?>
  <?= $this->Html->script("load-image.all.min.js") ?><!-- 画像の縦横を自動調整してくれるプラグインExif情報関連 -->
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
  <?php !empty($userInfo['icon_name'])? $icon = $userInfo['profile_path'].DS.$userInfo['icon_name'] : $icon = "/img/common/noimage.jpg"; ?>
  <?php $id = $this->request->getSession()->read('Auth.Cast.id') ?>
  <?php $role = $this->request->getSession()->read('Auth.Cast.role') ?>
</head>
<body id="cast-default">
  <ul id="slide-out" class="side-nav fixed">
    <li>
      <div class="user-view">
        <div class="background" style="background-color: orange;">
        <!-- <img src="/img/common/area/top1.jpg"> -->
        </div>
        <a href="#!user"><img class="circle" src="<?=$icon?>"></a>
        <a href="#!name"><span class="white-text name"><?=$this->request->getSession()->read('Auth.Cast.name')?></span></a>
        <a href="#!email"><span class="white-text email"><?=$this->request->getSession()->read('Auth.Cast.email')?></span></a>
      </div>
    </li>
    <li><a href="/cast/casts/index?activeTab=dashbord" class="waves-effect <?php if($role != 'cast'){echo "btn-disabled";}?>"><i class="material-icons" href="">dashboard</i><?= CAST_LM['001'] ?></a></li>
    <li><a href="/cast/casts/profile?activeTab=profile" class="waves-effect <?php if($role != 'cast'){echo "btn-disabled";}?>"><i class="material-icons">person</i><?= CAST_LM['002'] ?></a></li>
    <li><a href="/cast/casts/top-image?activeTab=top-image" class="waves-effect <?php if($role != 'cast'){echo "btn-disabled";}?>"><i class="material-icons">image</i><?= CAST_LM['003'] ?></a></li>
    <li><a href="/cast/casts/diary?activeTab=diary" class="waves-effect <?php if($role != 'cast'){echo "btn-disabled";}?>"><i class="material-icons">note_add</i><?= CAST_LM['004'] ?></a></li>
    <li><a href="/cast/casts/gallery?activeTab=gallery" class="waves-effect <?php if($role != 'cast'){echo "btn-disabled";}?>"><i class="material-icons">photo_library</i><?= CAST_LM['005'] ?></a></li>
    <li><a class="waves-effect" href="/cast/casts"><i class="material-icons">home</i><?= COMMON_LM['004'] ?></a></li>
    <li><a class="waves-effect" href="#!"><i class="material-icons">help_outline</i><?= COMMON_LM['001'] ?></a></li>
    <li><a class="waves-effect" href="#!"><i class="material-icons">contact_mail</i><?= COMMON_LM['002'] ?></a></li>
    <li><a class="waves-effect" href="#!"><i class="material-icons">priority_high</i><?= COMMON_LM['003'] ?></a></li>
    <li><a class="waves-effect" href="#!"><i class="material-icons">description</i><?= COMMON_LM['005'] ?></a></li>
    <li><div class="divider"></div></li>
    <li><a href="/cast/casts/logout" class="waves-effect"><i class="material-icons" href="">keyboard_backspace</i><?= COMMON_LM['007'] ?></a></li>
    <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
  </ul>
  <div class="nav-header-cron-dummy"></div>
  <nav id="nav-header-menu" class="nav-header-menu nav-opacity">
    <div class="nav-wrapper">
      <a href="#!" data-activates="slide-out" class="button-collapse oki-button-collapse"><i class="material-icons">menu</i></a>
      <a href="#!" class="brand-logo oki-brand-logo"><?= LT['001'] ?></a>
      <ul class="right">
        <li><a data-target="modal-help" class="modal-trigger"><i class="material-icons">help</i></a></li>
      </ul>
    </div>
  </nav>
  <!-- ヘルプモーダル -->
  <?= $this->element('modal/helpModal'); ?>
  <?= $this->fetch('content') ?>
  <footer class="page-footer">
    <div class="footer-copyright oki-footer-copyright">
      <?= LT['002']; ?>
      <?=(2018-date('Y'))?' - '.date('Y'):'';?> <?= LT['003'] ?>
    </div>
    <!-- START #return_top -->
    <div id="return_top">
      <div class="fixed-action-btn">
        <a class="btn-floating btn-large black">
          <i class="large material-icons">keyboard_arrow_up</i>
        </a>
      </div>
    </div>
    <!-- END #return_top -->
  </footer>
</body>
</html>
