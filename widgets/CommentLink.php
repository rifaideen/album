<?php

namespace humhub\modules\album\widgets;

use humhub\modules\comment\widgets\CommentLink as CommentLinkWidget;

class CommentLink extends CommentLinkWidget
{
    public static $autoIdPrefix = 'ajax_';
    
    /**
     * Executes the widget.
     */
    public function run()
    {

        if ($this->mode == "")
            $this->mode = self::MODE_INLINE;

        return $this->render('@humhub/modules/comment/widgets/views/link', array(
            'id' => self::$autoIdPrefix . $this->object->getUniqueId(),
            'mode' => $this->mode,
            'objectModel' => $this->object->content->object_model,
            'objectId' => $this->object->content->object_id,
        ));
    }
}