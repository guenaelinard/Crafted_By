<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductsRequest;
use App\Http\Requests\UpdateProductsRequest;
use App\Models\Shop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $order = $request->order ?? 'asc';
        $products = Product::orderBy('name', $order)->get();
        return response()->json($products, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreProductsRequest $request)
    {
    //
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(StoreProductsRequest $request): JsonResponse
{
    if (!auth()->check()) {
        return response()->json(['message' => 'You must be logged in to create a product'], 403);
    }

    $validatedData = $request->validated();


    $product = Product::create($validatedData);
    return response()->json(['message' => 'Product created successfully', 'data' => $product], 201);
}

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $product = Product::find($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
public function update(UpdateProductsRequest $request, Product $product): JsonResponse
{
    if(!auth()->check()) {
        return response()->json(['message' => 'You must be logged in to update a product'], 403);
    }

    $product->update($request->validated());

    return response()->json(['message' => 'Product updated successfully', 'data' => $product], 200);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'You must be logged in to delete a product'], 403);
        }

        $product->delete();

        return response()->json(['message' => 'Product Deleted Successfully'], 200);
    }

    public function searchByName($name): JsonResponse
    {
    return Product::where('name', 'like', '%' . $name . '%')->get();
    }

//    public function getProductByShopId($shopId): JsonResponse
//    {
//        $products = Product::where('shop_id', $shopId)->get();
//        return response()->json($products, 200);
//    }
//
//    public function getProductByCategory($category): JsonResponse
//    {
//        $products = Product::where('category', $category)->get();
//        return response()->json($products, 200);
//    }
//
//    public function getProductByPriceRange($minPrice, $maxPrice): JsonResponse
//    {
//        $products = Product::whereBetween('price', [$minPrice, $maxPrice])->get();
//        return response()->json($products, 200);
//    }
//

}
