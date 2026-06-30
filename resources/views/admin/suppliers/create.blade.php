@extends('layouts.app')
@section('title', 'Add Supplier')
@section('page-title', 'Add Supplier')

@section('sidebar-menu')
    <div class="nav-section-title">Main Menu</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-link">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <div class="nav-section-title">Management</div>
    <a href="{{ route('admin.employees.index') }}" class="nav-link"><i class="bi bi-people"></i> Employees</a>
    <a href="{{ route('admin.inventory.index') }}" class="nav-link"><i class="bi bi-box-seam"></i> Inventory</a>
    <a href="{{ route('admin.suppliers.index') }}" class="nav-link active"><i class="bi bi-truck"></i> Suppliers</a>
    <a href="#" class="nav-link"><i class="bi bi-clipboard-check"></i> Orders</a>
@endsection

@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.suppliers.index') }}"
       class="btn btn-sm" style="background:#f0f2f5;border:none;border-radius:8px;padding:8px 14px;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h4 class="fw-bold mb-0" style="color:#1F3864;">Add New Supplier</h4>
</div>

<div class="content-card">
    <div class="content-card-body">
        <form action="{{ route('admin.suppliers.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px;">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px;">Company</label>
                    <input type="text" name="company" class="form-control" value="{{ old('company') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px;">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px;">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold" style="font-size:13px;">Address</label>
                    <textarea name="address" class="form-control" rows="2">{{ old('address') }}</textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size:13px;">Status</label>
                    <select name="status" class="form-select">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="col-12 d-flex gap-2 mt-3">
                    <button type="submit" class="btn px-4 py-2 fw-semibold"
                            style="background:#2E75B6;color:white;border:none;border-radius:8px;">
                        <i class="bi bi-check-lg me-1"></i> Save Supplier
                    </button>
                    <a href="{{ route('admin.suppliers.index') }}"
                       class="btn px-4 py-2 fw-semibold"
                       style="background:#f0f2f5;color:#555;border:none;border-radius:8px;">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection