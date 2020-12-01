<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Author;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Publishing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;


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
        $user = Auth::user();
        $product = new Product();
        if ($user->can('create', $product)) {
            $categories = Category::get();
            $authors = Author::get();
            $publishings = Publishing::get();
            return view('backend.products.create')->with([
                'categories' => $categories,
                'authors' => $authors,
                'publishings' => $publishings
            ]);
        } else {
            return view('backend.includes.incompetent');
        }
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
        if ($request->get('discount_percent')) $product->discount_percent = $request->get('discount_percent');
        else $product->discount_percent = 0;
        $product->content = $request->get('content');
        if ($request->hasFile('image')){
            $image = $request->file('image');
            $path = Storage::disk('public')->putFileAs('images', $image, $image->getClientOriginalName());
            $product->image = $path;
        }
        $product->status = $request->get('status');
        $product->pages_count = '0';
        $product->status = $request->get('status');
        $product->user_id = Auth::user()->id;
        $product->save();
        if ($request->hasFile('images')){
            $files = $request->file('images');
            foreach ($files as $file) {
                $path = Storage::disk('public')
                    ->putFileAs('images', $file, $file->getClientOriginalName());
                $image = new Image();
                $image->name = $file->getClientOriginalName();
                $image->path = $path;
                $image->product_id = $product->id;
                $image->save();
            }
        }
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
        $user = Auth::user();
        $product = Product::find($id);
        if ($user->can('view', $product)) {
            dd($product);
        } else {
            return view('backend.includes.incompetent');
        }
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
        $user = Auth::user();
        if ($user->can('update', $product)) {
            $categories = Category::get();
            $authors = Author::get();
            $publishings = Publishing::get();
            return view('backend.products.edit')->with([
                'product' => $product,
                'categories' => $categories,
                'authors' => $authors,
                'publishings' => $publishings
            ]);
        } else {
            dd('khong');
        }
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
        $user = Auth::user();
        $product = Product::find($id);
        $images = $product->images;
        if ($user->can('delete', $product)) {
            $product->delete();
            if (isset($images)) {
                foreach ($images as $image) {
                    $image->delete();
                }
            };
            return back();
//            return redirect()->route('backend.product.index');
        } else {
            return view('backend.includes.incompetent');
        }
    }

    public function showImages($id)
    {
        $images = Product::find($id)->images;
        foreach ($images as $image) {
            echo $image->name . '<br>';
        }
    }

//    public function getData()
//    {
//        $products = Product::all();
//
//        return DataTables::of($products)
//            ->addColumn('action', function ($product) {
//                return '<a href="" class="btn btn-primary">Chi tiêt</a>';
//            })
//            ->addIndexColumn()
//            ->rawColumns(['action'])
//            ->make(true);
//    }
}
