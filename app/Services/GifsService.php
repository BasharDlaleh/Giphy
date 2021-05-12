<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GifsService
{
    private const baseURL = 'https://api.giphy.com/v1/gifs';
    private const api_key = 'XK5uFPZNCFdNotfuGwgxjxCG7sGG4q36';
    private const limit = 30;

    /*
      Get the trending GIFs
    */
    public function trending(){

        $response = Http::get(self::baseURL.'/trending?api_key='.self::api_key.'&limit='.self::limit.'&rating=g');
    
        return $response->json();
    
    }

    /*
      Search the GIFs
    */
    public function search($search, $offset){

        $response = Http::get(self::baseURL.'/search?api_key='.self::api_key.'&q='.$search.'&offset='.$offset.'&rating=g&lang=en');

        $count = count($response->json('data'));

        return ['count' => $count, 'data' => $response->json('data')];
    
    }
}
