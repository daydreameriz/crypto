@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col" class="text-right">Last</th>
                                <th scope="col" class="text-right">Change</th>
                                <th scope="col" class="text-right">Change Percent</th>
                                <th scope="col" class="text-right">High</th>
                                <th scope="col" class="text-right">Low</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($currencies as $currency)
                            <tr>
                                <th scope="row"><a href="{{ route('details', $currency->symbol) }}">{{ $currency->symbol }}</a></th>
                                <td class="text-right">{{ $currency->last_price }}</td>
                                <td class="text-right">{{ $currency->daily_change }}</td>
                                <td class="text-right">{{ $currency->daily_change_percent }}</td>
                                <td class="text-right">{{ $currency->daily_high }}</td>
                                <td class="text-right">{{ $currency->daily_low }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
