<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Transaction;
use App\Http\Requests\Common\Payments\StorePaymentRequest;
use App\Http\Requests\Common\Payments\UpdatePaymentRequest;

class Payments extends Controller
{

    public function __construct() {
		$this->middleware('UserRole:payments_show', [
			'only' => ['index', 'show'],
		]);
		$this->middleware('UserRole:payments_add', [
			'only' => ['create', 'store'],
		]);
		$this->middleware('UserRole:payments_edit', [
			'only' => ['edit', 'update'],
		]);
		$this->middleware('UserRole:payments_delete', [
			'only' => ['destroy'],
		]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with('transaction')->get();
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $transactions = Transaction::with('payments')->get();
        return view('payments.create', compact('transactions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        Payment::create($request->validated());
        return redirect(route('transactions.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        if(auth()->user()->role=='user' && auth()->user()->id!=$payment->transaction->payer_id) {
            return redirect(route('transctions.index'));
        }
        return view('payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        return view('payments.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->update($request->validated());
        return redirect(route('transactions.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect(route('transactions.index'));
    }
}
