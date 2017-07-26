<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;

use App\User;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view_users()
    {
        $users = User::all()->map(function($item, $key) {
            $permission = [];
            if ($item->ability('admin,buat-akad-role', 'buat-akad')) {
                $permission['buat_akad'] = true;
            }
            else {
                $permission['buat_akad'] = false;
            }
            if ($item->ability('admin,lihat-akad-role', 'lihat-akad')) {
                $permission['lihat_akad'] = true;
            }
            else {
                $permission['lihat_akad'] = false;
            }
            if ($item->ability('admin,ubah-akad-role', 'ubah-akad')) {
                $permission['ubah_akad'] = true;
            }
            else {
                $permission['ubah_akad'] = false;
            }
            if ($item->ability('admin,hapus-akad-role', 'hapus-akad')) {
                $permission['hapus_akad'] = true;
            }
            else {
                $permission['hapus_akad'] = false;
            }
            if ($item->ability('admin,pantau-akad-role', 'pantau-akad')) {
                $permission['pantau_akad'] = true;
            }
            else {
                $permission['pantau_akad'] = false;
            }
            if ($item->ability('admin,lihat-pengguna-role', 'lihat-pengguna')) {
                $permission['lihat_pengguna'] = true;
            }
            else {
                $permission['lihat_pengguna'] = false;
            }
            if ($item->ability('admin,ubah-pengguna-role', 'ubah-pengguna')) {
                $permission['ubah_pengguna'] = true;
            }
            else {
                $permission['ubah_pengguna'] = false;
            }
            if ($item->ability('admin,buat-komentar-role', 'buat-komentar')) {
                $permission['buat_komentar'] = true;
            }
            else {
                $permission['buat_komentar'] = false;
            }
            if ($item->ability('admin,buat-laporan-role', 'buat-laporan')) {
                $permission['buat_laporan'] = true;
            }
            else {
                $permission['buat_laporan'] = false;
            }
            $permission = ['permissions' => $permission];
            return array_merge($item->toArray(), $permission);
        });
        return view('admin_users', ["users" => $users]);
    }

    public function crud_users_edit(Request $req) {
        $all = $req->all();
        if ($req->has('buat-akad')) {
            echo "buat";
        }
        if ($req->has('ubah-akad')) {
            echo "ubah";
        }
        if ($req->has('hapus-akad')) {
            echo "hapus";
        }
    }
}