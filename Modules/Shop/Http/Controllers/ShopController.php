<?php

namespace Modules\Shop\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Modules\Shop\Entities\Cart;
use Modules\Shop\Entities\Product;
use Modules\Shop\Entities\Shop;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $carts = Cart::where('user_id', auth()->id())->count();
        $this->data['carts'] = $carts;

        $shop = Shop::where('owner_id', auth()->id())->first();
        $this->data['shop'] = $shop;

        $products = Product::where('shop_id', $shop->id)->paginate(5);
        $this->data['products'] = $products;
        
        return $this->loadTheme('shop.index', $this->data);
    }

    public function setup()
    {
        $carts = Cart::where('user_id', auth()->id())->count();
        $this->data['carts'] = $carts;

        return $this->loadTheme('shop.setup', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:shop_shops',
            'body' => 'required',
            'featured_image' => 'image|file|max:1024'
        ]);

        if($request->file('featured_image')) {
            $validatedData['featured_image'] = $request->file('featured_image')->store('img');
        }

        $validatedData['owner_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 100);
        $validatedData['slug'] = Str::slug($validatedData['name']);

        Shop::create($validatedData);

        $user['is_seller'] = true;

        User::where('id', auth()->user()->id)->update($user);

        $carts = Cart::where('user_id', auth()->id())->count();
        $this->data['carts'] = $carts;

        $shop = Shop::where('owner_id', auth()->id())->first();
        $this->data['shop'] = $shop;

        $products = Product::where('shop_id', $shop->id)->paginate(8);
        $this->data['products'] = $products;

        return $this->loadTheme('shop.index', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('shop::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('shop::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
