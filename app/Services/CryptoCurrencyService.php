<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CryptoCurrencyService
{
    public function fetchData()
    {
        try {
            $symbolArray = $this->getSymbols();

            return $this->getData($symbolArray);
        } catch (\Exception $exception) {
            return [];
        }
    }

    private function getSymbols()
    {
        $response = Http::get('https://api.bitfinex.com/v1/symbols');
        $array = $response->json();

        return array_slice($array, 0, 5);
    }

    private function getData($symbolArray)
    {
        $url = 'https://api-pub.bitfinex.com/v2/tickers?symbols='.$this->getQueryParameters($symbolArray);
        $response = Http::get($url);
        $data = $response->json();

        return $this->formatData($data);
    }

    private function getQueryParameters($symbolArray)
    {
        $newArray = [];
        foreach ($symbolArray as $symbol) {
            $newArray[] = 't'.\Str::upper($symbol);
        }

        return implode(',', $newArray);
    }

    private function formatData($data)
    {
        $formatedData = [];
        foreach ($data as $item) {
            $tempArray = [];

            $tempArray['symbol'] = $item[0];
            $tempArray['last_price'] = $item[7];
            $tempArray['daily_change'] = $item[5];
            $tempArray['daily_change_percent'] = $item[6];
            $tempArray['daily_high'] = $item[9];
            $tempArray['daily_low'] = $item[10];

            $formatedData[] = $tempArray;
        }

        return $formatedData;
    }
}
