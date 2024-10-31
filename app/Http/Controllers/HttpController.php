<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class HttpController extends Controller
{
    public function getData(Request $request)
    {
        $year = $request->input('year');
        $client = new Client();
        $response = $client->request('GET', 'https://tes-web.landa.id/intermediate/menu');
        $menu = json_decode($response->getBody()->getContents(), true);

        $response2 = $client->request('GET', 'https://tes-web.landa.id/intermediate/transaksi?tahun=' . $year);
        $transaksi = json_decode($response2->getBody()->getContents(), true);

        return view('main', compact('year', 'menu', 'transaksi'));
    }

    public function getDetails(Request $request)
    {
        $menu = $request->input('menu');
        $month = $request->input('month');
        $year = $request->input('year');
        $transaksi = json_decode($request->input('transaksi'), true);

        return view('details', compact('year', 'month', 'menu', 'transaksi'));
    }
}
