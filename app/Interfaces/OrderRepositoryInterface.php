<?php

namespace App\Interfaces;

interface OrderRepositoryInterface
{
    public function getAllOrders();
    public function createOrder(array $orderDetails);
    public function getSingleOrder($order);
    public function updateOrder($orderId, array $newDetails);
    public function deleteOrder($orderId);
    public function getFulfilledOrders();
}
