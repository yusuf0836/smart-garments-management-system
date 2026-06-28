@extends('layouts.app')
@section('title', 'Add Employee')
@section('page-title', 'Add New Employee')

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
    <div class="nav-section-title">Reports</div>
    <a href="#" class="nav-link"><i class="bi bi-bar-chart"></i> Analytics</a>
@endsection

@section('content')

<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.employees.index') }}"
       class="btn btn-sm" style="background:#f0f2f5;border:none;border-radius:8px;padding:8px 14px;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h4 class="fw-bold mb-0" style="color:#1F3864;">Add New Employee</h4>
        <p class="text-muted mb-0" style="font-size:13px;">Fill in the details below</p>
    </div>
</div>

@if($errors->any())
<div class="alert d-flex align-items-center gap-2 mb-4"
     style="border-radius:8px;border:none;background:#fef2f2;color:#dc2626;">
    <i class="bi bi-exclamation-circle-fill"></i>
    <div>{{ $errors->first() }}</div>
</div>
@endif

<div class="content-card">
    <div class="content-card-header">
        <h6><i class="bi bi-person-plus-fill me-2" style="color:#2E75B6;"></i>Employee Information</h6>
    </div>
    <div class="content-card-body">
        <form action="{{ route('admin.employees.store') }}" method="POST">
            @csrf
            <div class="row g-3">

                {{-- Personal Info --}}
                <div class="col-12">
                    <p class="fw-bold mb-2" style="color:#2E75B6;font-size:13px;text-transform:uppercase;letter-spacing:1px;">
                        Personal Information
                    </p>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px;">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter full name" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px;">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter email address">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px;">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="01XXXXXXXXX">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px;">Gender <span class="text-danger">*</span></label>
                    <select name="gender" class="form-select" required>
                        <option value="">Select gender</option>
                        <option value="male" {{ old('gender')=='male'?'selected':'' }}>Male</option>
                        <option value="female" {{ old('gender')=='female'?'selected':'' }}>Female</option>
                        <option value="other" {{ old('gender')=='other'?'selected':'' }}>Other</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px;">Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px;">NID Number</label>
                    <input type="text" name="nid" class="form-control" value="{{ old('nid') }}" placeholder="National ID number">
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold" style="font-size:13px;">Address</label>
                    <textarea name="address" class="form-control" rows="2" placeholder="Full address">{{ old('address') }}</textarea>
                </div>

                {{-- Job Info --}}
                <div class="col-12 mt-2">
                    <p class="fw-bold mb-2" style="color:#2E75B6;font-size:13px;text-transform:uppercase;letter-spacing:1px;">
                        Job Information
                    </p>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px;">Department <span class="text-danger">*</span></label>
                    <select name="department" class="form-select" required>
                        <option value="">Select department</option>
                        <option value="Cutting" {{ old('department')=='Cutting'?'selected':'' }}>Cutting</option>
                        <option value="Sewing" {{ old('department')=='Sewing'?'selected':'' }}>Sewing</option>
                        <option value="Finishing" {{ old('department')=='Finishing'?'selected':'' }}>Finishing</option>
                        <option value="Quality Control" {{ old('department')=='Quality Control'?'selected':'' }}>Quality Control</option>
                        <option value="Packing" {{ old('department')=='Packing'?'selected':'' }}>Packing</option>
                        <option value="HR" {{ old('department')=='HR'?'selected':'' }}>HR</option>
                        <option value="Accounts" {{ old('department')=='Accounts'?'selected':'' }}>Accounts</option>
                        <option value="Management" {{ old('department')=='Management'?'selected':'' }}>Management</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px;">Designation <span class="text-danger">*</span></label>
                    <input type="text" name="designation" class="form-control" value="{{ old('designation') }}" placeholder="e.g. Sewing Operator" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size:13px;">Joining Date <span class="text-danger">*</span></label>
                    <input type="date" name="joining_date" class="form-control" value="{{ old('joining_date') }}" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size:13px;">Shift <span class="text-danger">*</span></label>
                    <select name="shift" class="form-select" required>
                        <option value="">Select shift</option>
                        <option value="morning" {{ old('shift')=='morning'?'selected':'' }}>Morning</option>
                        <option value="evening" {{ old('shift')=='evening'?'selected':'' }}>Evening</option>
                        <option value="night" {{ old('shift')=='night'?'selected':'' }}>Night</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size:13px;">Basic Salary (৳) <span class="text-danger">*</span></label>
                    <input type="number" name="basic_salary" class="form-control" value="{{ old('basic_salary') }}" placeholder="0.00" min="0" step="0.01" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size:13px;">Status</label>
                    <select name="status" class="form-select">
                        <option value="active" {{ old('status','active')=='active'?'selected':'' }}>Active</option>
                        <option value="inactive" {{ old('status')=='inactive'?'selected':'' }}>Inactive</option>
                    </select>
                </div>

                {{-- Submit --}}
                <div class="col-12 mt-3 d-flex gap-2">
                    <button type="submit" class="btn px-4 py-2 fw-semibold"
                            style="background:#2E75B6;color:white;border:none;border-radius:8px;">
                        <i class="bi bi-check-lg me-1"></i> Save Employee
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