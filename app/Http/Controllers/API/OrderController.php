<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller {

    public $orderRepo;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepo = $orderRepository;
    }

    public function index() : JsonResponse {
        try {
            $orders = $this->orderRepo->getOrder();

            return response()->json($orders);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}

