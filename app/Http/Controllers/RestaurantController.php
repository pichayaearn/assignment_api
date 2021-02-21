<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RestaurantController extends Controller
{
    public function getRestaurants(Request $request)
    {
        $response = array('data' => null);
        $keyword = $request->input('keyword');
        $location_muangthong = '13.912228,100.5512946';
        $distance = '5000';
        $res = Http::get('https://maps.googleapis.com/maps/api/place/nearbysearch/json', [
            'keyword' => $keyword,
            'location' => $location_muangthong,
            'radius' => $distance,
            'key' => env('GOOGLE_PLACE_API_KEY'),
            'type' => 'restaurant',
        ]);
        $response['data'] = json_decode($res->getBody());
        return response()->json($response, 200);

    }
}
