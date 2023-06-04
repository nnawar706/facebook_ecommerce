<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function index()
    {
        $validate = Validator::make(request()->all(), [
            'country_id' => 'required|exists:countries,id'
        ]);

        if($validate->fails())
        {
            return response()->json([
                'status' => false,
                'error' => $validate->errors()->all()
            ], 422);
        }

        $country_id = request()->input('country_id');

        $data = City::where('country_id', $country_id)->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }
}
