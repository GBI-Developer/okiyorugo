<?php
/**
* @var \App\View\AppView $this
* @var \App\Model\Entity\shop[]|\Cake\Collection\CollectionInterface $owners
*/
?>
<div id="shop" class="container">
  <?= $this->Flash->render() ?>
  <nav class="nav-breadcrumb">
      <div class="nav-wrapper nav-wrapper-oki">
        <div class="col s12">
          <?=
            $this->Breadcrumbs->render(
              ['class' => 'breadcrumb'],
              ['separator' => '<i class="material-icons">chevron_right</i>']
            );
          ?>
        </div>
      </div>
    </nav>
  <div class="row">
    <div id="shop-main" class="col s12 m12 l8">
      <img class="responsive-img" width="100%" src=<?php if($shop->top_image != '') {
        echo($shopInfo['dir_path'].$shop->top_image);} else {
        echo("/img/common/top/top1.jpg");} ?> />
      <div class="fixed-action-btn share horizontal click-to-toggle">
        <a class="btn-floating btn-large red">
          <i class="material-icons">share</i>
        </a>
        <ul>
          <li>
            <a href="<?=SHARER['FACEBOOK'].$sharer?>" class="btn-floating blue"><i class="icon-facebook-rect">icon-facebook-rect</i></a>
          </li>
          <li>
            <a href="<?=SHARER['TWITTER'].$sharer?>" class="btn-floating blue darken-1"><i class="icon-twitter">icon-twitter</i></a>
          </li>
          <li>
            <a class="btn-floating chocolate"><i class="icon-instagram">icon-instagram</i></a>
          </li>
          <li>
            <a href="<?=SHARER['LINE'].$sharer?>" class="btn-floating green"><i class="icon-comment-alt">icon-comment-alt</i></a>
          </li>
        </ul>
      </div>
      <?= $this->element('shop-edit-form') ?>
      <h5 class="left-align"><?php if($shop->name != '') {
        echo($shop->name);} else {
        echo("店舗名を決めてください。");} ?>
      </h5>
      <div class="header-area">
        <div class="share right-align">
          <a class="btn-floating blue btn-large waves-effect waves-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="facebookでシェア">
            <i class="icon-facebook-rect">icon-facebook-rect</i>
          </a>
          <a class="btn-floating blue darken-1 btn-large waves-effect waves-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="twitterでシェア">
            <i class="icon-twitter">icon-twitter</i>
          </a>
          <a class="btn-floating chocolate btn-large waves-effect waves-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="instagramでシェア">
            <i class="icon-instagram">icon-instagram</i>
          </a>
          <a class="btn-floating green btn-large waves-effect waves-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="lineでシェア">
            <i class="icon-comment-alt">icon-comment-alt</i>
          </a>
        </div>

      </div>
      <div class="card-panel light-blue accent-1">
        <?php if($shop->catch != ''){
          echo ($this->Text->autoParagraph($shop->catch)); } else {
          echo ('キャッチコピーがありません。');} ?>
      </div>
      <ul class="collapsible popout" data-collapsible="accordion">
        <li>
          <div class="collapsible-header orange lighten-4">
            <div class="coupon">
              <i class="material-icons">filter_drama</i>
              クーポン<p class="label">クーポンを表示する</p>
              <p class="arrow nonActive">
                <a class="btn-floating btn-large red">
                  <i class="large material-icons or-material-icons">expand_more</i>

                </a>
              </p>
            </div>
          </div>
            <?php if(count($shop->coupons) > 0) { ?>
            <?php foreach($shop->coupons as $coupon): ?>
              <div class="collapsible-body orange lighten-4">
                <span><?= $this->Time->format($coupon->from_day, 'Y/M/d') ?>～<?= $this->Time->format($coupon->to_day, 'Y/M/d') ?></span><br />
                  <span>★☆★<?=$coupon->title ?>★☆★<br />
                <?=$coupon->content ?><br />
              <?php if($coupon === end($shop->coupons)){echo ('こちらの画面をお店側に見せ、使用するクーポンをお知らせください。');}?></span>
              </div>
            <?php endforeach; ?>
            <?php } else { ?>
              <div class="collapsible-body orange lighten-4">
                <p>クーポンの登録はありません。</p>
              </div>
            <?php } ?>

        </li>
      </ul>
      <div class="row cast-list">
        <div class="or-header-wrap card-panel red lighten-3">
          <span class="or-header">キャスト</span>
        </div>
        <?php if(count($shop->casts) > 0) { ?>
            <?php foreach($shop->casts as $cast): ?>
            <div class="col s4 m3 l3">
              <div>
                <a href="<?=DS.$shop['area'].DS.PATH_ROOT['CAST'].DS.$cast['id']."?genre=".$shop['genre']."&name=".$shop['name']."&shop=".$shop['id']."&nickname=".$cast['nickname']?>">
                  <img src="<?=isset($cast->image1) ? $shopInfo['dir_path'].PATH_ROOT['CAST'].DS.$cast->dir.DS.PATH_ROOT['IMAGE'].DS.$cast->image1:PATH_ROOT['NO_IMAGE02'] ?>" alt="" class="circle" width="80" height="80">
                </a>
                </div>
              <h6><?=$cast->nickname?></h6>
            </div>
            <?php endforeach; ?>
        <?php } else { ?>
            <p>キャストの登録はありません。</p>
        <?php } ?>
      </div>
      <div class="row">
        <div class="or-header-wrap card-panel red lighten-3">
          <span class="or-header">店舗情報</span>
        </div>
        <div class="col s12 m6 l6">
         <table class="bordered shop-table z-depth-2" border="1">
          <tbody>
            <tr>
              <th class="table-header" colspan="2" align="center"><?= h($shop->name);?></th>
            </tr>
            <tr>
              <th align="center">所在地</th>
              <td><?= h($shop->full_address);?></td>
            </tr>
            <tr>
              <th align="center">連絡先</th>
              <td><?=h($shop->tel);?></td>
            </tr>
            <tr>
              <th align="center">営業時間</th>
              <td><?php if((!$shop->bus_from_time == '')
                            && (!$shop->bus_to_time == '')
                            && (!$shop->bus_hosoku == '')) {
                              $busTime = $this->Time->format($shop->bus_from_time, 'HH:mm')
                              ."～".$this->Time->format($shop->bus_to_time, 'HH:mm')
                              ."</br>".$shop->bus_hosoku;
                              echo ($busTime);
                            } else { echo ('-'); } ?></td>
            </tr>
            <tr>
              <th align="center">スタッフ</th>
              <td><?=h($shop->staff);?></td>
            </tr>
            <tr>
              <th align="center" valign="top">システム</th>
              <td><?=h($shop->system);?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col s12 m6 l6">
        <div class="post_col post_col-2">
          <table class="other-table bordered shop-table z-depth-2" border="1">
            <tbody>
              <tr>
                <th class="table-header" colspan="2" align="center">その他</th>
              </tr>
              <tr>
                <th align="center">ご利用できるクレジットカード</th>
                <td><?php if(!$shop->credit == '') { ?>
                      <?php $array =explode(',', $shop->credit); ?>
                      <?php for ($i = 0; $i < count($array); $i++) { ?>
                      <div class="chip" name="" value="">
                        <img src="<?=PATH_ROOT['CREDIT'].$array[$i]?>.png" id="<?=$array[$i]?>" alt="<?=$array[$i]?>">
                        <?=$array[$i]?>
                      </div>
                      <?php } ?>
                      <?php } else {echo ('-');} ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col s12">
        <div class="post_col post_col-2">
          <table class="new-info-table bordered shop-table z-depth-2" border="1">
            <tbody>
              <tr>
                <th class="table-header" colspan="2" align="center">新着情報</th>
              </tr>
              <tr>
                <td>新着情報はありません。</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="or-header-wrap card-panel red lighten-3">
        <span class="or-header">ギャラリー</span>
      </div>
      <?php $isGalleryExists = false; ?>
        <?php foreach ($imageList as $key => $value): ?>
          <?= $value == reset($imageList) ?'<div class="my-gallery">':""?>
            <figure class="col <?=(count($imageList)==1?'s12 m12 l12':(count($imageList)==2?'s6 m6 l6':'s4 m4 l4'))?>">
              <a href="<?=$shopInfo['dir_path'].PATH_ROOT['IMAGE'].DS.$value['name']?>" data-size="800x600"><img width="100%" src="<?=$shopInfo['dir_path'].PATH_ROOT['IMAGE'].DS.$value['name']?>" alt="写真の説明でーす。" /></a>
            </figure>
          <?= $value == end($imageList) ?'</div>':""?>
          <?php $isGalleryExists = true; ?>
        <?php endforeach; ?>
        <?= $isGalleryExists ? "" : '<p class="col">ギャラリーの登録はありません。</p>';?>
    </div>
    <div class="row">
      <div class="col s12">
        <div class="card-panel red lighten-3">
          <span class="or-header">マップ</span>
        </div>
        <div style="width:100%;height:300px;" id="google_map"></div>
      </div>
    </div>
  </div>
  <div id="shop-sidebar" class="col s12 m12 l4">
    <div class="card-panel red lighten-3">
      <span class="or-header">求人情報</span>
    </div>
    <div class="col s12 m6 l12">
      <table class="bordered shop-table z-depth-2" border="1">
        <tbody>
          <tr>
          <tr>
            <th  class="table-header" colspan="2" align="center"><?php if(!$shop->name == '') {
              echo ($shop->name);
            } else {echo ('-');}?></th>
          </tr>
          <tr>
            <th align="center">業種</th>
            <td>
              <?php if(!$shop->jobs[0]->industry == '') {
                      echo ($this->Text->autoParagraph($shop->jobs[0]->industry));
                    } else {echo ('-');} ?>
            </td>
          </tr>
          <tr>
            <th align="center">職種</th>
            <td>
              <?php if(!$shop->jobs[0]->job_type == '') {
                      echo ($this->Text->autoParagraph($shop->jobs[0]->job_type));
                    } else {echo ('-');} ?>
            </td>
          </tr>
          <th align="center">時間</th>
            <td><?php if((!$shop->jobs[0]->work_from_time == '')
                      && (!$shop->jobs[0]->work_to_time == '')) {
                        $workTime = $this->Time->format($shop->jobs[0]->work_from_time, 'HH:mm')
                        ."～".$this->Time->format($shop->jobs[0]->work_to_time, 'HH:mm');
                        if (!$shop->jobs[0]->work_time_hosoku == '') {
                          $workTime = $workTime.="</br>".$shop->jobs[0]->work_time_hosoku;
                        }
                        echo ($workTime);
                      } else { echo ('-'); } ?>
            </td>
          </tr>
          <th align="center">資格</th>
          <td><?php if((!$shop->jobs[0]->from_age == '')
                      && (!$shop->jobs[0]->to_age == '')) {
                        $qualification = $shop->jobs[0]->from_age."歳～".$shop->jobs[0]->to_age."歳くらいまで";
                        if (!$shop->jobs[0]->qualification_hosoku == '') {
                          $qualification = $qualification.="</br>".$shop->jobs[0]->qualification_hosoku;
                        }
                        echo ($qualification);
                      } else { echo ('-'); } ?>
            </td>
          </tr>
          <th align="center">休日</th>
            <td><?php if(!$shop->jobs[0]->holiday == '') {
                        $holiday = $shop->jobs[0]->holiday;
                        if (!$shop->jobs[0]->holiday_hosoku == '') {
                          $holiday = $holiday.="</br>".$shop->jobs[0]->holiday_hosoku;
                        }
                        echo ($holiday);
                      } else { echo ('-'); } ?>
            </td>
          </tr>
            <th align="center">待遇</th>
            <td>
              <?php if(!$shop->jobs[0]->treatment == '') { ?>
                <?php $array =explode(',', $shop->jobs[0]->treatment); ?>
                <?php for ($i = 0; $i < count($array); $i++) { ?>
                <div class="chip" name=""id="<?=$array[$i]?>" value="<?=$array[$i]?>"><?=$array[$i]?></div>
                </div>
                <?php } ?>
              <?php } else {echo ('-');} ?>
            </td>
          </tr>
          <tr>
            <th align="center">PR</th>
            <td><?php if(!$shop->jobs[0]->pr == '') {
              echo ($shop->jobs[0]->pr);
            } else {echo ('-');}?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col s12 m6 l12">
      <table class="tel-table bordered shop-table z-depth-2" border="1">
        <tbody>
          <tr>
            <th  class="table-header" colspan="2" align="center">応募連絡先</th>
          </tr>
          <tr>
            <th align="center">連絡先1</th>
            <td><?php if(!$shop->jobs[0]->tel1 == '') {
              echo ($shop->jobs[0]->tel1);
            } else {echo ('-');} ?>
            </td>
          </tr>
          <tr>
            <th align="center">連絡先2</th>
            <td><?php if(!$shop->jobs[0]->tel2 == '') {
              echo ($shop->jobs[0]->tel2);
            } else {echo ('-');} ?>
            </td>
          </tr>
          <tr>
            <th align="center">メール</th>
            <td><?php if(!$shop->jobs[0]->email == '') {
              echo ($shop->jobs[0]->email);
            } else {echo ('-');} ?>
            </td>
          </tr>
          <tr>
            <th align="center">LINE ID</th>
            <td><?php if(!$shop->jobs[0]->lineid == '') {
              echo ($shop->jobs[0]->lineid);
            } else {echo ('-');} ?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
<?= $this->element('photoSwipe'); ?>