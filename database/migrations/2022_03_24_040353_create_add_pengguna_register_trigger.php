<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAddPenggunaRegisterTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
        CREATE TRIGGER log_register_pengguna AFTER INSERT ON pengguna FOR EACH ROW 
        BEGIN
            INSERT INTO log(log.id_table, log.nik, log.desc, log.created_at, log.updated_at) values (
                NEW.nik,
                NEW.nik,
                'Akun Anda Terdaftar Pada Aplikasi Peduli Diri',
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
            DROP TRIGGER 'log_register_pengguna'
        ");
    }
}
