<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class YearController extends Controller
{
    public function index()
    {
        $data = Year::get();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ["required","unique:years,name","date_format:Y",
                'after:' . (date('Y') - 1),'before:' . (date('Y') + 2)],
        ]);

        if($validate->fails())
        {
            return response()->json([
                'status' => false,
                'error' => $validate->errors()->all()
            ], 422);
        }

        Year::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'status' => true,
        ], 201);
    }
}
