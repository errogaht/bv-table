<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContactAddUserFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            ALTER TABLE contacts
              ADD COLUMN created_by INT UNSIGNED AFTER source,
              ADD COLUMN taken_by INT UNSIGNED AFTER updated_at,
              ADD COLUMN taken_at DATETIME DEFAULT NULL,
              ADD CONSTRAINT `contacts_created_by_fk` FOREIGN KEY (created_by) REFERENCES users(id),
              ADD CONSTRAINT `contacts_work_by_fk` FOREIGN KEY (taken_by) REFERENCES users(id)
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("
            ALTER TABLE contacts
              DROP FOREIGN KEY `contacts_created_by_fk`,
              DROP FOREIGN KEY `contacts_work_by_fk`,
              DROP COLUMN created_by,
              DROP COLUMN taken_by,
              DROP COLUMN taken_at
        ");
    }

}
