<?php

namespace App\Http\Controllers;

use App\Models\Month;
use Illuminate\Http\Request;

class MonthController extends Controller
{
    public function index()
    {
        $data = Month::get();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }
}
