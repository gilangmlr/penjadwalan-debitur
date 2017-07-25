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
            if ($item->id % 2 == 0) {
                $permission['buat_akad'] = true;
            }
            else {
                $permission['buat_akad'] = false;
            }
            if ($item->id % 2 != 0) {
                $permission['ubah_akad'] = true;
            }
            else {
                $permission['ubah_akad'] = false;
            }
            if ($item->id % 2 == 0) {
                $permission['hapus_akad'] = true;
            }
            else {
                $permission['hapus_akad'] = false;
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