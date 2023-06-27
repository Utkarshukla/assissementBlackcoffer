<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
          $value = $request->input('values');
     
        $data = DB::table('datas')->select()->where('end_year',$value)->get();
        // $data = json_encode($result);
        return response()->json(
            $data
        );
    }

    
}
