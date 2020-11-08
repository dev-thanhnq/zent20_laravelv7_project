<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Author;
use App\Models\Category;
use App\Models\Product;
use App\Models\Publishing;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::simplePaginate(15);
        return view('backend.products.index')->with([
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $authors = Author::get();
        $publishings = Publishing::get();
        return view('backend.products.create')->with([
            'categories' => $categories,
            'authors' => $authors,
            'publishings' => $publishings
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {

        $product = new Product();
        $product->name = $request->get('name');
        $product->slug = \Illuminate\Support\Str::slug($request->get('name'));
        $product->category_id = $request->get('category_id');
        $product->author_id = $request->get('author_id');
        $product->publishing_company_id = $request->get('publishing_company_id');
        $product->origin_price = $request->get('origin_price');
        $product->sale_price = $request->get('sale_price');
        $product->discount_percent = $request->get('discount_percent');
        $product->content = $request->get('content');
        $product->status = $request->get('status');
        $product->pages_count = '0';
        $product->status = $request->get('status');
        $product->save();

        return redirect()->route('backend.product.index');
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
        $product = Product::find($id);
        $categories = Category::get();
        $authors = Author::get();
        $publishings = Publishing::get();
        return view('backend.products.edit')->with([
            'product' => $product,
            'categories' => $categories,
            'authors' => $authors,
            'publishings' => $publishings
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductRequest $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->get('name');
        $product->slug = \Illuminate\Support\Str::slug($request->get('name'));
        $product->category_id = $request->get('category_id');
        $product->author_id = $request->get('author_id');
        $product->publishing_company_id = $request->get('publishing_company_id');
        $product->origin_price = $request->get('origin_price');
        $product->sale_price = $request->get('sale_price');
        $product->discount_percent = $request->get('discount_percent');
        $product->content = $request->get('content');
        $product->status = $request->get('status');
        $product->pages_count = '0';
        $product->status = $request->get('status');
        $product->save();

        return redirect()->route('backend.product.index');
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

    public function showImages($id)
    {
        $images = Product::find($id)->images;
        foreach ($images as $image) {
            echo $image->name . '<br>';
        }
    }
}
