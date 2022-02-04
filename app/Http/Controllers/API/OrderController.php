<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function create(Request $request) : JsonResponse {
        try {
            $validator = Validator::make($request->all(), [
                'ticket_count' => 'required',
                'price' => 'required',
            ]);

            if($validator->fails()) {
                return response()->json($validator->errors());
            }

            $data = [
                'user_id' => auth()->user()->id,
                'ticket_id' => $request->ticket_id,
                'ticket_count' => $request->ticket_count,
                'price' => $request->price,
                'status' => 0
            ];

            $this->orderRepo->create($data);

            return response()->json((object) 'success');
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}

