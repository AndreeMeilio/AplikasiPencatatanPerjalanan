<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDeletePerjalananTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
        CREATE TRIGGER log_delete_perjalanan AFTER DELETE ON perjalanan FOR EACH ROW 
        BEGIN
            INSERT INTO log(log.id_table, log.nik, log.desc, log.created_at, log.updated_at) values (
                OLD.id_perjalanan,
                OLD.nik,
                'Anda Menghapus Data Perjalanan',
                now(),
                now()
            );
        END
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP TRIGGER log_delete_perjalanan");
    }
}
