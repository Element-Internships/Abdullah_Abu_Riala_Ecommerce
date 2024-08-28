<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Cart;

class CartComposer
{
    public function compose(View $view)
    {
        $totalItems = Cart::count();
        $totalPrice = Cart::sum('price');

        $view->with([
            'totalItems' => $totalItems,
            'totalPrice' => $totalPrice
        ]);
    }
}
