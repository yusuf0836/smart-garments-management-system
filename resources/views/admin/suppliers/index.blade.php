@extends('layouts.app')
@section('title', 'Suppliers')
@section('page-title', 'Supplier Management')

@section('sidebar-menu')
    <div class="nav-section-title">Main Menu</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-link">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <div class="nav-section-title">Management</div>
    <a href="{{ route('admin.employees.index') }}" class="nav-link">
        <i class="bi bi-people"></i> Employees
    </a>
    <a href="{{ route('admin.inventory.index') }}" class="nav-link">
        <i class="bi bi-box-seam"></i> Inventory
    </a>
    <a href="{{ route('admin.suppliers.index') }}" class="nav-link active">
        <i class="bi bi-truck"></i> Suppliers
    </a>
    <a href="#" class="nav-link"><i class="bi bi-clipboard-check"></i> Orders</a>
    <a href="#" class="nav-link"><i class="bi bi-diagram-3"></i> Production</a>
@endsection

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-1" style="color:#1F3864;">Supplier List</h4>
        <p class="text-muted mb-0">Manage all suppliers</p>
    </div>
    <a href="{{ route('admin.suppliers.create') }}"
       class="btn d-flex align-items-center gap-2"
       style="background:#2E75B6;color:white;border:none;border-radius:8px;padding:10px 20px;font-weight:600;">
        <i class="bi bi-plus-lg"></i> Add Supplier
    </a>
</div>

@if(session('success'))
<div class="alert d-flex align-items-center gap-2 mb-4"
     style="border-radius:8px;border:none;background:#dcfce7;color:#16a34a;">
    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
</div>
@endif

<div class="content-card">
    <div class="content-card-header">
        <h6><i class="bi bi-truck me-2" style="color:#2E75B6;"></i>All Suppliers</h6>
        <span class="badge" style="background:#dbeafe;color:#2563eb;">Total: {{ $suppliers->count() }}</span>
    </div>
    <div class="content-card-body">
        <table id="supplierTable" class="table table-hover align-middle" style="width:100%;">
            <thead style="background:#f8f9fa;">
                <tr>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Items</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suppliers as $index => $supplier)
                <tr>
                    <td style="font-weight:600;">{{ $supplier->name }}</td>
                    <td style="font-size:13px;">{{ $supplier->company ?? '—' }}</td>
                    <td style="font-size:13px;">{{ $supplier->phone ?? '—' }}</td>
                    <td style="font-size:13px;">{{ $supplier->email ?? '—' }}</td>
                    <td>
                        <span class="badge" style="background:#dbeafe;color:#2563eb;">
                            {{ $supplier->raw_materials_count }}
                        </span>
                    </td>
                    <td>
                        @if($supplier->status === 'active')
                            <span class="badge" style="background:#dcfce7;color:#16a34a;">Active</span>
                        @else
                            <span class="badge" style="background:#fee2e2;color:#dc2626;">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.suppliers.edit', $supplier) }}"
                               class="btn btn-sm" style="background:#dbeafe;color:#2563eb;border:none;border-radius:6px;">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.suppliers.destroy', $supplier) }}" method="POST">
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
                    <td colspan="8" class="text-center py-5 text-muted">
                        <i class="bi bi-truck" style="font-size:40px;display:block;margin-bottom:8px;"></i>
                        No suppliers found. <a href="{{ route('admin.suppliers.create') }}">Add one now</a>
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
    function confirmDelete(btn) {
        Swal.fire({
            title: 'Delete Supplier?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            confirmButtonText: 'Yes, delete!',
        }).then((r) => { if (r.isConfirmed) btn.closest('form').submit(); });
    }
</script>
@endpush