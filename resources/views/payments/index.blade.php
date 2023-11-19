<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Paymnts
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Transaction ID</th>
                            <th>Amount</th>
                            <th>Paid On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaction->payments as $payment)
                        <tr>
                            <td>{{$payment->id}}</td>
                            <td>{{$payment->transaction->id}}</td>
                            <td>{{$payment->amount}}</td>
                            <td>{{$payment->paid_on}}</td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center">No Available data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
