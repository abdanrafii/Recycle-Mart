<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Shop\Repositories\Front\Interfaces\CartRepositoryInterface;


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

        return view('themes.indotoko.home');
    }
}
