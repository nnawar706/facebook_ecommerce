<?php

namespace App\Http\Controllers;

use App\Models\EmployeeSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmployeeSalaryController extends Controller
{
    public function index()
    {}

    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'year_id' => 'required|exists:years,id',
            'month_id' => 'required|exists:months,id',
            'employee_id' => ['required','exists:employees,id',
                Rule::unique('employee_salaries')
                    ->where(function ($query) use($request) {
                        return $query->where('year_id', $request->year_id)
                            ->where('month_id',$request->month_id);
                    })
            ],
            'paid_amount' => 'required|numeric'
        ],[
            'employee_id.unique' => 'Salary entry has already been recorded for this employee.'
        ]);

        if($validate->fails())
        {
            return response()->json([
                'status' => false,
                'error' => $validate->errors()->all()
            ], 422);
        }

        EmployeeSalary::create([
            'year_id' => $request->year_id,
            'month_id' => $request->month_id,
            'employee_id' => $request->employee_id,
            'paid_amount' => $request->paid_amount
        ]);

        return response()->json([
            'status' => true,
        ], 201);
    }
}
