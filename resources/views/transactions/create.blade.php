<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Transactions
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding: 30px">

                <form method="POST" action="{{ route('transactions.store') }}">
                    @csrf

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
                        <x-label for="payer_id" value="{{ __('Payer') }}" />
                        <select name="payer_id" id="payer_id">
                            <option value="" selected>Select Payer</option>
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        @error('payer_id')
                            <span style="color: red" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <x-label for="due_on" value="{{ __('Due On') }}" />
                        <x-input id="due_on" class="block mt-1 w-full" type="date" name="due_on" :value="old('due_on')" required autocomplete="due_on" />
                        @error('due_on')
                            <span style="color: red" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <x-label for="vat" value="{{ __('Vat') }}" />
                        <x-input id="vat" class="block mt-1 w-full" type="text" name="vat" :value="old('vat')" required autofocus autocomplete="vat" />
                        @error('vat')
                            <span style="color: red" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <x-label for="vat_inclusive" value="{{ __('Vat Inclusive') }}" />
                        <select name="vat_inclusive" id="vat_inclusive">
                            <option value="1" selected>Yes</option>
                            <option value="0">No</option>
                        </select>
                        @error('vat_inclusive')
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
