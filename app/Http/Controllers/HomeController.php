<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Shop\Repositories\Front\Interfaces\CartRepositoryInterface;
use Modules\Shop\Entities\Cart;
use Modules\Shop\Entities\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $cartRepository;

    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $cart = $this->cartRepository->findByUser(auth()->user());
        $carts = Cart::where('user_id', auth()->id())->count();
        $products = Product::limit(4)->latest()->get();
        $popularProducts = Product::limit(4)->inRandomOrder()->get();

        return view('themes.indotoko.home', compact('carts', 'products', 'popularProducts'));
    }
}
