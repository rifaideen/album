<?php

namespace humhub\modules\album\widgets;

use humhub\modules\comment\widgets\Comments as CommentsWidget;

class Comments extends CommentsWidget
{
    public static $autoIdPrefix = 'album_';
    public function run()
    {
        $modelName = $this->object->content->object_model;
        $modelId = $this->object->content->object_id;

        // Count all Comments
        $commentCount = \humhub\modules\comment\models\Comment::GetCommentCount($modelName, $modelId);
        $comments = \humhub\modules\comment\models\Comment::GetCommentsLimited($modelName, $modelId, 2);

        $isLimited = ($commentCount > 2);

        return $this->render('comments', array(
            'object' => $this->object,
            'comments' => $comments,
            'modelName' => $modelName,
            'modelId' => $modelId,
            'id' => self::$autoIdPrefix . $this->object->getUniqueId(),
            'isLimited' => $isLimited,
            'total' => $commentCount
        ));
    }
    
}