<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnitPurchase;
use Illuminate\Support\Facades\Auth;

class CreditController extends Controller
{
    public function buy(){
        return view('credits.buy_rebirth');
    }

    function index( Request $request){
        $size = request()->get('size', 10);
        // $size = $request->size || 10;
        $sum =  UnitPurchase::with('payments')->where('user_id', Auth::user()->id);
        $data['sum'] = $sum;
        $data['history'] = UnitPurchase::with('payments')->where('user_id', Auth::user()->id)->latest()->paginate($size);
        // $data['page'] = $page;
        // $data['size'] = $size;

        // dd($history);
        return view('credits.history_rebirth')->with($data); 
    }
}
