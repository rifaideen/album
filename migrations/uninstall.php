<?php

use yii\db\Migration;

class uninstall extends Migration
{

    public $prefix = 'album_';
     
    public function up()
    {
        $this->dropTable($this->prefix.'album');
        $this->dropTable($this->prefix.'image');
    }
    public function down()
    {
        echo "uninstall does not support migration down.\n";
        return false;
    }

}