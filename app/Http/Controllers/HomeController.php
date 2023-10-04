<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survei;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','revalidate']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dataPerTanggal = Survei::select(
            DB::raw('DATE(created_at) as tanggal'),
            DB::raw('SUM(CASE WHEN nilai = 4 THEN 1 ELSE 0 END) as nilai_4'),
            DB::raw('SUM(CASE WHEN nilai = 3 THEN 1 ELSE 0 END) as nilai_3'),
            DB::raw('SUM(CASE WHEN nilai = 2 THEN 1 ELSE 0 END) as nilai_2'),
            DB::raw('SUM(CASE WHEN nilai = 1 THEN 1 ELSE 0 END) as nilai_1'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('tanggal')->orderBy('tanggal','DESC')
        ->get();
        $currentDate = date('Y-m-d');
        $sangatPuas = Survei::where('nilai',4)->whereDate('created_at', $currentDate)->count();
        $puas = Survei::where('nilai',3)->whereDate('created_at', $currentDate)->count();
        $biasaSaja = Survei::where('nilai',2)->whereDate('created_at', $currentDate)->count();
        $tidakPuas = Survei::where('nilai', 1)->whereDate('created_at', $currentDate)->count();
        return view('home',compact('sangatPuas','puas','biasaSaja','tidakPuas','dataPerTanggal'));
    }
    
}
