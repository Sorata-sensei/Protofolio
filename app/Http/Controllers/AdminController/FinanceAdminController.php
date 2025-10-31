<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FinanceTransaction;
use Carbon\Carbon;
class FinanceAdminController extends Controller
{
      public function index()
      {
            $menu = 'Finance Main Menu';
              // Ambil semua transaksi (bisa disesuaikan query-nya)
            $transactions = FinanceTransaction::orderBy('created_at', 'desc')->get();

            // Total dana masuk
            $totalFunds = $transactions->where('type', 'fund')->sum('amount');

            // Total pengeluaran
            $totalExpenses = $transactions->where('type', 'expense')->sum('amount');

            // Saldo (dana masuk - pengeluaran)
            $balance = $totalFunds - $totalExpenses;
            return view('admin.finance.index', compact('menu','transactions', 'totalFunds', 'totalExpenses', 'balance'));
      }
      
      public function Fund(Request $request){
          $menu = 'Add fund';
          $funds = FinanceTransaction::where('type', 'fund')->orderBy('created_at', 'desc')->get();
          return view('admin.finance.addfund', compact('menu','funds'));
          
      }

       // Menambahkan dana masuk
    public function addFund(Request $request)
    {
        // Ambil input amount asli dari request
        $amountInput = $request->input('amount');
    
        // Bersihkan input amount dari titik atau karakter selain angka
        $amountClean = preg_replace('/[^0-9]/', '', $amountInput);
    
        // Ganti value amount di request agar validasi bisa benar
        $request->merge(['amount' => $amountClean]);
    
        // Validasi dengan aturan numeric setelah di-merge
        $request->validate([
            'amount' => 'required|numeric',
            'category' => 'required|string',
            'description' => 'nullable|string',
        ]);
    
        // Setelah validasi, ambil nilai amount sudah bersih dan numeric
        $amount = (int) $request->input('amount');
    
        FinanceTransaction::create([
            'amount' => $amount,
            'type' => 'fund',
            'description' => $request->description,
            'category' => $request->category ?? null,
        ]);

        return redirect()->back()->with('success', 'Dana berhasil ditambahkan.');
    }

    public function editFund(Request $request){
    
      // Ambil input amount asli dari request
      $amountInput = $request->input('amount');
    
      // Bersihkan input amount dari titik atau karakter selain angka
      $amountClean = preg_replace('/[^0-9]/', '', $amountInput);
  
      // Ganti value amount di request agar validasi bisa benar
      $request->merge(['amount' => $amountClean]);
       // Setelah validasi, ambil nilai amount sudah bersih dan numeric
       $amount = (int) $request->input('amount');
        // Find the existing transaction by ID
       
      $financeTransaction = FinanceTransaction::find($request->fund_id);

      if (!$financeTransaction) {
          // Handle not found, maybe throw an exception or return response
          return redirect()->back()->with('warning', 'Fund Id not found');
      }

      // Update the transaction fields
      $financeTransaction->amount = $amount;
      $financeTransaction->type = 'fund'; // Or set dynamically if needed
      $financeTransaction->description = $request->description;
      $financeTransaction->category = $request->category ?? null;

      // Save the changes
      $financeTransaction->save();
      return redirect()->back()->with('success', 'Fund Success Updated');
      }

      public function deleteFinance(Request $request, $id){
       
       

        // Find the transaction by ID
       $financeTransaction = FinanceTransaction::find($id);

        if (!$financeTransaction) {
            return redirect()->back()->with('error', 'Transaction not found');
        }

        // Delete the transaction
        $financeTransaction->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Fund Success Delete');
      }

      public function Expense(){
        $menu = 'Add Expense';
        $funds = FinanceTransaction::where('type', 'expense')->orderBy('created_at', 'desc')->get();
        return view('admin.finance.addexpense', compact('menu','funds'));
        
      }

      public function addExpense(Request $request)
    {
    
        // Ambil input amount asli dari request
        $amountInput = $request->input('amount');
    
        // Bersihkan input amount dari titik atau karakter selain angka
        $amountClean = preg_replace('/[^0-9]/', '', $amountInput);
    
        // Ganti value amount di request agar validasi bisa benar
        $request->merge(['amount' => $amountClean]);
    
        // Validasi dengan aturan numeric setelah di-merge
        $request->validate([
            'amount' => 'required|numeric',
            'category' => 'required|string',
            'description' => 'nullable|string',
        ]);
    
        // Setelah validasi, ambil nilai amount sudah bersih dan numeric
        $amount = (int) $request->input('amount');
    
        FinanceTransaction::create([
            'amount' => $amount,
            'type' => 'expense',
            'description' => $request->description,
            'category' => $request->category ?? null,
        ]);

        return redirect()->back()->with('success', 'Expenses success added');
    }
    public function editExpense(Request $request){
    
      // Ambil input amount asli dari request
      $amountInput = $request->input('amount');
    
      // Bersihkan input amount dari titik atau karakter selain angka
      $amountClean = preg_replace('/[^0-9]/', '', $amountInput);
  
      // Ganti value amount di request agar validasi bisa benar
      $request->merge(['amount' => $amountClean]);
       // Setelah validasi, ambil nilai amount sudah bersih dan numeric
       $amount = (int) $request->input('amount');
        // Find the existing transaction by ID
       
      $financeTransaction = FinanceTransaction::find($request->fund_id);

      if (!$financeTransaction) {
          // Handle not found, maybe throw an exception or return response
          return redirect()->back()->with('warning', 'Fund Id not found');
      }

      // Update the transaction fields
      $financeTransaction->amount = $amount;
      $financeTransaction->type = 'expense'; // Or set dynamically if needed
      $financeTransaction->description = $request->description;
      $financeTransaction->category = $request->category ?? null;

      // Save the changes
      $financeTransaction->save();
      return redirect()->back()->with('success', 'Expense Success Updated');
      }
} 