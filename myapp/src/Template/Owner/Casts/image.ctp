<?php
/**
* @var \App\View\AppView $this
* @var \App\Model\Entity\Owner[]|\Cake\Collection\CollectionInterface $owners
*/
?>
<div id="wrapper">
    <div class="container">
        <span id="dummy" style="display: hidden;"></span>
        <?= $this->Flash->render() ?>
        <h5><?=('画像アップロード') ?></h5>
            <div id="cast-image" class="row">
                <input type="hidden" name="file_max" value=<?=CAST_CONFIG['file_max']?>>
                    <?php for($i = 1; $i <= CAST_CONFIG['file_max']; $i++){
                            $infoArray;
                            if (!empty($cast['image'.$i])) { ?>
                            <div class="col s6 m4 l3 card-img image<?=$i?>">
                                <div class="card">
                                    <div class="card-image">
                                        <img class="materialboxed" data-caption="" height="120" width="100%" src="<?= "/".$infoArray['dir_path']."cast/".$cast->dir."/".$cast['image'.$i] ?>">
                                        <a class="btn-floating halfway-fab waves-effect waves-light red tooltipped" onclick="castImageDeleteBtn($('#delete-image<?=$i?>'),$('.image<?=$i?>'));return false;" data-position="bottom" data-delay="50" data-tooltip="削除"><i class="material-icons">delete</i></a>
                                    </div>
                                </div>
                            </div>
                            <form id="delete-image<?=$i?>" name="delete_image" method="post" action="/owner/casts/image/<?= $cast->id ?>">
                                <div style="display:none;">
                                    <input type="hidden" name="image_copy" value='<?=$cast ?>'>
                                    <input type="hidden" name="_method" value="POST">
                                    <input type="hidden" name="image_delete" value="">
                                    <input type="hidden" name="col_name" value=<?='image'.$i?>>
                                    <input type="hidden" name="filename" value=<?=$cast['image'.$i]?>>
                                </div>
                            </form>
                        <?php } ?>
                    <?php } ?>
            </div>
            <div class="row">
                <form id="edit-image" name="edit_image" method="post" accept-charset="utf-8" enctype="multipart/form-data" action="/owner/casts/image/<?= $cast->id ?>">
                    <div style="display:none;">
                        <input type="hidden" name="image_copy" value='<?=$cast ?>'>
                        <input type="hidden" name="_method" value="POST">
                        <input type="hidden" name="image_edit" value="">
                        <input type="hidden" name="image_edit_id" value="">
                    </div>
                    <div class="file-field input-field col s12 m6 l6">
                        <div class="btn">
                            <span>File</span>
                            <input type="file" id="image-file" name="image[]" onChange="castImgDisp($('#cast-image'));" multiple>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" name="top_image" type="text">
                        </div>
                        <canvas id="image-canvas" style="display:none;"></canvas>
                    </div>
                    <div class="input-field col s12 m12 l12">
                        <button type="button" class="waves-effect waves-light btn-large disabled cancelBtn" onclick="castCancelBtn();return false;">やめる</button>
                        <button type="button" class="waves-effect waves-light btn-large disabled saveBtn" onclick="castImageSaveBtn($('#edit-image'));return false;">確定</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

