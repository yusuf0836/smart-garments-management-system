@extends('layouts.app')
@section('title', 'Add Item')
@section('page-title', 'Add Inventory Item')

@section('sidebar-menu')
    <div class="nav-section-title">Main Menu</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-link">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <div class="nav-section-title">Management</div>
    <a href="{{ route('admin.employees.index') }}" class="nav-link">
        <i class="bi bi-people"></i> Employees
    </a>
    <a href="{{ route('admin.attendance.index') }}" class="nav-link">
        <i class="bi bi-calendar-check"></i> Attendance
    </a>
    <a href="{{ route('admin.inventory.index') }}" class="nav-link active">
        <i class="bi bi-box-seam"></i> Inventory
    </a>
    <a href="{{ route('admin.suppliers.index') }}" class="nav-link">
        <i class="bi bi-truck"></i> Suppliers
    </a>
    <a href="#" class="nav-link"><i class="bi bi-clipboard-check"></i> Orders</a>
    <a href="#" class="nav-link"><i class="bi bi-diagram-3"></i> Production</a>
@endsection

@section('content')

<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.inventory.index') }}"
       class="btn btn-sm" style="background:#f0f2f5;border:none;border-radius:8px;padding:8px 14px;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h4 class="fw-bold mb-0" style="color:#1F3864;">Add New Item</h4>
        <p class="text-muted mb-0" style="font-size:13px;">Fill in the details below</p>
    </div>
</div>

<div class="content-card">
    <div class="content-card-header">
        <h6><i class="bi bi-plus-circle-fill me-2" style="color:#2E75B6;"></i>Item Information</h6>
    </div>
    <div class="content-card-body">
        <form action="{{ route('admin.inventory.store') }}" method="POST">
            @csrf
            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px;">Item Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="e.g. Cotton Fabric" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px;">Category <span class="text-danger">*</span></label>
                    <select name="category" class="form-select" required>
                        <option value="">Select category</option>
                        @foreach(['Fabric','Thread','Button','Zipper','Label','Packaging','Accessories','Chemical','Other'] as $cat)
                            <option value="{{ $cat }}" {{ old('category')==$cat?'selected':'' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size:13px;">Unit <span class="text-danger">*</span></label>
                    <select name="unit" class="form-select" required>
                        <option value="">Select unit</option>
                        @foreach(['kg','meter','yard','piece','roll','box','liter','dozen'] as $unit)
                            <option value="{{ $unit }}" {{ old('unit')==$unit?'selected':'' }}>{{ $unit }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size:13px;">Current Stock <span class="text-danger">*</span></label>
                    <input type="number" name="current_stock" class="form-control" value="{{ old('current_stock', 0) }}" min="0" step="0.01" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size:13px;">Minimum Stock <span class="text-danger">*</span></label>
                    <input type="number" name="minimum_stock" class="form-control" value="{{ old('minimum_stock', 0) }}" min="0" step="0.01" required>
                    <div style="font-size:11px;color:#888;margin-top:4px;">Alert will trigger below this level</div>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size:13px;">Unit Price (৳) <span class="text-danger">*</span></label>
                    <input type="number" name="unit_price" class="form-control" value="{{ old('unit_price', 0) }}" min="0" step="0.01" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size:13px;">Supplier</label>
                    <select name="supplier_id" class="form-select">
                        <option value="">Select supplier</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ old('supplier_id')==$supplier->id?'selected':'' }}>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size:13px;">Status</label>
                    <select name="status" class="form-select">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold" style="font-size:13px;">Description</label>
                    <textarea name="description" class="form-control" rows="2" placeholder="Optional description">{{ old('description') }}</textarea>
                </div>

                <div class="col-12 mt-3 d-flex gap-2">
                    <button type="submit" class="btn px-4 py-2 fw-semibold"
                            style="background:#2E75B6;color:white;border:none;border-radius:8px;">
                        <i class="bi bi-check-lg me-1"></i> Save Item
                    </button>
                    <a href="{{ route('admin.inventory.index') }}"
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