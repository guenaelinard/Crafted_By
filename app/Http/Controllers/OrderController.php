<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request): JsonResponse
{
    $order = $request->order ?? 'asc';
    $orders = Order::orderBy('command_number', $order)->get();
    return response()->json($orders, 200);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request): JsonResponse
    {
        $order = Order::create([
            'command_number' => $request->command_number,
            'user_id' => $request->user_id,
            'datetime' =>now(),
        ]);
        $order->save();
        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return Order::find($order);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
public function update(UpdateOrderRequest $request, Order $order): JsonResponse
{
    $order->update($request->validated());

    return response()->json(['message' => 'Order updated successfully', 'data' => $order], 200);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order): JsonResponse
    {
        $order->delete();

        return response()->json(['message' => 'Order Deleted Successfully'], 200);
    }

    public function searchByCommandNumber($commandNumber): JsonResponse
    {
    $orders = Order::where('command_number', $commandNumber)->get();
    return response()->json($orders, 200);
}
}
