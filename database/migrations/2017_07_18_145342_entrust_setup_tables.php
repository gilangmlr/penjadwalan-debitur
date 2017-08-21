<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

use App\Permission;
use App\Role;
use App\User;

class EntrustSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Create table for storing roles
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create table for associating roles to users (Many-to-Many)
        Schema::create('role_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'role_id']);
        });

        // Create table for storing permissions
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });

        $buat_akad = new Permission();
        $buat_akad->name = 'buat-akad';
        $buat_akad->save();

        $lihat_akad = new Permission();
        $lihat_akad->name = 'lihat-akad';
        $lihat_akad->save();

        $ubah_akad = new Permission();
        $ubah_akad->name = 'ubah-akad';
        $ubah_akad->save();

        $hapus_akad = new Permission();
        $hapus_akad->name = 'hapus-akad';
        $hapus_akad->save();

        $pantau_akad = new Permission();
        $pantau_akad->name = 'pantau-akad';
        $pantau_akad->save();

        $buat_pengguna = new Permission();
        $buat_pengguna->name = 'buat-pengguna';
        $buat_pengguna->save();

        $lihat_pengguna = new Permission();
        $lihat_pengguna->name = 'lihat-pengguna';
        $lihat_pengguna->save();

        $ubah_pengguna = new Permission();
        $ubah_pengguna->name = 'ubah-pengguna';
        $ubah_pengguna->save();

        $hapus_pengguna = new Permission();
        $hapus_pengguna->name = 'hapus-pengguna';
        $hapus_pengguna->save();

        $buat_komentar = new Permission();
        $buat_komentar->name = 'buat-komentar';
        $buat_komentar->save();

        $buat_laporan = new Permission();
        $buat_laporan->name = 'buat-laporan';
        $buat_laporan->save();

        $admin = new Role();
        $admin->name = 'admin';
        $admin->save();

        $admin->attachPermissions([$buat_akad, $lihat_akad, $ubah_akad, $hapus_akad, $pantau_akad]);
        $admin->attachPermissions([$buat_pengguna, $lihat_pengguna, $ubah_pengguna, $hapus_pengguna]);
        $admin->attachPermission($buat_komentar);
        $admin->attachPermission($buat_laporan);

        $user = new Role();
        $user->name = 'user';
        $user->save();

        $user->attachPermissions([$buat_akad, $lihat_akad, $pantau_akad]);

        User::where('nik', '=', '1234567890')->first()->attachRole($admin);
        User::where('nik', '=', '1')->first()->attachRole($user);
        User::where('nik', '=', '2')->first()->attachRole($user);
        User::where('nik', '=', '3')->first()->attachRole($user);
        User::where('nik', '=', '4')->first()->attachRole($user);
        User::where('nik', '=', '5')->first()->attachRole($user);

        $buat_akad_role = new Role();
        $buat_akad_role->name = 'buat-akad-role';
        $buat_akad_role->save();

        $lihat_akad_role = new Role();
        $lihat_akad_role->name = 'lihat-akad-role';
        $lihat_akad_role->save();

        $ubah_akad_role = new Role();
        $ubah_akad_role->name = 'ubah-akad-role';
        $ubah_akad_role->save();

        $hapus_akad_role = new Role();
        $hapus_akad_role->name = 'hapus-akad-role';
        $hapus_akad_role->save();

        $pantau_akad_role = new Role();
        $pantau_akad_role->name = 'pantau-akad-role';
        $pantau_akad_role->save();

        $buat_pengguna_role = new Role();
        $buat_pengguna_role->name = 'buat-pengguna-role';
        $buat_pengguna_role->save();

        $lihat_pengguna_role = new Role();
        $lihat_pengguna_role->name = 'lihat-pengguna-role';
        $lihat_pengguna_role->save();

        $ubah_pengguna_role = new Role();
        $ubah_pengguna_role->name = 'ubah-pengguna-role';
        $ubah_pengguna_role->save();

        $hapus_pengguna_role = new Role();
        $hapus_pengguna_role->name = 'hapus-pengguna-role';
        $hapus_pengguna_role->save();

        $buat_komentar_role = new Role();
        $buat_komentar_role->name = 'buat-komentar-role';
        $buat_komentar_role->save();

        $buat_laporan_role = new Role();
        $buat_laporan_role->name = 'buat-laporan-role';
        $buat_laporan_role->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('permission_role');
        Schema::drop('permissions');
        Schema::drop('role_user');
        Schema::drop('roles');
    }
}
