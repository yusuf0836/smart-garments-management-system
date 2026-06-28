<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::latest()->get();
        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'joining_date' => 'required|date',
            'department'   => 'required|string',
            'designation'  => 'required|string',
            'basic_salary' => 'required|numeric|min:0',
            'shift'        => 'required|in:morning,evening,night',
            'gender'       => 'required|in:male,female,other',
            'email'        => 'nullable|email|unique:employees,email',
            'phone'        => 'nullable|string|max:20',
        ]);

        // Auto Employee ID তৈরি
        $lastEmployee = Employee::latest('id')->first();
        $newId = $lastEmployee
            ? 'EMP-' . str_pad((intval(substr($lastEmployee->employee_id, 4)) + 1), 3, '0', STR_PAD_LEFT)
            : 'EMP-001';

        Employee::create([
            ...$request->except('_token'),
            'employee_id' => $newId,
        ]);

        return redirect()->route('admin.employees.index')
                         ->with('success', 'Employee added successfully!');
    }

    public function edit(Employee $employee)
    {
        return view('admin.employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'joining_date' => 'required|date',
            'department'   => 'required|string',
            'designation'  => 'required|string',
            'basic_salary' => 'required|numeric|min:0',
            'shift'        => 'required|in:morning,evening,night',
            'gender'       => 'required|in:male,female,other',
            'email'        => 'nullable|email|unique:employees,email,' . $employee->id,
        ]);

        $employee->update($request->except('_token', '_method'));

        return redirect()->route('admin.employees.index')
                         ->with('success', 'Employee updated successfully!');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('admin.employees.index')
                         ->with('success', 'Employee deleted successfully!');
    }
}