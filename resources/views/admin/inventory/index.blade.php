@extends('layouts.app')
@section('title', 'Inventory')
@section('page-title', 'Inventory Management')

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
    <div class="nav-section-title">Reports</div>
    <a href="#" class="nav-link"><i class="bi bi-bar-chart"></i> Analytics</a>
    <a href="#" class="nav-link"><i class="bi bi-gear"></i> Settings</a>
@endsection

@section('content')

{{-- Header --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-1" style="color:#1F3864;">Inventory List</h4>
        <p class="text-muted mb-0">Manage raw materials and stock</p>
    </div>
    <a href="{{ route('admin.inventory.create') }}"
       class="btn d-flex align-items-center gap-2"
       style="background:#2E75B6;color:white;border:none;border-radius:8px;padding:10px 20px;font-weight:600;">
        <i class="bi bi-plus-lg"></i> Add Item
    </a>
</div>

{{-- Alerts --}}
@if(session('success'))
<div class="alert d-flex align-items-center gap-2 mb-4"
     style="border-radius:8px;border:none;background:#dcfce7;color:#16a34a;">
    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
</div>
@endif

{{-- Low Stock Warning --}}
@if($lowStock > 0)
<div class="alert d-flex align-items-center gap-2 mb-4"
     style="border-radius:8px;border:none;background:#fef9c3;color:#854d0e;">
    <i class="bi bi-exclamation-triangle-fill"></i>
    <strong>{{ $lowStock }} item(s)</strong> are below minimum stock level!
</div>
@endif

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background:#dbeafe;">
                <i class="bi bi-box-seam-fill" style="color:#2563eb;"></i>
            </div>
            <div>
                <div class="stat-value">{{ $totalItems }}</div>
                <p class="stat-label">Total Items</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fee2e2;">
                <i class="bi bi-exclamation-triangle-fill" style="color:#dc2626;"></i>
            </div>
            <div>
                <div class="stat-value">{{ $lowStock }}</div>
                <p class="stat-label">Low Stock Items</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background:#dcfce7;">
                <i class="bi bi-cash-stack" style="color:#16a34a;"></i>
            </div>
            <div>
                <div class="stat-value">৳{{ number_format($totalValue, 0) }}</div>
                <p class="stat-label">Total Stock Value</p>
            </div>
        </div>
    </div>
</div>

{{-- Table --}}
<div class="content-card">
    <div class="content-card-header">
        <h6><i class="bi bi-box-seam-fill me-2" style="color:#2E75B6;"></i>All Raw Materials</h6>
        <span class="badge" style="background:#dbeafe;color:#2563eb;">Total: {{ $totalItems }}</span>
    </div>
    <div class="content-card-body">
        <table id="inventoryTable" class="table table-hover align-middle" style="width:100%;">
            <thead style="background:#f8f9fa;">
                <tr>
                    <th>Item Code</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Stock</th>
                    <th>Unit Price</th>
                    <th>Total Value</th>
                    <th>Supplier</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($materials as $index => $item)
                <tr>
                    <td>
                        <span class="badge" style="background:#dbeafe;color:#2563eb;font-size:12px;">
                            {{ $item->item_code }}
                        </span>
                    </td>
                    <td>
                        <div style="font-weight:600;font-size:14px;">{{ $item->name }}</div>
                        <div style="font-size:11px;color:#888;">{{ $item->description }}</div>
                    </td>
                    <td style="font-size:13px;">{{ $item->category }}</td>
                    <td>
                        @if($item->isLowStock())
                            <span style="color:#dc2626;font-weight:700;">
                                {{ number_format($item->current_stock, 2) }} {{ $item->unit }}
                            </span>
                            <span class="badge ms-1" style="background:#fee2e2;color:#dc2626;font-size:10px;">LOW</span>
                        @else
                            <span style="color:#16a34a;font-weight:600;">
                                {{ number_format($item->current_stock, 2) }} {{ $item->unit }}
                            </span>
                        @endif
                        <div style="font-size:11px;color:#888;">Min: {{ $item->minimum_stock }}</div>
                    </td>
                    <td>৳{{ number_format($item->unit_price, 2) }}</td>
                    <td>৳{{ number_format($item->current_stock * $item->unit_price, 0) }}</td>
                    <td style="font-size:13px;">{{ $item->supplier->name ?? '—' }}</td>
                    <td>
                        @if($item->status === 'active')
                            <span class="badge" style="background:#dcfce7;color:#16a34a;">Active</span>
                        @else
                            <span class="badge" style="background:#fee2e2;color:#dc2626;">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-1 flex-wrap">
                            {{-- Stock In --}}
                            <button class="btn btn-sm" style="background:#dcfce7;color:#16a34a;border:none;border-radius:6px;"
                                    onclick="showStockModal({{ $item->id }}, '{{ $item->name }}', 'in', {{ $item->current_stock }})">
                                <i class="bi bi-plus-circle"></i>
                            </button>
                            {{-- Stock Out --}}
                            <button class="btn btn-sm" style="background:#fef9c3;color:#854d0e;border:none;border-radius:6px;"
                                    onclick="showStockModal({{ $item->id }}, '{{ $item->name }}', 'out', {{ $item->current_stock }})">
                                <i class="bi bi-dash-circle"></i>
                            </button>
                            {{-- Transactions --}}
                            <a href="{{ route('admin.inventory.transactions', $item) }}"
                               class="btn btn-sm" style="background:#e0e7ff;color:#4338ca;border:none;border-radius:6px;">
                                <i class="bi bi-clock-history"></i>
                            </a>
                            {{-- Edit --}}
                            <a href="{{ route('admin.inventory.edit', $item) }}"
                               class="btn btn-sm" style="background:#dbeafe;color:#2563eb;border:none;border-radius:6px;">
                                <i class="bi bi-pencil"></i>
                            </a>
                            {{-- Delete --}}
                            <form action="{{ route('admin.inventory.destroy', $item) }}" method="POST">
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
                    <td colspan="10" class="text-center py-5 text-muted">
                        <i class="bi bi-box-seam" style="font-size:40px;display:block;margin-bottom:8px;"></i>
                        No items found. <a href="{{ route('admin.inventory.create') }}">Add one now</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Stock Modal --}}
