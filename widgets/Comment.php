<?php

namespace humhub\modules\album\widgets;

/**
 * This widget is used to show a single comment.
 *
 * It will used by the CommentsWidget and the CommentController to show comments.
 *
 */
class Comment extends \yii\base\Widget
{
    
    public static $autoIdPrefix = 'album_';

    /**
     * @var Comment object to display
     */
    public $comment = null;

    /**
     * Indicates the comment was just edited
     *
     * @var boolean
     */
    public $justEdited = false;

    /**
     * Executes the widget.
     */
    public function run()
    {

        $user = $this->comment->user;

        return $this->render('showComment', array(
            'comment' => $this->comment,
            'user' => $user,
            'justEdited' => $this->justEdited,
            'id' => self::$autoIdPrefix
        ));
    }

}

?>