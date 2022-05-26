<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class apiController extends Controller
{
    public function getKategori () {
        $data = Kategori::orderBy('id','desc')->get();
        return response()->json($data);
    }
}
