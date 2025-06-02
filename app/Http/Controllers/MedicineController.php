<?php

namespace App\Http\Controllers;

use App\Models\Medicines;
use App\Models\Category;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $medicines = Medicines::with('batches')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'ILIKE', "%{$search}%")
                        ->orWhere('code', 'ILIKE', "%{$search}%")
                        ->orWhere('dosage', 'ILIKE', "%{$search}%")
                        ->orWhere('description', 'ILIKE', "%{$search}%");
                });
            })
            ->paginate(10);

        return view('inventory.index', compact('medicines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('inventory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'code' => 'required|string|max:255|unique:medicines,code',
            'dosage' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $medicine = Medicines::create($request->only(['name', 'category_id', 'code', 'dosage', 'description']));

        // Untuk batch, buat form/fitur terpisah setelah create medicine

        return redirect()->route('inventory.index')->with('success', 'Obat berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medicines $medicine)
    {
        $categories = Category::all();
        $medicine->load('batches');
        return view('inventory.edit', compact('medicine', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medicines $medicine)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'code' => 'required|string|max:255|unique:medicines,code,' . $medicine->id,
            'dosage' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $medicine->update($request->only(['name', 'category_id', 'code', 'dosage', 'description']));

        return redirect()->route('inventory.index')->with('success', 'Data obat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $medicine = Medicines::findOrFail($id);
        $medicine->delete();

        return redirect()->route('inventory.index')->with('success', 'Obat berhasil dihapus.');
    }
}
