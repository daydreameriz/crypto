<?php

namespace App\Http\Controllers;

use App\Repositories\CryptoCurrencyRepository;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    private $cryptoCurrencyRepository;

    public function __construct(CryptoCurrencyRepository $cryptoCurrencyRepository)
    {
        $this->cryptoCurrencyRepository = $cryptoCurrencyRepository;
    }

    public function home()
    {
        $currencies = $this->cryptoCurrencyRepository->getLastCurrencyData();

        return view('pages.home', compact('currencies'));
    }

    public function details($symbolSlug)
    {
        $currency = $this->cryptoCurrencyRepository->findBySymbolOrFail($symbolSlug);
        $isFavorite = $this->cryptoCurrencyRepository->isFavorite($currency, Auth::user());

        return view('pages.details', compact('currency', 'isFavorite'));
    }

    public function favorites()
    {
        $currencies = $this->cryptoCurrencyRepository->getFavoritesByUser(Auth::user());

        return view('pages.home', compact('currencies'));
    }
}
