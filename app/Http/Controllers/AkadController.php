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

    public function crud_list(Request $request)
    {
        $akad = Akad::all();
        $akad = $akad->map(function($item, $key) {
            return [$item->id, $item->nama_debitur, Fasilitas::find($item->fasilitas_id)->name,
                    $item->plafond, Notaris::find($item->notaris_id)->name,
                    $item->jam_akad_mulai, $item->jam_akad_selesai,
                    Pendamping::find($item->pendamping_id)->name, PIC::find($item->p_i_c_id)->name];
        });
        $all = $request->all();

        $recordsTotal = count($akad);
        $recordsFiltered = $recordsTotal;
        return ['draw' => (int) $all['draw'], 'recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered, 'data' => $akad];
    }
}
