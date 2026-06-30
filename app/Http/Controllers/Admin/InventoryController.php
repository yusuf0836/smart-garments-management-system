<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RawMaterial;
use App\Models\Supplier;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $materials  = RawMaterial::with('supplier')->latest()->get();
        $lowStock   = $materials->filter(fn($m) => $m->isLowStock())->count();
        $totalItems = $materials->count();
        $totalValue = $materials->sum(fn($m) => $m->current_stock * $m->unit_price);

        return view('admin.inventory.index', compact(
            'materials', 'lowStock', 'totalItems', 'totalValue'
        ));
    }

    public function create()
    {
        $suppliers = Supplier::where('status', 'active')->get();
        return view('admin.inventory.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'category'      => 'required',
            'unit'          => 'required|string',
            'current_stock' => 'required|numeric|min:0',
            'minimum_stock' => 'required|numeric|min:0',
            'unit_price'    => 'required|numeric|min:0',
        ]);

        $last = RawMaterial::latest('id')->first();
        $code = $last
            ? 'MAT-' . str_pad((intval(substr($last->material_code, 4)) + 1), 3, '0', STR_PAD_LEFT)
            : 'MAT-001';

        RawMaterial::create([
            ...$request->except('_token'),
            'material_code' => $code,
        ]);

        return redirect()->route('admin.inventory.index')
                         ->with('success', 'Material added successfully!');
    }

    public function edit(RawMaterial $inventory)
    {
        $suppliers = Supplier::where('status', 'active')->get();
        return view('admin.inventory.edit', compact('inventory', 'suppliers'));
    }

    public function update(Request $request, RawMaterial $inventory)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'category'      => 'required',
            'unit'          => 'required|string',
            'minimum_stock' => 'required|numeric|min:0',
            'unit_price'    => 'required|numeric|min:0',
        ]);

        $inventory->update($request->except('_token', '_method'));

        return redirect()->route('admin.inventory.index')
                         ->with('success', 'Material updated successfully!');
    }

    public function destroy(RawMaterial $inventory)
    {
        $inventory->delete();
        return redirect()->route('admin.inventory.index')
                         ->with('success', 'Material deleted successfully!');
    }
}