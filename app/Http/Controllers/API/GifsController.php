<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\GifsService;
use Illuminate\Http\Request;

class GifsController extends Controller
{
    protected $gifsService;

    public function __construct(GifsService $gifsService)
    {
        // inject the GIFs service in the controller
        
         $this->gifsService = $gifsService;
    }

    public function trending(){

        return response()->json($this->gifsService->trending());
    
    }

    public function search(Request $request){

        $search = $request->search;

        $offset = $request->offset;  

        return response()->json($this->gifsService->search($search, $offset));
    
    }
}
