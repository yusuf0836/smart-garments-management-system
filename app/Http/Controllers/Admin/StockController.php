<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RawMaterial;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index()
    {
        $transactions = StockTransaction::with(['rawMaterial', 'creator'])
                            ->latest()->take(50)->get();
        $materials    = RawMaterial::where('status', 'active')->get();
        return view('admin.inventory.stock', compact('transactions', 'materials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'raw_material_id' => 'required|exists:raw_materials,id',
            'type'            => 'required|in:in,out',
            'quantity'        => 'required|numeric|min:0.01',
            'unit_price'      => 'nullable|numeric|min:0',
            'reference'       => 'nullable|string|max:100',
            'note'            => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            $material = RawMaterial::findOrFail($request->raw_material_id);

            if ($request->type === 'out' && $material->current_stock < $request->quantity) {
                throw new \Exception('Insufficient stock!');
            }

            StockTransaction::create([
                'raw_material_id' => $request->raw_material_id,
                'type'            => $request->type,
                'quantity'        => $request->quantity,
                'unit_price'      => $request->unit_price ?? $material->unit_price,
                'reference'       => $request->reference,
                'note'            => $request->note,
                'created_by'      => Auth::id(),
            ]);

            if ($request->type === 'in') {
                $material->increment('current_stock', $request->quantity);
            } else {
                $material->decrement('current_stock', $request->quantity);
            }
        });

        return redirect()->route('admin.stock.index')
                         ->with('success', 'Stock transaction saved!');
    }
}