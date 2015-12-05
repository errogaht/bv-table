<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IsAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            ALTER TABLE users
              ADD COLUMN is_admin enum('N','Y') NOT NULL DEFAULT 'N' AFTER id,
              ADD COLUMN is_active enum('N','Y') NOT NULL DEFAULT 'N' AFTER is_admin;

            UPDATE users SET is_active='Y', is_admin='Y' WHERE email='maxim.oleinik@gmail.com';
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
            ALTER TABLE users
                DROP COLUMN is_admin,
                DROP COLUMN is_active
        ");
    }
}
