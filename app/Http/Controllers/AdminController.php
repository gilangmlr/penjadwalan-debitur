<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;

use App\User;
use App\Role;

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
        $permissions = ['buat-akad', 'lihat-akad', 'ubah-akad', 'hapus-akad', 'pantau-akad', 'lihat-pengguna', 'ubah-pengguna', 'buat-komentar', 'buat-laporan'];
        $fn = function($item) {
            return explode('-', $item);
        };
        $permissionsArr = array_map($fn, $permissions);
        $halved = array_chunk($permissionsArr, ceil(count($permissionsArr)/2));
        $permissionsOne = $halved[0];
        $permissionsTwo = $halved[1];
        $users = User::all()->map(function($item, $key) use($permissions) {
            $permission = [];
            foreach ($permissions as $key => $value) {
                if ($item->ability('admin,' . $value . '-role', $value)) {
                    $permission[$value] = true;
                }
                else {
                    $permission[$value] = false;
                }
            }
            $permission = ['permissions' => $permission];
            return array_merge($item->toArray(), $permission);
        });
        return view('admin_users', ["users" => $users, "permissions" => $permissions, "permissionsOne" => $permissionsOne, "permissionsTwo" => $permissionsTwo]);
    }

    public function crud_users_edit(Request $req) {
        $all = $req->all();
        $user = User::where('nik', '=', $all['nik'])->first();
        $permissions = ['buat-akad', 'lihat-akad', 'ubah-akad', 'hapus-akad', 'pantau-akad', 'lihat-pengguna', 'ubah-pengguna', 'buat-komentar', 'buat-laporan'];
        foreach ($permissions as $key => $value) {
            if ($req->has($value)) {
                if (!$user->ability($value . '-role, admin', $value)) {
                    $role = Role::where('name', '=', $value . '-role')->first();
                    $user->attachRole($role);
                }
            }
            else {
                if ($user->ability($value . '-role, admin', $value)) {
                    $role = Role::where('name', '=', $value . '-role')->first();
                    $user->detachRole($role);
                }
            }
        }
    }
}