<div class="modal fade" id="stockModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:12px;border:none;">
            <div class="modal-header" style="background:linear-gradient(135deg,#1F3864,#2E75B6);color:white;border-radius:12px 12px 0 0;">
                <h5 class="modal-title" id="modalTitle">Stock Update</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="stockForm" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;">Item</label>
                        <input type="text" id="modalItemName" class="form-control" readonly style="background:#f8f9fa;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;">
                            Quantity <span class="text-danger">*</span>
                        </label>
                        <input type="number" name="quantity" class="form-control" placeholder="Enter quantity" min="0.01" step="0.01" required>
                        <div id="currentStockInfo" style="font-size:12px;color:#888;margin-top:4px;"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;">Reference (Invoice/Order)</label>
                        <input type="text" name="reference" class="form-control" placeholder="e.g. INV-001">
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-semibold" style="font-size:13px;">Note</label>
                        <textarea name="note" class="form-control" rows="2" placeholder="Optional note"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal"
                            style="background:#f0f2f5;border:none;border-radius:8px;">Cancel</button>
                    <button type="submit" id="modalSubmitBtn" class="btn fw-semibold"
                            style="background:#2E75B6;color:white;border:none;border-radius:8px;">
                        Save
                    </button>
                </div>
            </form>
        </div>
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
            title: 'Delete Item?',
            text: 'This will permanently delete the item and all its transactions!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, delete!',
        }).then((result) => {
            if (result.isConfirmed) btn.closest('form').submit();
        });
    }

    // Low stock alert
    @if($lowStock > 0)
    window.addEventListener('load', function() {
        Swal.fire({
            icon: 'warning',
            title: 'Low Stock Alert!',
            text: '{{ $lowStock }} item(s) are below minimum stock level.',
            confirmButtonColor: '#2E75B6',
            timer: 5000,
            timerProgressBar: true,
        });
    });
    @endif
</script>
@endpush