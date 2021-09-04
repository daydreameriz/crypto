<?php

namespace App\Repositories;

use App\Models\CryptoCurrency;
use App\Services\CryptoCurrencyService;

class CryptoCurrencyRepository
{
    private $model;
    private $service;

    public function __construct(CryptoCurrency $cryptoCurrency, CryptoCurrencyService $cryptoCurrencyService)
    {
        $this->model = $cryptoCurrency;
        $this->service = $cryptoCurrencyService;
    }

    public function findBySymbol($symbolSlug)
    {
        return $this->model->where('symbol', $symbolSlug)->first();
    }

    public function findBySymbolOrFail($symbolSlug)
    {
        return $this->model->where('symbol', $symbolSlug)->firstOrFail();
    }

    public function getCurrencies($limit = 5)
    {
        return $this->model->orderBy('updated_at', 'desc')->limit($limit)->get();
    }

    public function isFavorite($currency, $user = null)
    {
        return $user ? $currency->users()->where('id', $user->id)->exists() : false;
    }

    public function like($user, $currencyId)
    {
        $user->cryptoCurrencies()->syncWithoutDetaching($currencyId);
    }

    public function dislike($user, $currencyId)
    {
        $user->cryptoCurrencies()->detach($currencyId);
    }

    public function getFavoritesByUser($user)
    {
        $newData = $this->service->fetchData();
        $this->saveLastCurrencyData($newData);

        return $user->cryptoCurrencies()->get();
    }

    public function getLastCurrencyData()
    {
        $newData = $this->service->fetchData();
        $this->saveLastCurrencyData($newData);

        return $this->getCurrencies();
    }

    private function saveLastCurrencyData($data)
    {
        foreach ($data as $item) {
            if ($currency = $this->findBySymbol($item['symbol'])) {
                $currency->update($item);
            } else {
                $this->model->create($item);
            }
        }
    }
}
