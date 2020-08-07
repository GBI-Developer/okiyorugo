<div id="cast" class="container">
    <?= $this->Flash->render() ?>
    <?= $this->element('nav-breadcrumb'); ?>
    <div class="row">
        <div id="cast-main" class="col s12 m12 l8">
			<!-- スタッフヘッダ START -->
            <div class="row cast-head-section">
               <img class="responsive-img" width="100%" src=<?= $cast->top_image ?>>
                <div class="cast-head">
                    <div class="cast-head-line1 col s12">
                        <ul class="cast-head-line1__ul">
                            <li class="cast-head-line1__ul_li cast-icon">
                                <img src="<?=$cast->icon?>" width="75px" height="70px" class="circle">
                            </li>
                            <li class="cast-head-line1__ul_li favorite">
                                <div class="cast-head-line1__ul_li__favorite">
                                    <a class="btn-floating btn waves-effect waves-light grey lighten-1 modal-trigger" data-target="modal-login">
                                        <i class="material-icons">favorite</i>
                                    </a>
                                    <i class="favorite-add material-icons">add</i>
                                    <span class="cast-head-line1__ul_li__favorite__count">0</span>
                                </div>
                            </li>
                            <li class="cast-head-line1__ul_li">
                                <div class="cast-head-line1__ul_li__voice">
                                    <a class="btn-floating btn waves-effect waves-light light-blue accent-2 modal-trigger" data-target="modal-login">
                                        <i class="material-icons">comment</i>
                                    </a>
                                    <i class="favorite-add material-icons">add</i>
                                    <span class="cast-head-line1__ul_li__voice__count">0</span>
                                </div>
                            </li>
                            <li class="cast-head-line1__ul_li">
                                <div class="cast-head-line1__ul_li__voice">
                                    <a class="btn-floating btn orange darken-4">
                                        <i class="material-icons">camera_alt</i>
                                    </a>
                                    <span class="cast-head-line1__ul_li__image__count">0</span>
                                </div>
                            </li>
                            <li class="cast-head-line1__ul_li day-work">
								<div class="cast-head-line1__ul_li__day-work<?=$isWorkDay > 0 ? " puyon":""?>">
									<span class="cast-head-line1__ul_li__day-work__status">
                                        <?=$isWorkDay > 0 ? "本日出勤予定":"本日出勤未定"?>
									</span>
								</div>
							</li>
                        </ul>
                    </div>
                    <div class="cast-head-line2 col s12">
                        <ul class="cast-head-line1__ul">
                            <li class="cast-head-line1__ul_li">
                                <?= !empty($cast->name) ? h($cast->name) : h('-') ?>
                            </li>
                        </ul>
                    </div>
				</div>
			</div>
            <!-- スタッフヘッダ END -->
            <!-- メッセージ START -->
            <div class="row section header-discription-message">
                <div class="card-panel light-blue">
                    <?= !empty($cast->message) ? $this->Text->autoParagraph($cast->message) : 
            $cast->nickname.'さんからのメッセージがありません。';
          ?>
                </div>
            </div>
            <!-- メッセージ END -->
            <!-- 更新情報 START -->
            <?= $this->element('info-marquee'); ?>
            <!-- 更新情報 END -->
            <!-- スタッフメニュー START -->
            <div id="shop-menu-section" class="row shop-menu section scrollspy">
                <div class="light-blue accent-2 card-panel col s12 center-align">
                    <p class="shop-menu-label section-label"><span> STAFF MENU </span></p>
                </div>
                <div class="col s4 m3 l3">
                    <div class="white lighten-4 linkbox card-panel hoverable center-align">
                        <?= in_array(SHOP_MENU_NAME['PROFILE'], $update_icon) ? '<div class="new-info"></div>' : ''?>
                        <span class="shop-menu-label cast"></br>PFOFILE</span>
                        <a class="waves-effect waves-light" href="#cast-section"></a>
                    </div>
                </div>
                <div class="col s4 m3 l3">
                    <div class="white lighten-4 linkbox card-panel hoverable center-align">
                        <?= in_array(SHOP_MENU_NAME['WORK'], $update_icon) ? '<div class="new-info"></div>' : ''?>
                        <span class="shop-menu-label work-schedule"></br>TODAY WORK</span>
                        <a class="waves-effect waves-light" href="#!"></a>
                    </div>
                </div>
                <div class="col s4 m3 l3">
                    <div class="white lighten-4 linkbox card-panel hoverable center-align">
                        <?= in_array(SHOP_MENU_NAME['DIARY'], $update_icon) ? '<div class="new-info"></div>' : ''?>
                        <span class="shop-menu-label diary"></br>DIARY</span>
                        <a class="waves-effect waves-light" href="#diary-section"></a>
                    </div>
                </div>
                <div class="col s4 m3 l3">
                    <div
                        class="<?=empty($cast->snss[0]['instagram'])? 'grey ':'white lighten-4 '?>linkbox card-panel hoverable center-align">
                        <span class="shop-menu-label instagram"></br>INSTAGRAM</span>
                        <a class="waves-effect waves-light" href="#instagram-section"></a>
                    </div>
                </div>
                <div class="col s4 m3 l3">
                    <div
                        class="<?=empty($cast->snss[0]['facebook'])? 'grey ':'white lighten-4 '?>linkbox card-panel hoverable center-align">
                        <span class="shop-menu-label facebook"></br>FACEBOOK</span>
                        <a class="waves-effect waves-light" href="#facebook-section"></a>
                    </div>
                </div>
                <div class="col s4 m3 l3">
                    <div
                        class="<?=empty($cast->snss[0]['twitter'])? 'grey ':'white lighten-4 '?>linkbox card-panel hoverable center-align">
                        <span class="shop-menu-label twitter"></br>TWITTER</span>
                        <a class="waves-effect waves-light" href="#twitter-section"></a>
                    </div>
                </div>
                <div class="col s4 m3 l3">
                    <div
                        class="<?=empty($cast->snss[0]['line'])? 'grey ':'white lighten-4 '?>linkbox card-panel hoverable center-align">
                        <span class="shop-menu-label line"></br>LINE</span>
                        <a class="waves-effect waves-light" href="#line-section"></a>
                    </div>
                </div>
                <div class="col s4 m3 l3">
                    <div class="white lighten-4 linkbox card-panel hoverable center-align">
                        <?= in_array(SHOP_MENU_NAME['CAST'], $update_icon) ? '<div class="new-info"></div>' : ''?>
                        <span class="shop-menu-label casts"></br>STAFF</span>
                        <a class="waves-effect waves-light" href="#p-casts-section"></a>
                    </div>
                </div>
                <div class="col s4 m3 l3">
                    <div class="white lighten-4 linkbox card-panel hoverable center-align">
                        <?= in_array(SHOP_MENU_NAME['CAST_GALLERY'], $update_icon) ? '<div class="new-info"></div>' : ''?>
                        <span class="shop-menu-label shop-gallery"></br>GALLERY</span>
                        <a class="waves-effect waves-light" href="#cast-gallery-section"></a>
                    </div>
                </div>
            </div>
            <!-- スタッフメニュー END -->
            <!-- プロフィール START -->
            <div id="cast-section" class="row shop-menu section scrollspy">
                <div class="light-blue accent-2 card-panel col s12 center-align">
                    <p class="cast-profile-label section-label"><span> PROFILE </span></p>
                </div>
                <div class="col s12 m12 l12">
                    <table class="bordered shop-table z-depth-2" border="1">
                        <tbody>
                            <tr>
                                <th class="table-header" colspan="2" align="center"><?= h($cast->nickname);?></th>
                            </tr>
                            <tr>
                                <th align="center">誕生日</th>
                                <td><?=!empty($cast->birthday) ? $this->Time->format($cast->birthday, 'M/d'):"-" ?></td>
                            </tr>
                            <tr>
                                <th align="center">星座</th>
                                <td><?=!empty($cast->constellation) ? CONSTELLATION[$cast->constellation]['label']:"-" ?>
                                </td>
                            </tr>
                            <tr>
                                <th align="center">血液型</th>
                                <td><?=!empty($cast->blood_type) ? BLOOD_TYPE[$cast->blood_type]['label']:"-" ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- プロフィール END -->
            <!-- スタッフギャラリー START -->
            <div id="cast-gallery-section" class="row shop-menu section scrollspy">
                <div class="light-blue accent-2 card-panel col s12 center-align">
                    <p class="cast-gallery-label section-label"><span> GALLERY </span></p>
                </div>
                <?= count($cast->gallery) == 0 ? '<p class="col">まだ投稿がありません。</p>': ""; ?>
                <div class="my-gallery" style="display:inline-block;">
                    <?php foreach ($cast->gallery as $key => $value): ?>
                        <figure>
                            <a href="<?=$value['file_path']?>" data-size="800x1000">
                                <img width="100%" src="<?=$value['file_path']?>" alt="<?=$value['date']?>" />
                            </a>
                            <figcaption style="display:none;">
                                <?=$value['date']?>
                            </figcaption>
                        </figure>
                        <?php
                            if($key >= PROPERTY['SHOW_GALLERY_MAX']):
                                $add_show_flg = true;
                                break;
                            endif;
                        ?>
                    <?php endforeach; ?>
                </div>
                <div class="col s12 center-align">
                    <?php if($add_show_flg): ?>
                    <a href="<?=DS.$shopInfo['area']['path'].DS.PATH_ROOT['GALLERY'].DS.$cast->id."?area=".$cast->shop->area."&genre=".$cast->shop->genre.
                    "&shop=".$cast->shop->id."&name=".$cast->shop->name."&cast=".$cast->id."&nickname=".$cast->nickname?>"
                        class="right waves-effect waves-light btn"><i
                            class="material-icons right">chevron_right</i><?=COMMON_LB['052']?>
                    </a>
                    <?php endif;?>
                </div>
            </div>
            <!-- スタッフギャラリー END -->
            <!-- 日記 START -->
            <div id="diary-section" class="row shop-menu section scrollspy">
                <div class="light-blue accent-2 card-panel col s12 center-align">
                    <p class="diary-label section-label"><span> DIARY </span></p>
                </div>
                <?php if (count($cast->diarys) > 0): ?>
                <div class="my-gallery" style="display:inline-block;">
                    <?php foreach ($cast->diarys[0]->gallery as $key => $value): ?>
                        <figure>
                            <a href="<?=$value['file_path']?>" data-size="800x1000">
                                <img width="100%" src="<?=$value['file_path']?>" />
                            </a>
                        </figure>
                    <?php endforeach; ?>
                </div>
                <div class="col s12">
                    <p class="right-align"><?=$cast->diarys[0]->created->nice()?></p>
                    <p class="title"><?=$cast->diarys[0]->title?></p>
                    <p class="content"><?=$this->Text->autoParagraph($cast->diarys[0]->content)?></p>
                    <div class="card-action like-field">
                        <p>
                            <span class="icon-vertical-align color-blue">
                                <i class="material-icons">favorite_border</i>
                                <span class="like-field-span like-count"><?=count($cast->diarys[0]->likes)?></span>
                            </span>
                            <a href="<?=DS.$shopInfo['area']['path'].DS.PATH_ROOT['DIARY'].DS.$cast->id."?area=".$cast->shop->area."&genre=".$cast->shop->genre.
                                "&shop=".$cast->shop->id."&name=".$cast->shop->name."&cast=".$cast->id."&nickname=".$cast->nickname?>"
                                class="right waves-effect waves-light btn"><i class="material-icons right">chevron_right</i><?=COMMON_LB['052']?>
                            </a>
                        </p>
                    </div>
                </div>
                <?php else: ?>
                <p class="col">日記はありません。</p>
                <?php endif; ?>
            </div>
            <!-- 日記 END -->
            <!-- instagram START -->
            <?php if(!empty($cast->snss[0]['instagram'])): ?>
            <div id="instagram-section" class="row shop-menu section scrollspy">
                <div class="light-blue accent-2 card-panel col s12 center-align">
                    <p class="instagram-label section-label"><span> INSTAGRAM </span></p>
                </div>
                <?php if(!empty($ig_error)):
                  echo('<p class="col">'.$ig_error.'</p>');
                elseif($ig_data->media_count == 0):
                  echo('<p class="col">まだ投稿がありません。</p>');
                else:
          ?>
                <!-- photoSwipe START -->
                <?= $this->element('Instagram'); ?>
                <!-- photoSwipe END -->
                <?php endif;?>
            </div>
            <?php endif;?>
            <!-- instagram END -->
            <!-- facebook START -->
            <?php if(!empty($cast->snss[0]['facebook'])): ?>
            <div id="facebook-section" class="row shop-menu section scrollspy">
                <div class="light-blue accent-2 card-panel col s12 center-align">
                    <p class="facebook-label section-label"><span> FACEBOOK </span></p>
                </div>
                <div id="fb-root"></div>
                <script async defer crossorigin="anonymous"
                    src="https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v4.0&appId=2084171171889711&autoLogAppEvents=1"></script>
            </div>
            <div class="fb-page" data-href="https://www.facebook.com/<?=$cast->snss[0]['facebook']?>"
                data-tabs="timeline,messages" data-width="500" data-height="" data-small-header="false"
                data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                <blockquote cite="https://www.facebook.com/<?=$cast->snss[0]['facebook']?>/"
                    class="fb-xfbml-parse-ignore"><a
                        href="https://www.facebook.com/<?=$cast->snss[0]['facebook']?>/"></a></blockquote>
            </div>
            <?php endif;?>
            <!-- facebook END -->
            <!-- twitter START -->
            <?php if(!empty($cast->snss[0]['twitter'])): ?>
            <div id="twitter-section" class="row shop-menu section scrollspy">
                <div class="light-blue accent-2 card-panel col s12 center-align">
                    <p class="twitter-label section-label"><span> TWITTER </span></p>
                </div>
                <div class="twitter-box col">
                    <a class="twitter-timeline"
                        href="https://twitter.com/<?=$cast->snss[0]['twitter']?>?ref_src=twsrc%5Etfw"
                        data-tweet-limit="3">Tweets by <?=$shop->snss[0]['twitter']?></a>
                    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>
            </div>
            <?php endif;?>
            <!-- twitter END -->
            <!-- スタッフリスト START -->

            <div id="p-casts-section" class="row shop-menu section scrollspy">
				<div class="light-blue accent-2 card-panel col s12 center-align">
					<p class="casts-label section-label"><span> STAFF </span></p>
				</div>
				<?php if(count($other_casts) > 0): ?>
				<?php foreach($other_casts as $other_cast): ?>
				<div class="p-casts-section__list center-align col s3 m3 l3">
					<a class="p-casts-section__list__favorite btn-floating btn waves-effect waves-light grey lighten-1 modal-trigger" data-target="modal-login">
						<i class="material-icons p-casts-section__list__favorite__icon">favorite</i>
					</a>
					<a href="<?=DS.$shop['area'].DS.PATH_ROOT['CAST'].DS.$cast['id']?>">
						<img src="<?=$other_cast->icon?>" alt="<?=$other_cast->nickname?>" class="p-casts-section__list_img_circle circle">
					</a>
					<div class="p-casts-section__p-casts-section__list__icons">
						<?=isset($cast->new_cast) ? '<i class="material-icons icons__new-icon puyon">fiber_new</i>':''?>
						<?=isset($cast->update_cast) ? '<i class="material-icons icons__update-icon puyon">update</i>':''?>
					</div>
					<span class="p-casts-section__p-casts-section__list__name truncate"><?=$other_cast->nickname?></span>
				</div>
				<?php endforeach; ?>
				<?php else: ?>
				<p class="col">スタッフの登録はありません。</p>
				<?php endif; ?>
            </div>
            <!-- スタッフリスト END -->
        </div>
        <!--デスクトップ用 サイドバー START -->
        <?= $this->element('sidebar'); ?>
        <!--デスクトップ用 サイドバー END -->
    </div>
</div>
<!-- スタッフ用ボトムナビゲーション START -->
<?= $this->element('cast-bottom-navigation'); ?>
<!-- スタッフ用ボトムナビゲーション END -->