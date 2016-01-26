<?php

namespace humhub\modules\album\controllers;

use humhub\modules\comment\controllers\CommentController as BaseController;
use humhub\modules\comment\models\Comment;
use Yii;

/**
 * CommentController provides all comment related actions.
 * 
 * @author Rifaudeen<rifajas@gmail.com>
 */
class CommentController extends BaseController
{
    
    public static $autoPrefixId = 'album_';
    
    public function actionEdit()
    {
        $this->loadContentAddon(Comment::className(), Yii::$app->request->get('id'));

        if (!$this->contentAddon->canWrite()) {
            throw new HttpException(403, Yii::t('CommentModule.controllers_CommentController', 'Access denied!'));
        }

        if ($this->contentAddon->load(Yii::$app->request->post()) && $this->contentAddon->validate() && $this->contentAddon->save()) {

            // Reload comment to get populated updated_at field
            $this->contentAddon = Comment::findOne(['id' => $this->contentAddon->id]);

            return $this->renderAjaxContent(\humhub\modules\album\widgets\Comment::widget([
                'comment' => $this->contentAddon,
                'justEdited' => true
            ]));
        }

        return $this->renderAjax('edit', array(
                    'comment' => $this->contentAddon,
                    'contentModel' => $this->contentAddon->object_model,
                    'contentId' => $this->contentAddon->object_id,
                    'id' => self::$autoPrefixId
        ));
    }

    /**
     * Handles AJAX Request for Comment Deletion.
     * Currently this is only allowed for the Comment Owner.
     */
    public function actionDelete()
    {
        $this->forcePostRequest();
        $this->loadContentAddon(Comment::className(), Yii::$app->request->get('id'));

        if ($this->contentAddon->canDelete()) {
            $this->contentAddon->delete();
        } else {
            throw new HttpException(500, Yii::t('CommentModule.controllers_CommentController', 'Insufficent permissions!'));
        }
    }

}
