<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::withCount('rawMaterials')->latest()->get();
        return view('admin.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('admin.suppliers.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name'  => 'required|string|max:255',
        'phone' => 'nullable|string|max:20',
        'email' => 'nullable|email',
    ]);

    Supplier::create([
        'name'    => $request->name,
        'company' => $request->company,
        'phone'   => $request->phone,
        'email'   => $request->email,
        'address' => $request->address,
        'status'  => $request->status ?? 'active',
    ]);

    return redirect()->route('admin.suppliers.index')
                     ->with('success', 'Supplier added successfully!');
}

    public function show(Supplier $supplier)
    {
        return redirect()->route('admin.suppliers.index');
    }

    public function edit(Supplier $supplier)
    {
        return view('admin.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
        ]);

        $supplier->update($request->except('_token', '_method'));

        return redirect()->route('admin.suppliers.index')
                         ->with('success', 'Supplier updated successfully!');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('admin.suppliers.index')
                         ->with('success', 'Supplier deleted successfully!');
    }
}