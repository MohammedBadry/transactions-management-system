<?php

namespace App\Http\Controllers\Api;

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
        return response()->json(['status' => true, 'message' => null, 'data' => ['payments' => $payments]]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        $payment = Payment::create($request->validated());
        return response()->json(['status' => true, 'message' => 'Created successfully', 'data' => ['payment' => $payment]]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        if(auth()->user()->role=='user' && auth()->user()->id!=$payment->transaction->payer_id) {
            return redirect(route('transctions.index'));
        }
        return response()->json(['status' => true, 'message' => null, 'data' => ['payment' => $payment]]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->update($request->validated());
        return response()->json(['status' => true, 'message' => 'Updated successfully', 'data' => ['payment' => $payment]]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return response()->json(['status' => true, 'message' => 'Deleted successfully', 'data' => null]);
    }
}
