<?php

use yii\db\Schema;
use yii\db\Migration;

class m160121_142629_create_album_table extends Migration
{
    public $prefix = 'album_';
    
    public function up()
    {
        $this->createTable($this->prefix . 'album', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_TEXT . '(500) NULL',
            'created_at' => Schema::TYPE_DATETIME . ' NULL',
            'updated_at' => Schema::TYPE_DATETIME . ' NULL',
            'created_by' => Schema::TYPE_INTEGER,
            'updated_by' => Schema::TYPE_INTEGER
        ]);
        
        $this->createTable($this->prefix.'image', [
            'id' => Schema::TYPE_PK,
            'album_id'=>Schema::TYPE_INTEGER . ' NOT NULL',
            'name'=> Schema::TYPE_STRING . ' NOT NULL',
            'description'=> Schema::TYPE_STRING . ' NOT NULL',
            'created_at'=> Schema::TYPE_DATETIME . ' NULL',
            'updated_at'=> Schema::TYPE_DATETIME . ' NULL'
        ]);
        
        $this->addForeignKey($this->prefix.'fk_album', $this->prefix.'image', 'album_id', $this->prefix.'album', 'id','CASCADE','CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey($this->prefix.'fk_album',$this->prefix.'image');
        $this->dropTable($this->prefix.'album');
        $this->dropTable($this->prefix.'image');
    }
    
}
