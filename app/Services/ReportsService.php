<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;

class ReportsService
{
    public function __constuct()
    {
        //
    }

    public function generate(Request $request)
    {
        $period = CarbonPeriod::create($request->from, '1 month', $request->to);

        $data = collect([]);
        foreach ($period as $dt) {
            $res['month'] = $dt->format('m');
            $res['year'] = $dt->format('Y');

            //paid transactions
            $res['paid'] = Transaction::whereMonth('created_at', $dt->format('m'))
            ->whereYear('due_on', $dt->format('Y'))
            ->sum('amount');

            //outstanding transactions
            $outstanding_payments = Payment::whereIn('transaction_id', function($query) use ($dt) {
                $query->select('id')->from('transactions');
                $query->whereMonth('created_at', $dt->format('m'));
                $query->whereYear('created_at', $dt->format('Y'));
                $query->where('due_on', '>=', date('Y-m-d'));
            })->sum('amount');
            $res['outstanding'] = Transaction::whereMonth('created_at', $dt->format('m'))
            ->whereYear('created_at', $dt->format('Y'))
            ->where('amount', '>', $outstanding_payments)
            ->where('due_on', '>=', date('Y-m-d'))
            ->sum('amount');

            //overdue transactions
            $overdue_payments = Payment::whereIn('transaction_id', function($query) use ($dt) {
                $query->select('id')->from('transactions');
                $query->whereMonth('created_at', $dt->format('m'));
                $query->whereYear('created_at', $dt->format('Y'));
                $query->where('due_on', '<', date('Y-m-d'));
            })->sum('amount');
            $res['overdue'] = Transaction::whereMonth('created_at', $dt->format('m'))
            ->whereYear('created_at', $dt->format('Y'))
            ->where('amount', '>', $overdue_payments)
            ->where('due_on', '<', date('Y-m-d'))
            ->sum('amount');

            $data->push($res);
        }
        return $data;
    }

}
