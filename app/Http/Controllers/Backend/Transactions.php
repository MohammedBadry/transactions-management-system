<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Payment;
use App\Models\User;
use App\Http\Requests\Common\Transactions\StoreTransactionRequest;
use App\Http\Requests\Common\Transactions\UpdateTransactionRequest;

class Transactions extends Controller
{

	public function __construct() {

		$this->middleware('UserRole:transactions_show', [
			'only' => ['index', 'show'],
		]);
		$this->middleware('UserRole:transactions_add', [
			'only' => ['create', 'store', 'reports'],
		]);
		$this->middleware('UserRole:transactions_edit', [
			'only' => ['edit', 'update'],
		]);
		$this->middleware('UserRole:transactions_delete', [
			'only' => ['destroy'],
		]);
	}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->role=='admin') {
            $transactions = Transaction::with('payments')->get();
        } else {
            $transactions = auth()->user()->transactions();
        }
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::user()->get();
        return view('transactions.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        Transaction::create($request->validated());
        return redirect(route('transactions.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        if(auth()->user()->role=='user' && auth()->user()->id!=$transaction->payer_id) {
            return redirect(route('transactions.index'));
        }
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $transaction->update($request->validated());
        return redirect(route('transactions.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect(route('transactions.index'));
    }
}
