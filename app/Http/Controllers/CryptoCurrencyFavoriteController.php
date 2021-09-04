<?php

namespace App\Http\Controllers;

use App\Repositories\CryptoCurrencyRepository;
use Illuminate\Support\Facades\Auth;

class CryptoCurrencyFavoriteController extends Controller
{
    private $cryptoCurrencyRepository;

    public function __construct(CryptoCurrencyRepository $cryptoCurrencyRepository)
    {
        $this->cryptoCurrencyRepository = $cryptoCurrencyRepository;
    }

    public function store($currencyId)
    {
        $this->cryptoCurrencyRepository->like(Auth::user(), $currencyId);

        return back();
    }

    public function destroy($currencyId)
    {
        $this->cryptoCurrencyRepository->dislike(Auth::user(), $currencyId);

        return back();
    }
}
