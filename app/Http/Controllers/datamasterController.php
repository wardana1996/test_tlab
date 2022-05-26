<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Bahan;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Requests\datamasterRequest;

class datamasterController extends Controller
{
    public function indexKategori (Request $request) {
        if ($request->ajax()) {
            $data = Kategori::orderBy('id','desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<a href="#" class="editDataMasterKategori" data-id='.$row->id.' data-toggle="modal" data-target="#modalEdit"><i class="fa fa-edit fa-fw text-warning"></i></a> &nbsp;
                        <a href="#" data-id='.$row->id.' class="delete"><i class="fa fa-trash fa-fw text-danger"></i></a> &nbsp;';
                        return $btn;
                })
              ->rawColumns(['action'])
              ->make(true);
            }
            return view('data_master');
    }  

    public function indexBahan (Request $request) {
        if ($request->ajax()) {
            $data = Bahan::orderBy('id','desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<a href="#" class="editDataMasterBahan" data-id='.$row->id.' data-toggle="modal" data-target="#modalEdit"><i class="fa fa-edit fa-fw text-warning"></i></a> &nbsp;
                        <a href="#" data-id='.$row->id.' class="deletebahan"><i class="fa fa-trash fa-fw text-danger"></i></a> &nbsp;';
                        return $btn;
                })
              ->rawColumns(['action'])
              ->make(true);
            }
            return view('data_master');
    }  

    public function createKategori(datamasterRequest $request)
    {
        $kategori = new Kategori();
        $kategori->kategori = $request->kategori;
        $kategori->save();
       
        return response()->json(['message'=>'success !']);
    }

    public function createBahan(Request $request)
    {
        $bahan = new Bahan();
        $bahan->bahan = $request->bahan;
        $bahan->save();
       
        return response()->json(['message'=>'success !']);
    }

    public function editKategori(Request $request, $id)
    {
        $kategori = Kategori::where('id',$request->id)->first();
        return Response()->json($kategori);
    }

    public function editBahan(Request $request, $id)
    {
        $bahan = Bahan::where('id',$request->id)->first();
        return Response()->json($bahan);
    }

    public function updateKategori(datamasterRequest $request, $id)
    {
        $kategori = Kategori::find($id);
        $kategori->kategori = $request->kategori;
        $kategori->save();

        return response()->json(['message'=>'success !']);
    }

    public function updateBahan(Request $request, $id)
    {
        $bahan = Bahan::find($id);
        $bahan->bahan = $request->bahan;
        $bahan->save();

        return response()->json(['message'=>'success !']);
    }

    public function deleteKategori($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();
        return response()->json(['message'=>'success !']);
    }

    public function deleteBahan($id)
    {
        $bahan = Bahan::find($id);
        $bahan->delete();
        return response()->json(['message'=>'success !']);
    }
}
