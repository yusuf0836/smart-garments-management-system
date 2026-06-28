<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $date      = $request->date ?? today()->toDateString();
        $employees = Employee::where('status', 'active')->get();
        $attendances = Attendance::with('employee')
                        ->whereDate('date', $date)
                        ->get()
                        ->keyBy('employee_id');

        return view('admin.attendance.index', compact('employees', 'attendances', 'date'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date'          => 'required|date',
            'attendances'   => 'required|array',
        ]);

        foreach ($request->attendances as $employeeId => $data) {
            Attendance::updateOrCreate(
                ['employee_id' => $employeeId, 'date' => $request->date],
                [
                    'status'         => $data['status'] ?? 'absent',
                    'check_in'       => $data['check_in'] ?? null,
                    'check_out'      => $data['check_out'] ?? null,
                    'overtime_hours' => $data['overtime_hours'] ?? 0,
                    'note'           => $data['note'] ?? null,
                ]
            );
        }

        return redirect()->route('admin.attendance.index', ['date' => $request->date])
                         ->with('success', 'Attendance saved successfully!');
    }
}