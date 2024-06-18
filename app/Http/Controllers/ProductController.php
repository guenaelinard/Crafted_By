<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductsRequest;
use App\Http\Requests\UpdateProductsRequest;
use App\Models\Shop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Products",
 *     description="API Endpoints of Products Controller"
 * )
 * @OA\Info (
 *     title="Laravel E-commerce API",
 *     version="1.0.0",
 *     @OA\Contact(name="the developer", email="guenael.inard@gmail.com")
 * )
 * @OA\Schema (
 *     schema="Product",
 *     required={"name", "description", "price", "category", "shop_id"},
 *     @OA\Property(property="name", type="string", example="Product 1", description="Name of the product"),
 *     @OA\Property(property="description", type="string", example="Description of the product", description="Description of the product"),
 *     @OA\Property(property="price", type="number", example="100.00", description="Price of the product"),
 *     @OA\Property(property="category", type="string", example="Category 1", description="Category of the product"),
 *     @OA\Property(property="shop_id", type="integer", example="1", description="Shop ID of the product")
 * )
 */
class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/products",
     *     summary="Get all products",
     *     tags={"Products"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="order",
     *         in="query",
     *         description="Order in which to return the products (asc or desc)",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Product")
     *         )
     *     ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=404, description="Not found")
     * )
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
     * @OA\Post(
     *     path="/api/products",
     *     summary="Create a product",
     *     tags={"Products"},
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(
     * *         required=true,
     * *         @OA\JsonContent(ref="#/components/schemas/Product")
     * *     ),
     *     @OA\Response(response=201, description="Product created successfully",
     *     @OA\JSONContent(ref="#/components/schemas/Product")
     *    ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=404, description="Not found")
     * )
     **/
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
     * @OA\Get(
     *     path="/api/products/{id}",
     *     summary="Get a specific product",
     *     tags={"Products"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the product to return",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=404, description="Not found")
     * )
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
     * @OA\Put(
     *     path="/api/products/{id}",
     *     summary="Update a specific product",
     *     tags={"Products"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the product to update",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=404, description="Not found")
     * )
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
     * @OA\Delete(
     *     path="/api/products/{id}",
     *     summary="Delete a specific product",
     *     tags={"Products"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the product to delete",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product deleted successfully"
     *     ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy(Product $product): JsonResponse
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'You must be logged in to delete a product'], 403);
        }

        $product->delete();

        return response()->json(['message' => 'Product Deleted Successfully'], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/products/search/{name}",
     *     summary="Search products by name",
     *     tags={"Products"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="name",
     *         in="path",
     *         description="Name of the product to search for",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Product")
     *         )
     *     ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function searchByName($name): JsonResponse
    {
        $products = Product::where('name', 'like', '%' . $name . '%')->get();
        return response()->json($products, 200);
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
