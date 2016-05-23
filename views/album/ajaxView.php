<?php
/* @var $this AlbumController */
/* @var $model Album */
use humhub\modules\like\widgets\LikeLink as Like;
use humhub\modules\album\widgets\CommentLink as Comment;
use humhub\modules\album\widgets\Comments;
use humhub\widgets\RichText;
?>
<?php
$assets = humhub\modules\album\Assets::register($this)->baseUrl;
$uniqueID = uniqid();
?>
<div class="row">
    <div class="col-lg-9">
        <section id="photostack-<?= $uniqueID ?>" class="photostack">
        <div>
            <figure>
                <a class="photostack-img"><img src="<?= $model->cover == null ? $model->getRandomCoverImage($assets) : $model->cover->getPreviewImageUrl() ?>" alt="Album Cover" style="width: 240px;height: 240px;"/></a>
                <figcaption>
                    <h2 class="photostack-title"><?= RichText::widget(['text' => $model->name]) ?></h2>
                    <div class="photostack-back">
                        <p><?= $model->description; ?></p>
                    </div>
                </figcaption>
            </figure>
            <?php foreach ($model->images as $file): ?>
                <figure>
                    <a class="photostack-img"><img src="<?= $file->image->url ?>" alt="img05" style="width: 240px;height: 240px;"/></a>
                    <figcaption>
                        <h2 class="photostack-title"><?= $file->name; ?></h2>
                        <div class="photostack-back">
                            <p><?= $file->description ?></p>
                        </div>
                    </figcaption>
                </figure>
            <?php endforeach; ?>
        </div>
    </section>
    </div>
    <div class="col-lg-3">
        <h4><?= RichText::widget(['text' => $model->name]) ?></h4>
        <hr>
        <span><?= $model->description ?></span>
        <hr>
        <?php
        echo Like::widget(['object' => $model]);
        echo '&nbsp;&nbsp;';
        echo Comment::widget(['object' => $model]);
        echo Comments::widget(['object' => $model]);
        ?>
    </div>
</div>
<script>
        new Photostack( document.getElementById( 'photostack-<?= $uniqueID ?>' ) );
</script>
