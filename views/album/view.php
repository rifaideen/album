<?php
/* @var $asset humhub\modules\album\Assets */
/* @var $this yii\base\View */

use humhub\modules\like\widgets\LikeLink as Like;
use humhub\modules\comment\widgets\CommentLink as Comment;
use humhub\modules\comment\widgets\Comments;
use yii\helpers\Url;

$assets = humhub\modules\album\Assets::register($this)->baseUrl;


$this->params = [
    [
      'label' => 'Album Details',
      'url' => Url::to(['/album/details', 'id' => $model->id, 'username' => $user->username])
    ],
    [
      'label' => 'Add Image',
      'url' => Url::to(['/album/create/image', 'id' => $model->id, 'username' => $user->username])
    ],
    [
      'label' => 'View Album',
      'url' => '#',
      'active' => true
    ],
    [
      'label' => 'Manage Albums',
      'url' => $user->createUrl('/album/admin')
    ]
];

?>

<section id="photostack" class="photostack">
    <div>
        <figure>
            <a class="photostack-img"><img src="<?= $model->cover != null ? $model->cover->url : $model->getRandomCoverImage($assets) ?>" alt="Album Cover" style="width: 240px;height: 240px;"/></a>
            <figcaption>
                <h2 class="photostack-title"><?= $model->name ?></h2>
                <div class="photostack-back">
                    <p><?= $model->description; ?></p>
                </div>
            </figcaption>
        </figure>
        <?php foreach ($model->images as $file): ?>
        
            <figure>
                <a class="photostack-img"><img src="<?= $file->image == null ? $model->getRandomCoverImage($assets) : $file->image->getPreviewImageUrl() ?>" alt="img05" style="width: 240px;height: 240px;"/></a>
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
<!-- show controls -->
<?php
echo Like::widget(['object' => $model]);
echo '&nbsp;&nbsp;';
echo Comment::widget(['object' => $model]);
echo Comments::widget(['object' => $model]);
?>
<script>
    new Photostack(document.getElementById('photostack'));
    $(document).ready(function () {
        $("#comment_create_post_Album_<?= $model->id ?>").css({
            left: "0px",
            opacity: "100",
            margin: "5px"
        });
        $("#comment_create_post_Album_<?= $model->id ?>").val("Comment");
    });
</script>