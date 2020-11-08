<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\Order;
use Database\Seeders\CategoriesTableSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\UrlGenerator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function test()
    {
//        $user = User::find(1);
//        dd($user->userInfo->fullname);

//        $user_info = UserInfo::find(1);
//        $user = $user_info->user;
//        dd($user);

//        $category = Category::find(1);
//        $products = $category->products;
////        dd($products);

//        $product = Product::find(1);
//        $category = $product->category;
//        dd($category);
//        $products = Category::find(1)->products()->where('status', 0)->get();
//        dd($products);

//        $product = Product::find(2);
//        $category = Category::find(2);
//        $productSaved = $category->products()->save($product);

//        $category = Category::find(2);
//
//        $product = $category->products()->create([
//            'name' => 'san pham create',
//            'slug' => 'san-pham-create',
//            'origin_price' => '10000',
//            'sale_price' => '5000',
//            'discount_percent' => '20',
//            'content' => 'Noi dung demo',
//            'author_id' => 0,
//            'publishing_company_id' => 0,
//            'pages_count' => 0,
//            'status' => 0,
//            'rate' => 0,
//        ]);

//        $order_id = 1;
//        $order = Order::find(1);
//        $product_id = 3;
//        $order->products()->attach($product_id);

        echo url()->previous();
    }
}
