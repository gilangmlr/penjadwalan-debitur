<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notaris;
use App\Fasilitas;
use App\Pendamping;
use App\PIC;
use App\Ruangan;

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

    /**
     * @return \Illuminate\Http\Response
     */
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

    public function crud_create()
    {
        
    }
}
