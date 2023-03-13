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
            $orderId = $orderSaved->id;
            $order = Order::findOrFail($orderId);
            return response()->json([
                'data' => new OrderResource($order),
                'status' => 'success',
                'message' => 'Order added successfully.'
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'The order couldn\'t be added.'
            ], 401);
        }
    }

    public function getOrderById($orderId)
    {
        $order = Order::findOrFail($orderId);
        return response()->json([
            'data' => new OrderResource($order)
        ]);
    }

    public function updateOrder($orderId, array $newDetails)
    {
        // Transform the update data
        $trueNewDetails = [
            'details' => $newDetails['details'],
            'client' => $newDetails['client']
        ];

        // Update the order
        $orderUpdated = Order::whereId($orderId)->update($trueNewDetails);
        if ($orderUpdated) {
            $order = Order::findOrFail($orderId);
            return response()->json([
                'data' => new OrderResource($order),
                'status' => 'success',
                'message' => 'Order updated successfully.'
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'The order couldn\'t be updated.'
            ], 401);
        }
    }

    public function deleteOrder($orderId)
    {
        $orderDestroyed = Order::destroy($orderId);
        if ($orderDestroyed) {
            return response()->json([
                'status' => 'success',
                'message' => 'Order deleted successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'The order couldn\'t be deleted.'
            ], 401);
        }
    }

    public function getFulfilledOrders()
    {
        $orders = OrderResource::collection(Order::where('is_fulfilled', true)->get());
        return response()->json([
            'data' => $orders
        ]);
    }
}
