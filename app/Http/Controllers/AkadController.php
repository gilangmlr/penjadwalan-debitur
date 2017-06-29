<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Notaris;
use App\Fasilitas;
use App\Pendamping;
use App\PIC;
use App\Ruangan;
use App\Akad;

class AkadController extends Controller
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

    public function view_create()
    {
        $notaris = Notaris::all();
        $fasilitas = Fasilitas::all();
        $pendamping = Pendamping::all();
        $pic = PIC::all();
        $ruangan = Ruangan::all();
        return view('akad_create', ["notaris" => $notaris, "fasilitas" => $fasilitas,
                                    "pendamping" => $pendamping, "pic" => $pic, "ruangan" => $ruangan]);
    }

    public function view_list()
    {
        return view('akad_list');
    }

    public function crud_create(Request $request)
    {
        $all = $request->all();
        DB::table('akads')->insert(
                ['notaris_id' => $all['id-notaris'], 'nama_debitur' => $all['nama-debitur'],
                 'fasilitas_id' => $all['id-fasilitas'], 'plafond' => (int) $all['plafond'],
                 'pendamping_id' => $all['id-pendamping'], 'p_i_c_id' => $all['id-pic'],
                 'jam_akad_mulai' => date("Y-m-d H:i:s", strtotime($all['jam-akad-mulai'])),
                 'jam_akad_selesai' => date("Y-m-d H:i:s", strtotime($all['jam-akad-selesai'])),
                 'ruangan_id' => $all['id-ruangan']]
            );
    }

    public function get_db_table_name_from_datatables_column_index($idx) {
        switch($idx) {
            case 0:
                return 'akad';
                break;
            case 1:
                return 'akad';
                break;
            case 2:
                return 'fasilitas';
                break;
            case 3:
                return 'akad';
                break;
            case 4:
                return 'notaris';
                break;
            case 5:
                return 'akad';
                break;
            case 6:
                return 'akad';
                break;
            case 7:
                return 'pendamping';
                break;
            case 8:
                return 'p_i_cs';
                break;
        }
    }

    public function crud_list(Request $request)
    {
        $all = $request->all();

        $akad = DB::table('akads')->select('akads.*');
        if ($request->has('order')) {
            foreach($all['order'] as $arr) {
                if ($arr['column'] == 2) {
                    $table_name = 'fasilitas';
                    $akad_fk = $table_name . '_id';
                }
                else if ($arr['column'] == 4) {
                    $table_name = 'notaris';
                    $akad_fk = $table_name . '_id';
                }
                else if ($arr['column'] == 7) {
                    $table_name = 'pendampings';
                    $akad_fk = 'pendamping_id';
                }
                else if ($arr['column'] == 8) {
                    $table_name = 'p_i_cs';
                    $akad_fk = 'p_i_c_id';
                }

                $akad = $akad->leftJoin($table_name, 'akads.' . $akad_fk,
                        '=', $table_name . '.id')
                        ->orderBy($table_name . '.name', $arr['dir']);
            }
        }
        $akad = $akad->get();
        $akad = $akad->map(function($item, $key) {
            return [$item->id, $item->nama_debitur, Fasilitas::find($item->fasilitas_id)->name,
                    $item->plafond, Notaris::find($item->notaris_id)->name,
                    $item->jam_akad_mulai, $item->jam_akad_selesai,
                    Pendamping::find($item->pendamping_id)->name, PIC::find($item->p_i_c_id)->name];
        });

        $recordsTotal = count($akad);
        $recordsFiltered = $recordsTotal;
        return ['draw' => (int) $all['draw'], 'recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered, 'data' => $akad];
    }
}
