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

        return redirect()->route('view-akad-list');
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
        
        $table_name = ['fasilitas', 'notaris', 'pendampings', 'p_i_cs', 'ruangans'];
        $akad_fk = ['fasilitas_id', 'notaris_id', 'pendamping_id', 'p_i_c_id', 'ruangan_id'];
        foreach ($table_name as $key => $value) {
            $akad = $akad->leftJoin($value, 'akads.' . $akad_fk[$key], '=', $value . '.id');
        }

        if (!is_null($all['search']['value'])) {
            $columns = ['akads.id', 'akads.nama_debitur', 'fasilitas.name', 'akads.plafond',
                        'notaris.name', 'akads.jam_akad_mulai', 'akads.jam_akad_selesai',
                        'pendampings.name', 'p_i_cs.name', 'ruangans.name'];

            foreach ($columns as $key => $value) {
                $akad = $akad->orWhere($value, 'like', '%' . $all['search']['value'] . '%');
            }
        }

        $column_name = '';
        foreach ($all['columns'] as $key => $value) {
            if ($value['searchable'] && !is_null($value['search']['value'])) {
                if ($key == 2) {
                    $column_name = 'fasilitas.name';
                }
                else if ($key == 4) {
                    $column_name = 'notaris.name';
                }
                else if ($key == 7) {
                    $column_name = 'pendampings.name';
                }
                else if ($key == 8) {
                    $column_name = 'p_i_cs.name';
                }
                else if ($key == 9) {
                    $column_name = 'ruangans.name';
                }
                else {
                    continue;
                }
            }
        }

        if ($column_name != '') {
            foreach ($all['columns'] as $key => $value) {
                if ($value['searchable']) {
                    if ($key == 2) {
                        $column_name_spec = 'fasilitas.name';
                    }
                    else if ($key == 4) {
                        $column_name_spec = 'notaris.name';
                    }
                    else if ($key == 7) {
                        $column_name_spec = 'pendampings.name';
                    }
                    else if ($key == 8) {
                        $column_name_spec = 'p_i_cs.name';
                    }
                    else if ($key == 9) {
                        $column_name_spec = 'ruangans.name';
                    }
                    else {
                        continue;
                    }

                    if ($column_name_spec !== $column_name) {
                        continue;
                    }

                    $akad = $akad->orWhere($column_name, 'like',
                                            '%' . $value['search']['value'] . '%');
                }
            }
        }

        if ($request->has('order')) {
            foreach($all['order'] as $arr) {
                if (!$all['columns'][$arr['column']]['orderable']) {
                    continue;
                }
                if ($arr['column'] == 2) {
                    $table_name = 'fasilitas';
                }
                else if ($arr['column'] == 4) {
                    $table_name = 'notaris';
                }
                else if ($arr['column'] == 7) {
                    $table_name = 'pendampings';
                }
                else if ($arr['column'] == 8) {
                    $table_name = 'p_i_cs';
                }

                $akad = $akad->orderBy($table_name . '.name', $arr['dir']);
            }
        }

        $recordsTotal = count($akad->get());
        $recordsFiltered = $recordsTotal;
        
        $akad = $akad->offset($all['start'])->limit($all['length'])->get();
        $akad = $akad->map(function($item, $key) {
            $plafond = 'Rp. ' . number_format($item->plafond, 0 , '' , '.') . ',-';
            
            $jam_mulai = explode(':', explode(' ', $item->jam_akad_mulai)[1]);
            $jam_mulai = $jam_mulai[0] . ':' . $jam_mulai[1];

            $jam_selesai = explode(':', explode(' ', $item->jam_akad_selesai)[1]);
            $jam_selesai = $jam_selesai[0] . ':' . $jam_selesai[1];

            return [$item->id, $item->nama_debitur, Fasilitas::find($item->fasilitas_id)->name,
                    $plafond, Notaris::find($item->notaris_id)->name, $jam_mulai, $jam_selesai,
                    Pendamping::find($item->pendamping_id)->name,
                    PIC::find($item->p_i_c_id)->name, Ruangan::find($item->ruangan_id)->name];
        });

        return ['draw' => (int) $all['draw'], 'recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered, 'data' => $akad];
    }
}
