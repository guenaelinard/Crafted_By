<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
USE Illuminate\Support\Str;
class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request): JsonResponse
{
    $order = $request->order ?? 'asc';
    $shops = Shop::orderBy('name', $order)->get();
    return response()->json($shops, 200);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreShopRequest $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(StoreShopRequest $request): JsonResponse
{
    if (!auth()->check()) {
        return response()->json(['message' => 'You must be logged in to create a shop'], 403);
    }

    $shop = new Shop([
        'id' => Str::uuid(),
        'name' => $request->input('name'),
        'theme' => $request->input('theme'),
        'biography' => $request->input('biography'),
        'user_id' => auth()->id(),
    ]);

    $shop->save();

    return response()->json($shop, 201);
}

    /**
     * Display the specified resource.
     */
    public function show(Shop $shop)
    {
        return Shop::find($shop);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shop $shop)
    {

    }

    /**
     * Update the specified resource in storage.
     */
public function update(UpdateShopRequest $request, Shop $shop): JsonResponse
{
    $shop->update($request->validated());

    return response()->json(['message' => 'Shop updated successfully', 'data' => $shop], 200);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop): JsonResponse
    {
        if (!Gate::allows('auth-user', $shop)) {
            return response()->json(['message' => 'You are not authorized to delete this shop'], 403);
        }

        $shop->delete();

        return response()->json(['message' => 'Product Deleted Successfully'], 200);
    }

    public function searchByName($name): Collection
    {
        return Shop::where('name', 'like', '%' . $name . '%')->get();
    }
}
