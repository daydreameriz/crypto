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
                                <th scope="col">Symbol</th>
                                <th scope="col" class="text-right">Last Price</th>
                                <th scope="col" class="text-right">High</th>
                                <th scope="col" class="text-right">Low</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">{{ $currency->symbol }}</th>
                                    <td class="text-right">{{ $currency->last_price }}</td>
                                    <td class="text-right">{{ $currency->daily_high }}</td>
                                    <td class="text-right">{{ $currency->daily_low }}</td>
                                </tr>
                            </tbody>
                        </table>
                        @auth
                            @if($isFavorite)
                                <form action="{{ route('crypto_currencies.dislike', $currency->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-lg">Remove from favorites</button>
                                </form>
                            @else
                                <form action="{{ route('crypto_currencies.like', $currency->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-lg">Add to favorites</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
