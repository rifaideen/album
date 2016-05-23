<?php

use humhub\modules\like\widgets\LikeLink as Like;
use humhub\modules\comment\widgets\CommentLink as Comment;
use humhub\modules\comment\widgets\Comments;
use humhub\widgets\RichText;

$id = $model->id;
$assets = humhub\modules\album\Assets::register($this)->baseUrl;
?>
<a data-toggle="modal" data-target="#album-modal-<?= $id ?>">
    <img src="<?= $model->cover == null ? $model->getRandomCoverImage($assets) : $model->cover->getPreviewImageUrl() ?>" class="img-responsive">
</a>
<a href="<?php echo $model->content->user->createUrl('/album/view', array('id' => $model->id, 'username' => $model->content->user->username, 'uguid' => $model->content->user->guid)); ?>">
    <h4><?= RichText::widget(['text' => $model->name]) ?></h4>
</a>
<p>
    <?= $model->description ?>
</p>
<hr>
<?php
echo Like::widget(['object' => $model]);
echo '&nbsp;&nbsp;';
echo Comment::widget(['object' => $model]);
echo Comments::widget(['object' => $model]);
?>

<div class="modal fade" id="album-modal-<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-shown="false">
    <div class="modal-dialog" style="width: 1200px;height: 600px;">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="loader"></div>
                <div class="row album-content"></div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#album-modal-<?= $id ?>').on('shown.bs.modal', function (e) {
        $.ajax({
            url: "<?= yii\helpers\Url::to(['/album/wall-entry','id'=>$id, 'username' => $model->content->user->username]) ?>",
            success: function(data){
                $('#album-modal-<?= $id ?>' + ' .loader').hide();
                $('#album-modal-<?= $id ?>' + ' .album-content').html(data);
                $('#album-modal-<?= $id ?>' + ' .modal-footer').show();
            }
        });
    });
    $('#album-modal-<?= $id ?>').on('hidden.bs.modal', function (e) {
        $('#album-modal-<?= $id ?>' + ' .loader').show();
        $('#album-modal-<?= $id ?>' + ' .album-content').html(null);
        $('#album-modal-<?= $id ?>' + ' .modal-footer').hide();
    });
</script>
