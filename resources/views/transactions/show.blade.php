<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Transaction Details: {{$transaction->id}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding: 30px">

                <ul>
                    <li>ID: {{$transaction->id}}</li>
                    <li>Payer: {{$transaction->payer->name}}</li>
                    <li>Amount: {{$transaction->amount}}</li>
                    <li>Due On: {{$transaction->due_on}}</li>
                    <li>Vat: {{$transaction->vat}}</li>
                    <li>Vat Inclusive: {{($transaction->vat_inclusive==1) ? 'Yes' : 'No'}}</li>
                    <li>Stauts: {{$transaction->status()}}</li>
                </ul>

                Paymnts: <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Amount</th>
                            <th>Paid On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaction->payments as $payment)
                        <tr>
                            <td>{{$payment->id}}</td>
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
