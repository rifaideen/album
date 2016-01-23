<?php

namespace humhub\modules\album\widgets;

/**
 * @inheritdoc
 */
class WallEntry extends \humhub\modules\content\widgets\WallEntry
{

    /**
     * @inheritdoc
     */
    public $editRoute = "/post/post/edit";
    
    public $wallEntryLayout = '@humhub/modules/album/widgets/views/wallEntry.php';

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->render('content', array('model' => $this->contentObject, 'justEdited' => $this->justEdited));
    }

}
