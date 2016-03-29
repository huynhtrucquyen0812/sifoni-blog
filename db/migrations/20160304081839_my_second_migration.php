<?php

use Phinx\Migration\AbstractMigration;

class MySecondMigration extends AbstractMigration
{
    /**
     *  Migrate Up.
     */
    public function up()
    {
        $exists = $this->hasTable('posts');
        if(!$exists){
            $posts = $this->table('posts');
            $posts->addColumn('title', 'string', ['limit'=>255])
                  ->addColumn('target', 'string', ['limit'=>255])
                  ->addColumn('content', 'text')
                  ->addColumn('user_id', 'integer')
                  ->addColumn('created', 'datetime', ['default'=>'CURRENT_TIMESTAMP'])
                  ->addColumn('updated', 'datetime', ['null'=>true, 'update'=>'CURRENT_TIMESTAMP'])
                  ->addColumn('published', 'datetime', ['null'=>true])
                  ->addIndex(['title', 'target'], ['unique'=>true])
                  ->addIndex('user_id')
                  ->addForeignKey('user_id', 'users', 'id', ['delete'=>'NO_ACTION', 'update'=>'NO_ACTION'])
                  ->save();
        }
    }

    /**
     *  Migrate Down.
     */
    public function down()
    {
        $this->dropTable('posts');
    }
}
