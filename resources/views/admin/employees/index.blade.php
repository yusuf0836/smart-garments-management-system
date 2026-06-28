@extends('layouts.app')
@section('title', 'Employees')
@section('page-title', 'Employee Management')

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
    <a href="#" class="nav-link"><i class="bi bi-gear"></i> Settings</a>
@endsection

@section('content')

{{-- Header --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-1" style="color:#1F3864;">Employee List</h4>
        <p class="text-muted mb-0">Manage all factory employees</p>
    </div>
    <a href="{{ route('admin.employees.create') }}" class="btn btn-primary d-flex align-items-center gap-2"
       style="background:#2E75B6; border:none; border-radius:8px; padding:10px 20px; font-weight:600;">
        <i class="bi bi-plus-lg"></i> Add Employee
    </a>
</div>

{{-- Success Alert --}}
@if(session('success'))
    <div class="alert alert-success d-flex align-items-center gap-2 mb-4"
         style="border-radius:8px; border:none; background:#dcfce7; color:#16a34a;">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}
    </div>
@endif

{{-- Table Card --}}
<div class="content-card">
    <div class="content-card-header">
        <h6><i class="bi bi-people-fill me-2" style="color:#2E75B6;"></i>All Employees</h6>
        <span class="badge" style="background:#dbeafe; color:#2563eb;">
            Total: {{ $employees->count() }}
        </span>
    </div>
    <div class="content-card-body">
        <table id="employeeTable" class="table table-hover align-middle" style="width:100%;">
            <thead style="background:#f8f9fa;">
                <tr>
                    <th>#</th>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Designation</th>
                    <th>Shift</th>
                    <th>Salary</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $index => $emp)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><span class="badge" style="background:#dbeafe;color:#2563eb;font-size:12px;">{{ $emp->employee_id }}</span></td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:34px;height:34px;background:#e0e7ff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;color:#4338ca;font-size:13px;flex-shrink:0;">
                                {{ strtoupper(substr($emp->name, 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-weight:600;font-size:14px;">{{ $emp->name }}</div>
                                <div style="font-size:11px;color:#888;">{{ $emp->email ?? '—' }}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $emp->department }}</td>
                    <td>{{ $emp->designation }}</td>
                    <td>
                        <span class="badge" style="background:#fef9c3;color:#854d0e;text-transform:capitalize;">
                            {{ $emp->shift }}
                        </span>
                    </td>
                    <td>৳{{ number_format($emp->basic_salary, 0) }}</td>
                    <td>
                        @if($emp->status === 'active')
                            <span class="badge" style="background:#dcfce7;color:#16a34a;">Active</span>
                        @else
                            <span class="badge" style="background:#fee2e2;color:#dc2626;">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.employees.edit', $emp) }}"
                               class="btn btn-sm" style="background:#dbeafe;color:#2563eb;border:none;border-radius:6px;">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.employees.destroy', $emp) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-sm"
                                        style="background:#fee2e2;color:#dc2626;border:none;border-radius:6px;"
                                        onclick="confirmDelete(this)">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-5 text-muted">
                        <i class="bi bi-people" style="font-size:40px;display:block;margin-bottom:8px;"></i>
                        No employees found. <a href="{{ route('admin.employees.create') }}">Add one now</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#employeeTable').DataTable({
            pageLength: 10,
            language: {
                search: "Search:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ employees",
                emptyTable: "No employees found"
            }
        });
    });

    function confirmDelete(btn) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'This employee will be permanently deleted!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, delete!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                btn.closest('form').submit();
            }
        });
    }
</script>
@endpush