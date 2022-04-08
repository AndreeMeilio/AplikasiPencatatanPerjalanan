<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAddPerjalananTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
        CREATE TRIGGER log_perjalanan AFTER INSERT ON perjalanan FOR EACH ROW 
                BEGIN
                    INSERT INTO log(log.id_table, log.nik, log.desc, log.created_at, log.updated_at) values (
                        NEW.id_perjalanan,
                        NEW.nik,
                        CONCAT('Menambahkan Data Perjalanan Baru Lokasi ', NEW.lokasi),
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
        DB::unprepared("
            DROP TRIGGER 'log_perjalanan'
        ");
    }
}
