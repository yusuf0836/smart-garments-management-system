@extends('layouts.app')
@section('title', 'Edit Employee')
@section('page-title', 'Edit Employee')

@section('sidebar-menu')
    <div class="nav-section-title">Main Menu</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-link">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <div class="nav-section-title">Management</div>
    <a href="{{ route('admin.employees.index') }}" class="nav-link active">
        <i class="bi bi-people"></i> Employees
    </a>
    <a href="{{ route('admin.attendance.index') }}" class="nav-link">
        <i class="bi bi-calendar-check"></i> Attendance
    </a>
    <a href="#" class="nav-link"><i class="bi bi-box-seam"></i> Inventory</a>
    <a href="#" class="nav-link"><i class="bi bi-clipboard-check"></i> Orders</a>
    <a href="#" class="nav-link"><i class="bi bi-diagram-3"></i> Production</a>
@endsection

@section('content')

<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.employees.index') }}"
       class="btn btn-sm" style="background:#f0f2f5;border:none;border-radius:8px;padding:8px 14px;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h4 class="fw-bold mb-0" style="color:#1F3864;">Edit Employee</h4>
        <p class="text-muted mb-0" style="font-size:13px;">{{ $employee->employee_id }} — {{ $employee->name }}</p>
    </div>
</div>

<div class="content-card">
    <div class="content-card-header">
        <h6><i class="bi bi-pencil-fill me-2" style="color:#2E75B6;"></i>Update Information</h6>
    </div>
    <div class="content-card-body">
        <form action="{{ route('admin.employees.update', $employee) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">

                <div class="col-12">
                    <p class="fw-bold mb-2" style="color:#2E75B6;font-size:13px;text-transform:uppercase;letter-spacing:1px;">Personal Information</p>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px;">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $employee->name) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px;">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $employee->email) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px;">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $employee->phone) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px;">Gender <span class="text-danger">*</span></label>
                    <select name="gender" class="form-select" required>
                        <option value="male" {{ old('gender',$employee->gender)=='male'?'selected':'' }}>Male</option>
                        <option value="female" {{ old('gender',$employee->gender)=='female'?'selected':'' }}>Female</option>
                        <option value="other" {{ old('gender',$employee->gender)=='other'?'selected':'' }}>Other</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px;">Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', $employee->date_of_birth) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px;">NID</label>
                    <input type="text" name="nid" class="form-control" value="{{ old('nid', $employee->nid) }}">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold" style="font-size:13px;">Address</label>
                    <textarea name="address" class="form-control" rows="2">{{ old('address', $employee->address) }}</textarea>
                </div>

                <div class="col-12 mt-2">
                    <p class="fw-bold mb-2" style="color:#2E75B6;font-size:13px;text-transform:uppercase;letter-spacing:1px;">Job Information</p>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px;">Department <span class="text-danger">*</span></label>
                    <select name="department" class="form-select" required>
                        @foreach(['Cutting','Sewing','Finishing','Quality Control','Packing','HR','Accounts','Management'] as $dept)
                            <option value="{{ $dept }}" {{ old('department',$employee->department)==$dept?'selected':'' }}>{{ $dept }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px;">Designation <span class="text-danger">*</span></label>
                    <input type="text" name="designation" class="form-control" value="{{ old('designation', $employee->designation) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size:13px;">Joining Date <span class="text-danger">*</span></label>
                    <input type="date" name="joining_date" class="form-control" value="{{ old('joining_date', $employee->joining_date) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size:13px;">Shift <span class="text-danger">*</span></label>
                    <select name="shift" class="form-select" required>
                        <option value="morning" {{ old('shift',$employee->shift)=='morning'?'selected':'' }}>Morning</option>
                        <option value="evening" {{ old('shift',$employee->shift)=='evening'?'selected':'' }}>Evening</option>
                        <option value="night" {{ old('shift',$employee->shift)=='night'?'selected':'' }}>Night</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size:13px;">Basic Salary (৳) <span class="text-danger">*</span></label>
                    <input type="number" name="basic_salary" class="form-control" value="{{ old('basic_salary', $employee->basic_salary) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size:13px;">Status</label>
                    <select name="status" class="form-select">
                        <option value="active" {{ old('status',$employee->status)=='active'?'selected':'' }}>Active</option>
                        <option value="inactive" {{ old('status',$employee->status)=='inactive'?'selected':'' }}>Inactive</option>
                    </select>
                </div>

                <div class="col-12 mt-3 d-flex gap-2">
                    <button type="submit" class="btn px-4 py-2 fw-semibold"
                            style="background:#2E75B6;color:white;border:none;border-radius:8px;">
                        <i class="bi bi-check-lg me-1"></i> Update Employee
                    </button>
                    <a href="{{ route('admin.employees.index') }}"
                       class="btn px-4 py-2 fw-semibold"
                       style="background:#f0f2f5;color:#555;border:none;border-radius:8px;">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection