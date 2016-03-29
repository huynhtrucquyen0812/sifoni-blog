<?php

use Phinx\Migration\AbstractMigration;

class MyNewMigration extends AbstractMigration
{
    /**
     *  Migrate Up.
     */
    public function up()
    {
        $exists = $this->hasTable('users');
        if(!$exists){
            $users = $this->table('users');
            $users->addColumn('username', 'string', ['limit'=>20])
                  ->addColumn('password', 'string', ['limit'=>40])
                  ->addColumn('email', 'string', ['limit'=>100])
                  ->addColumn('first_name', 'string', ['limit'=>30])
                  ->addColumn('last_name', 'string', ['limit'=>30])
                  ->addColumn('created', 'datetime', ['default'=>'CURRENT_TIMESTAMP'])
                  ->addColumn('updated', 'datetime', ['null'=>true, 'update'=>'CURRENT_TIMESTAMP'])
                  ->addIndex(['username', 'email'], ['unique'=>true])
                  ->save();
        }
    }

    /**
     *  Migrate Down.
     */
    public function down()
    {
        $this->dropTable('users');
    }
}
