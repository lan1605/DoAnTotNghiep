<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER update_insert AFTER INSERT ON cau_hois FOR EACH ROW UPDATE bai_taps SET tong_cauhoi = tong_cauhoi+1 WHERE id_baihoc = NEW.id_baihoc;
        CREATE TRIGGER update_delete AFTER DELETE ON cau_hois FOR EACH ROW UPDATE bai_taps SET tong_cauhoi = tong_cauhoi-1 WHERE id_baihoc = OLD.id_baihoc;');
    }
    
    public function down()
    {
        DB::unprepared('DROP TRIGGER `update_insert`;
        DROP TRIGGER `update_delete`;');
    }
};
