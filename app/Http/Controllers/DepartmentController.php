<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function index()
    {
        $data = Department::get();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|unique:departments,name'
        ]);

        if($validate->fails())
        {
            return response()->json([
                'status' => false,
                'error' => $validate->errors()->all()
            ], 422);
        }

        Department::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'status' => true,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $dept = Department::findOrFail($id);

        $validate = Validator::make($request->all(), [
            'name' => 'required|string'
        ]);

        if($validate->fails())
        {
            return response()->json([
                'status' => false,
                'error' => $validate->errors()->all()
            ], 422);
        }

        $dept->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'status' => true,
        ]);
    }

    public function delete($id)
    {
        $dept = Department::findOrFail($id);

        try
        {
            $dept->delete();

            return response()->json([
                'status' => true,
            ]);
        }
        catch (QueryException $ex)
        {
            return response()->json([
                'status' => false,
            ],500);
        }
    }
}
