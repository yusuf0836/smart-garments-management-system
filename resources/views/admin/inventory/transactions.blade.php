@extends('layouts.app')
@section('title', 'Stock Transactions')
@section('page-title', 'Stock Transactions')

@section('sidebar-menu')
    <div class="nav-section-title">Main Menu</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-link">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <div class="nav-section-title">Management</div>
    <a href="{{ route('admin.employees.index') }}" class="nav-link">
        <i class="bi bi-people"></i> Employees
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
        <h4 class="fw-bold mb-0" style="color:#1F3864;">{{ $inventory->name }}</h4>
        <p class="text-muted mb-0" style="font-size:13px;">
            {{ $inventory->item_code }} · Current Stock:
            <strong>{{ $inventory->current_stock }} {{ $inventory->unit }}</strong>
        </p>
    </div>
</div>

<div class="content-card">
    <div class="content-card-header">
        <h6><i class="bi bi-clock-history me-2" style="color:#2E75B6;"></i>Transaction History</h6>
        <span class="badge" style="background:#dbeafe;color:#2563eb;">{{ $transactions->count() }} records</span>
    </div>
    <div class="content-card-body">
        <table id="transTable" class="table table-hover align-middle" style="width:100%;">
            <thead style="background:#f8f9fa;">
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                    <th>Reference</th>
                    <th>Note</th>
                    <th>By</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $index => $trx)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="font-size:13px;">{{ $trx->created_at->format('d M Y, h:i A') }}</td>
                    <td>
                        @if($trx->type === 'in')
                            <span class="badge" style="background:#dcfce7;color:#16a34a;">
                                <i class="bi bi-arrow-down-circle me-1"></i>Stock In
                            </span>
                        @else
                            <span class="badge" style="background:#fef9c3;color:#854d0e;">
                                <i class="bi bi-arrow-up-circle me-1"></i>Stock Out
                            </span>
                        @endif
                    </td>
                    <td style="font-weight:600;">{{ $trx->quantity }} {{ $inventory->unit }}</td>
                    <td>৳{{ number_format($trx->unit_price, 2) }}</td>
                    <td>৳{{ number_format($trx->quantity * $trx->unit_price, 0) }}</td>
                    <td style="font-size:13px;">{{ $trx->reference ?? '—' }}</td>
                    <td style="font-size:13px;">{{ $trx->note ?? '—' }}</td>
                    <td style="font-size:13px;">{{ $trx->createdBy->name ?? '—' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-4 text-muted">No transactions found.</td>
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
        $('#transTable').DataTable({ pageLength: 15 });
    });
</script>
@endpush