<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AttendanceController extends Controller
{
    public function checkIn(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'employee_id' => ['required','exists:employees,id',
                Rule::unique('attendances')
                    ->where(function ($query) {
                    return $query->where('date', date('Y-m-d'));
                })
            ]
        ],[
            'employee_id.unique' => 'Attendance has already been recorded for this employee.'
        ]);

        if($validate->fails())
        {
            return response()->json([
                'status' => false,
                'error' => $validate->errors()->all()
            ], 422);
        }

        Attendance::create([
            'employee_id' => $request->employee_id,
            'date' => date('Y-m-d'),
            'check_in' => now(),
            'status' => date('H:i') <= '10:15' ? 1 : 2
        ]);

        return response()->json([
            'status' => true
        ]);
    }

    public function checkOut($id)
    {
        $att = Attendance::findOrFail($id);

        $att->update([
            'check_out' => now(),
        ]);

        return response()->json([
            'status' => true,
        ]);
    }
}
