<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index()
    {
        if($dept_id = request()->input('department_id'))
        {
            $data = $this->employeeByDept($dept_id);
        }
        else
        {
            $data = Employee::with('city.country')->paginate(10);
        }
        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'department_id' => 'required|exists:departments,id',
            'name' => 'required|string|min:5',
            'email' => 'required|email|unique:employees,email',
            'phone_no' => ['required','unique:employees,phone_no','regex:/^(?:\+88|88)?(01[3-9]\d{8})$/'],
            'image_url' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'address' => 'required|string',
            'city_id' => 'required|exists:cities,id'
        ]);

        if($validate->fails())
        {
            return response()->json([
                'status' => false,
                'error' => $validate->errors()->all()
            ], 422);
        }

        $photo = $request->file('image_url');
        $file = "employee_" . time() . rand(10, 100) . '.' . $photo->getClientOriginalExtension();

        Employee::create([
            'department_id' => $request->department_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'image_url' => '/images/employees/' . $file,
            'address' => $request->address,
            'city_id' => $request->city_id
        ]);

        $photo->move(public_path('images/employees/'), $file);

        return response()->json([
            'status' => true,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $emp = Employee::findOrFail($id);

        $validate = Validator::make($request->all(), [
            'department_id' => 'required|exists:departments,id',
            'name' => 'required|string|min:5',
            'email' => 'required|email',
            'phone_no' => ['required','unique:employees,phone_no','regex:/^(?:\+88|88)?(01[3-9]\d{8})$/'],
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'address' => 'required|string',
            'city_id' => 'required|exists:cities,id'
        ]);

        if($validate->fails())
        {
            return response()->json([
                'status' => false,
                'error' => $validate->errors()->all()
            ], 422);
        }

        if($request->hasFile('image_url'))
        {
            if($emp->image_url)
            {
                if(File::exists(public_path($emp->image_url)))
                {
                    File::delete(public_path($emp->image_url));
                }
            }

            $photo = $request->file('image_url');
            $photo_file = "employee_" . time() . rand(10, 100) . '.' . $photo->getClientOriginalExtension();

            $emp->image_url = '/images/employees/' . $photo_file;

            $photo->move(public_path('/images/employees/'), $photo_file);
        }

        $emp->department_id = $request->input('department_id');
        $emp->name = $request->input('name');
        $emp->email = $request->input('email');
        $emp->phone_no = $request->input('phone_no');
        $emp->address = $request->input('address');
        $emp->city_id = $request->input('city_id');

        $emp->save();

        return response()->json([
            'status' => true
        ]);
    }

    public function delete($id)
    {
        $emp = Employee::findOrFail($id);

        try
        {
            $emp->delete();

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

    public function employeeByDept($dept_id)
    {
        return Employee::with('city.country')
            ->where('department_id',$dept_id)->paginate(10);
    }
}
