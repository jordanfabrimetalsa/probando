<?php

namespace App\Http\Controllers;

use App\Models\FinanceCategory;
use App\Models\FinanceTransaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Voluntary;
use App\Support\DelegationAccess;

class FinanceController extends Controller
{
    public function index()
    {
        $categories = FinanceCategory::orderBy('type')->orderBy('name')->get();
        $transactions = DelegationAccess::scope(FinanceTransaction::with(['category', 'user', 'voluntary']))->latest('transaction_date')->latest()->get();
        $voluntaries = DelegationAccess::scope(Voluntary::query())->orderBy('name')->orderBy('lastname')->get(['id', 'name', 'lastname', 'document']);
        $income = DelegationAccess::scope(FinanceTransaction::query())->whereHas('category', fn ($query) => $query->where('type', 'income'))->sum('amount');
        $expense = DelegationAccess::scope(FinanceTransaction::query())->whereHas('category', fn ($query) => $query->where('type', 'expense'))->sum('amount');

        return view('module.finance.index', compact('categories', 'transactions', 'voluntaries', 'income', 'expense'));
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:80', Rule::unique('finance_categories')->where(fn ($query) => $query->where('type', $request->type))],
            'type' => ['required', 'in:income,expense'],
            'color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ], [], ['name' => 'nombre', 'type' => 'tipo', 'color' => 'color']);

        FinanceCategory::create($validated);
        return back()->with('success', 'Categoría financiera creada correctamente.');
    }

    public function storeTransaction(Request $request)
    {
        $request->validate(['finance_category_id' => ['required', 'exists:finance_categories,id']]);
        $category = FinanceCategory::findOrFail($request->finance_category_id);
        $validated = $request->validate([
            'finance_category_id' => ['required', 'exists:finance_categories,id'],
            'transaction_date' => ['required', 'date'],
            'amount' => ['required', 'numeric', 'gt:0', 'max:999999999999.99'],
            'counterparty' => ['required', 'string', 'min:2', 'max:150'],
            'voluntary_id' => [Rule::requiredIf($category->system_key === 'membership_dues'), 'nullable', 'exists:voluntaries,id'],
            'description' => ['required', 'string', 'min:3', 'max:180'],
            'reference' => ['nullable', 'string', 'max:80'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ], [
            'voluntary_id.required' => 'Selecciona el voluntario que realizó el pago de la cuota.',
        ], ['finance_category_id' => 'categoría', 'transaction_date' => 'fecha', 'amount' => 'monto', 'counterparty' => 'origen o destinatario', 'voluntary_id' => 'voluntario', 'description' => 'descripción']);

        $validated['user_id'] = $request->user()->id;
        $validated['delegation_id'] = DelegationAccess::id($request->user());
        abort_unless($validated['delegation_id'], 422, 'El usuario debe estar asociado a una delegación.');
        if (!empty($validated['voluntary_id'])) {
            $voluntary = Voluntary::findOrFail($validated['voluntary_id']);
            DelegationAccess::authorize((int) $voluntary->delegation_id, $request->user());
            $validated['delegation_id'] = $voluntary->delegation_id;
        }
        FinanceTransaction::create($validated);
        return back()->with('success', 'Movimiento registrado correctamente.');
    }

    public function destroyTransaction(FinanceTransaction $transaction)
    {
        DelegationAccess::authorize((int) $transaction->delegation_id);
        $transaction->delete();
        return back()->with('success', 'Movimiento eliminado correctamente.');
    }
}
