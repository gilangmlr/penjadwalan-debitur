<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('nik')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        DB::table('users')->insert(
            ['name' => 'Admin', 'nik' => '1234567890',
             'email' => 'admin@localhost.me', 'password' => Hash::make('admin')]
        );

        for ($i = 1; $i < 6; $i++) {
            DB::table('users')->insert(
                ['name' => 'Karyawan ' . $i, 'nik' => $i,
                 'email' => 'k' . $i . '@d.m', 'password' => Hash::make('pass' . $i)]
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
        Schema::dropIfExists('users');
    }
}
