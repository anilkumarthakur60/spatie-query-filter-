<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use Illuminate\Http\Request;

class CurrencyConverterController extends Controller
{

    public function index()
    {
        return view('currency.index');
    }
    public function exchangeCurrency(Request $request)
    {

        $amount = ($request->amount) ? ($request->amount) : (1);

        $apikey = '66ea07f84ea80e5f8882';

        $from_Currency = urlencode($request->from_currency);
        $to_Currency = urlencode($request->to_currency);
        $query = "{$from_Currency}_{$to_Currency}";

        // change to the free URL if you're using the free version
        $json = file_get_contents("http://free.currencyconverterapi.com/api/v5/convert?q={$query}&amp;compact=y&amp;apiKey={$apikey}");

        $obj = json_decode($json, true);

        $val = $obj["$query"];

        $total = $val['val'] * 1;

        $formatValue = number_format($total, 2, '.', '');

        $data = "$amount $from_Currency = $to_Currency $formatValue";

        echo $data;
        die;
    }
}
