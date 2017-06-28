<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAkadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akads', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('notaris_id');
            $table->string('nama_debitur');
            $table->unsignedInteger('fasilitas_id');
            $table->unsignedInteger('plafond');
            $table->unsignedInteger('pendamping_id');
            $table->unsignedInteger('p_i_c_id');
            $table->timestamp('jam_akad_mulai');
            $table->timestamp('jam_akad_selesai');
            $table->unsignedInteger('ruangan_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        for ($i = 0; $i < 5; $i++) {
            $jamMulai = time() + (3600 * $i);
            DB::table('akads')->insert(
                ['notaris_id' => $i, 'nama_debitur' => 'Debitur ' . $i,
                 'fasilitas_id' => $i, 'plafond' => $i * 1000000,
                 'pendamping_id' => $i, 'p_i_c_id' => $i, 'jam_akad_mulai' => $jamMulai, 'jam_akad_selesai' => $jamMulai + 3600, 'ruangan_id' => $i,]
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('akads');
    }
}
