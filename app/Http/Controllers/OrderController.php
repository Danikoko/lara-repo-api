<?php

namespace App\Http\Controllers;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->orderRepository->getAllOrders();
    }

    public function fulfilledOrders()
    {
        return $this->orderRepository->getFulfilledOrders();
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
    public function store(StoreOrderRequest $request)
    {
        $validatedData = $request->validated();
        return $this->orderRepository->createOrder($validatedData);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return $this->orderRepository->getOrderById($order->id);
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
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $validatedData = $request->validated();
        return $this->orderRepository->updateOrder($order->id, $validatedData);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        return $this->orderRepository->deleteOrder($order->id);
    }
}
