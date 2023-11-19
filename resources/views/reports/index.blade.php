<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Transactions
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <form action="{{route('reports.generate')}}" method="post">
                    @csrf
                    <div class="row" style="padding: 15px">
                            <div class="col-md-4">
                                <input type="date" class="form-control" name="from" id="from" value="{{$from}}" required>
                            </div>
                            <div class="col-md-4">
                                <input type="date" class="form-control" name="to" id="to" value="{{$to}}" required>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Generate</button>
                            </div>
                    </div>
                </form>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Paid</th>
                            <th>Out Standing</th>
                            <th>Overdue</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $d)
                        <tr>
                            <td>{{$d['month']}}</td>
                            <td>{{$d['year']}}</td>
                            <td>{{$d['paid']}}</td>
                            <td>{{$d['outstanding']}}</td>
                            <td>{{$d['overdue']}}</td>
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
