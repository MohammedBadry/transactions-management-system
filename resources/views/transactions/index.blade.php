<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Transactions
        </h2>

        @if(auth()->user()->role=='admin')
            <a href="{{route('transactions.create')}}">Create Transaction</a> <br>
            <a href="{{route('payments.create')}}">Create Payment</a>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Payer</th>
                            <th>Amount</th>
                            <th>Due On</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $trans)
                        <tr>
                            <td>{{$trans->id}}</td>
                            <td>{{$trans->payer->name}}</td>
                            <td>{{$trans->amount}}</td>
                            <td>{{$trans->due_on}}</td>
                            <td>{{$trans->status()}}</td>
                            <td><a href="{{route('transactions.show', $trans->id)}}">Details</a></td>
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
