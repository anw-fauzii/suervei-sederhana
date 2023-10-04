<?php

namespace App\Http\Controllers;

use App\Models\Survei;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use Validator;

class SurveiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Seragam::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn ='<a href="'.route('seragam.show', $row->id).'" data-toggle="tooltip" title="Edit" data-id="'.$row->id.'" data-original-title="Barcode" class="btn btn-success btn-sm barcod"><i class="metismenu-icon pe-7s-plugin"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" title="Edit" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-warning btn-sm edit"><i class="metismenu-icon pe-7s-pen"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" title="Hapus" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm delete"><i class="metismenu-icon pe-7s-trash"></i></a>';
                    return $btn;
                })
                ->addColumn('nama', function($data){
                    return $data->nama." (".$data->ukuran.")";
                })
                ->addColumn('harga_beli', function($data){
                    return "Rp ".number_format($data->harga_beli);
                })
                ->addColumn('harga_jual', function($data){
                    return "Rp ".number_format($data->harga_jual);
                })
                ->rawColumns(['action'])
                ->make(true);
            }
        return view('seragam.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $selectedEmoji = $request->input('emoji');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tamu  $tamu
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $survei = new Survei;
        $survei->nilai = $id;
        $survei->save();
        return redirect()->back()->with('sukses', 'Terima Kasih Masukannya');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tamu  $tamu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Tamu = Seragam::find($id);
        return response()->json($Tamu);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tamu  $tamu
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tamu  $tamu
     * @return \Illuminate\Http\Response
     */
    public function hapus($id)
    {
        $Tamu = Seragam::find($id);
        $Tamu->delete();
        return response()->json($Tamu);
    }
}
