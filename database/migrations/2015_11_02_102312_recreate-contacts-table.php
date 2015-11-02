<?php

use Illuminate\Database\Migrations\Migration;

class RecreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TABLE contacts (
              id int(10) unsigned NOT NULL AUTO_INCREMENT,
              user_id int(10) unsigned,
              status SMALLINT UNSIGNED NOT NULL DEFAULT 1,

              name varchar(255) NOT NULL,
              phone varchar(16) NOT NULL,
              email varchar(255) NOT NULL,
              city varchar(255) NOT NULL,
              metro varchar(255),
              age int(11),
              how_long text,
              preferred_date text,
              comment text,
              source varchar(255) NOT NULL,

              created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              updated_at timestamp,

              PRIMARY KEY (id),
              KEY contacts_user_id_foreign (user_id),
              CONSTRAINT contacts_user_id_foreign FOREIGN KEY (user_id) REFERENCES users (id)
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
        DB::unprepared("DROP TABLE contacts");
    }
}
