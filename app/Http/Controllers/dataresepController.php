<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Bahan;
use App\Models\Resep;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Requests\dataresepRequest;

class dataresepController extends Controller
{
    public function index (Request $request) {
        if ($request->ajax()) {
            $data = Resep::join('kategori', 'resep.kategori_id', 'kategori.id')
            ->select(['resep.id', 'resep.resep', 'resep.bahan', 'kategori.kategori']);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<a href="#" class="editResep" data-id='.$row->id.' data-toggle="modal" data-target="#modalEdit"><i class="fa fa-edit fa-fw text-warning"></i></a> &nbsp;
                        <a href="#" data-id='.$row->id.' class="delete"><i class="fa fa-trash fa-fw text-danger"></i></a> &nbsp;';
                        return $btn;
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('kategori_id')) {
                        $instance->where('kategori_id', $request->get('kategori_id'));
                    }
                    if (!empty($request->get('search'))) {
                         $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->orWhere('resep', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('data_resep');
    }  

    public function getKategori(Request $request){
        $data = [];

        $search = $request->search;
        if($search == ''){
            $data =Kategori::select("id","kategori") ->get();
        }else{
           $data = Kategori::where('kategori', 'like', '%' .$search . '%')->get();
        }

        return response()->json($data);
    } 

    public function getBahan(Request $request){
        $data = [];

        $search = $request->search;
        if($search == ''){
            $data =Bahan::select("id","bahan") ->get();
        }else{
           $data = Bahan::where('bahan', 'like', '%' .$search . '%')->get();
        }

        return response()->json($data);
    } 

    public function create(dataresepRequest $request)
    {
        $resep = new Resep();
        $resep->resep = $request->resep;
        $resep->kategori_id = $request->kategori_id;
        $resep->bahan = implode(' , ',$request->bahan);
        $resep->save();
       
        return response()->json(['message'=>'success !']);
    }

    public function edit(Request $request, $id)
    {
        $where = array('resep.id' => $request->id);
        $resep = Resep::join('kategori', 'resep.kategori_id', 'kategori.id')
            ->select(['resep.id', 'resep.resep', 'resep.bahan', 'resep.kategori_id', 'kategori.kategori'])
            ->where($where)->first();
        return Response()->json($resep);
    }

    public function update(Request $request, $id)
    {
        $resep = Resep::find($id);
        $resep->resep = $request->resep;
        $resep->kategori_id = $request->kategori_id;
        $resep->bahan = implode(' , ',$request->bahan);
        $resep->save();

        return response()->json(['message'=>'success !']);
    }

    public function delete($id)
    {
        $resep = Resep::find($id);
        $resep->delete();
        return response()->json(['message'=>'success !']);
    }
}
