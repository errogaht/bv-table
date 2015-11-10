<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableContactLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TABLE contact_logs (
              id int(10) unsigned NOT NULL AUTO_INCREMENT,
              user_id int(10) unsigned NOT NULL,
              contact_id int(10) unsigned NOT NULL,
              created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              comment text NOT NULL,
              PRIMARY KEY (id),
              CONSTRAINT contact_comments_contact_id_fk FOREIGN KEY (contact_id) REFERENCES contacts (id),
              CONSTRAINT contact_comments_user_id_fk FOREIGN KEY (user_id) REFERENCES users (id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
        ");
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP TABLE contact_logs");
    }
}
