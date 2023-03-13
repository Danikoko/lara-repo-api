<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use App\Http\Resources\OrderResource;
use Illuminate\Http\JsonResponse;

class OrderRepository implements OrderRepositoryInterface
{
    public function getAllOrders(): JsonResponse
    {
        $orders = OrderResource::collection(Order::all());
        return response()->json([
            'data' => $orders
        ]);
    }

    public function createOrder(array $orderDetails): JsonResponse
    {
        // Transform the creation data
        $trueOrderDetails = [
            'details' => $orderDetails['details'],
            'client' => $orderDetails['client']
        ];

        // Save the order
        $orderSaved = Order::create($trueOrderDetails);
        if ($orderSaved) {
            return response()->json([
                'data' => new OrderResource($orderSaved),
                'status' => 'success',
                'message' => 'Order added successfully'
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'The order couldn\'t be added'
            ], 401);
        }
    }

    public function getOrderById($orderId)
    {
        return Order::findOrFail($orderId);
    }

    public function updateOrder($orderId, array $newDetails)
    {
        return Order::whereId($orderId)->update($newDetails);
    }

    public function deleteOrder($orderId)
    {
        Order::destroy($orderId);
    }

    public function getFulfilledOrders()
    {
        return Order::where('is_fulfilled', true);
    }
}
