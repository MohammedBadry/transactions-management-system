<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Payments
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding: 30px">

                <form method="POST" action="{{ route('payments.store') }}">
                    @csrf

                    <div class="mt-4">
                        <x-label for="transaction_id" value="{{ __('Transaction') }}" />
                        <select name="transaction_id" id="transaction_id" required>
                            <option value="" selected>Select Payer</option>
                            @foreach ($transactions as $trans)
                                <option value="{{$trans->id}}">{{$trans->id}}</option>
                            @endforeach
                        </select>
                        @error('transaction_id')
                            <span style="color: red" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <x-label for="amount" value="{{ __('Amount') }}" />
                        <x-input id="amount" class="block mt-1 w-full" type="text" name="amount" :value="old('amount')" required autofocus autocomplete="amount" />
                        @error('amount')
                            <span style="color: red" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <x-label for="paid_on" value="{{ __('Paid On') }}" />
                        <x-input id="paid_on" class="block mt-1 w-full" type="date" name="paid_on" :value="old('paid_on')" required autocomplete="paid_on" />
                        @error('paid_on')
                            <span style="color: red" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <x-label for="details" value="{{ __('Details') }}" />
                        <textarea id="details" class="block mt-1 w-full" name="details" value="old('vat')" ></textarea>
                        @error('vat')
                            <span style="color: red" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ms-4">
                            {{ __('Create') }}
                        </x-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
