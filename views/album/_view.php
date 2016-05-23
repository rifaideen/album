<?php
/* @var $this AlbumController */
/* @var $model Album */
use yii\helpers\Url;
use humhub\widgets\RichText;
$assets = humhub\modules\album\Assets::register($this)->baseUrl;
?>
<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img
            class="img-rounded"
            src="<?= $model->cover == null ? $model->getRandomCoverImage($assets) : $model->cover->getPreviewImageUrl() ?>"
            style="width:181px; height: 113px;"
            >
        <div class="caption text-center">
            <h3>
                <a href="<?= Url::to(['/album/view','id'=>$model->id,'username' => $user->username]) ?>">
                    <?= RichText::widget(['text' => $model->name]) ?>
                </a>
            </h3>
        </div>
    </div>
</div>
