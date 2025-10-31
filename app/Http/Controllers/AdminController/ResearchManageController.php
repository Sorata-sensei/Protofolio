<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\Research;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResearchManageController extends Controller
{
    public function index()
    {
        $journals = Research::all();
        $menu = 'Journals';
        return view('admin.research.index', compact('journals','menu'));
    }

    public function create()
    {
        $menu = 'Create Journals';
        return view('admin.research.create',compact('menu'));
    }

   public function store(Request $request)
{
   
    // Validasi data yang diterima dari form
    $validatedData = $request->validate([
        'title' => 'required|string|max:255', // Judul harus diisi, berupa string, dan maksimal 255 karakter
        'authors' => 'required|array', // Penulis harus diisi dan berupa array
        'authors.*' => 'string|max:255', // Setiap penulis harus berupa string dan maksimal 255 karakter
        'publisher' => 'required|string|max:255', // Publisher harus diisi, berupa string, dan maksimal 255 karakter
        'year' => 'required|integer|digits:4|between:1900,' . date('Y'), // Tahun harus diisi, berupa integer, 4 digit, dan antara 1900 hingga tahun sekarang
        'journal_link' => 'nullable|url|max:255', // Link PDF bersifat opsional, harus berupa URL dan maksimal 255 karakter
        'abstract' => 'nullable|string', // Abstract bersifat opsional, harus berupa string dan maksimal 1000 karakter
    ]);

    // Menangani data penulis
    if (isset($validatedData['authors'])) {
        $validatedData['authors'] = implode(',', $validatedData['authors']); // Menggabungkan penulis menjadi string
    }
    // Membuat jurnal baru dengan data yang telah diproses
    try {
         \DB::beginTransaction();
        Research::create([
            'title' => $validatedData['title'],
            'authors' => $validatedData['authors'],
            'publisher' => $validatedData['publisher'],
            'year' => $validatedData['year'],
            'journal_link' => $validatedData['journal_link'],
            'abstract' => $validatedData['abstract'],
        ]);
        \DB::commit();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('research.admin.index')->with('success', 'Journal added successfully.');
    } catch (\Exception $e) {
        // Menangkap error saat menyimpan data
        return redirect()->back()->withErrors(['error' => 'Failed to add journal: ' . $e->getMessage()])->withInput();
    }

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('research.admin.index')->with('success', 'Journal added successfully.');
}


    public function destroy($id)
    {
        Research::findOrFail($id)->delete();
        return redirect()->route('research.admin.index')->with('success', 'Journal deleted successfully.');
    }

    public function addFakeData()
    {
        $fakeJournals = [
            [
                'title' => 'The Impact of Artificial Intelligence on Modern Society',
                'abstract' => 'This study explores the effects of artificial intelligence on society, focusing on ethical and economic aspects.',
                'authors' => 'John Doe; Jane Smith',
                'publisher' => 'Tech Publishers',
                'journal_link' => 'https://example.com/journal1',
                'year' => 2024, // Tahun ditambahkan
            ],
            [
                'title' => 'Renewable Energy and Its Role in Climate Change Mitigation',
                'abstract' => 'An overview of renewable energy sources and their potential in addressing global climate change.',
                'authors' => 'Alice Brown; Bob Johnson',
                'publisher' => 'Energy World',
                'journal_link' => 'https://example.com/journal2',
                'year' => 2023, // Tahun ditambahkan
            ],
            [
                'title' => 'Advances in Quantum Computing',
                'abstract' => 'This paper discusses recent developments in quantum computing and their implications for cryptography.',
                'authors' => 'Charlie Green; David White',
                'publisher' => 'Quantum Science Journal',
                'journal_link' => 'https://example.com/journal3',
                'year' => 2025, // Tahun ditambahkan
            ],
        ];

        foreach ($fakeJournals as $journal) {
            Research::create($journal);
        }

        return redirect()->route('research.admin.index')->with('success', 'Fake data with year added successfully.');
    }

    public function deleteAll()
    {
        Research::truncate();
        return redirect()->route('research.admin.index')->with('success', 'All data deleted.');
    }
}