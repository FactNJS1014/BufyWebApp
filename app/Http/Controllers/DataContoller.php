<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataContoller extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q'); // รับค่าค้นหาจาก frontend

        $data = DB::table('VWORLIST')
            ->select('WON')
            ->when($query, function ($q) use ($query) {
                $q->where('WON', 'like', '%' . $query . '%');
            })
            ->limit(10)
            ->get();

        return response()->json($data);
    }
}
